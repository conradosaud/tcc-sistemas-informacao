<?php

include_once("Dao.php");
include_once("../../php/InterfaceCRUD.php");

class Transacao implements InterfaceCRUD{
    
    /***********************************************************************
     *  Relação com a tabela: AnuncioApresentacao
    ************************************************************************/
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">
    
    private $IdTransacao;
    private $IdPlano;
    private $IdEmpresa;
    private $IdCupom;
    private $DataDuracao;
    private $Desconto;
    private $FormaPagamento;
    private $Operacao;
    private $Valor;
    
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Construtor">
    
    private $db;
    public function __construct(){
        $db = new Dao();
        $this->db = $db->instance();
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="CRUD"> 
    
    public function altera($atual, $novo) {
        return false;
    }

    public function busca($id) {
        return false;
    }

    public function buscaTodos() {
        return false;
    }

    public function insere($objeto) {
        try{

            $pdo = $this->db;

            // inicia transacao
            $pdo->beginTransaction();
            
            // insere a transacao
            $sql = "
                INSERT INTO Transacao
                (IdPlano, IdEmpresa, IdCupom, DataDuracao, Desconto, FormaPagamento, Operacao, Valor, Data)
                VALUES
                (:IdPlano, :IdEmpresa, :IdCupom, :DataDuracao, :Desconto, :FormaPagamento, :Operacao, :Valor, :Data)
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdPlano", $objeto->getIdPlano(), PDO::PARAM_INT);
            $query->bindValue(":IdEmpresa", $objeto->getIdEmpresa(), PDO::PARAM_INT);
            $query->bindValue(":IdCupom", $objeto->getIdCupom(), PDO::PARAM_INT);
            $query->bindValue(":DataDuracao", $objeto->getDataDuracao(), PDO::PARAM_STR);
            $query->bindValue(":Desconto", $objeto->getDesconto(), PDO::PARAM_STR);
            $query->bindValue(":FormaPagamento", $objeto->getFormaPagamento(), PDO::PARAM_STR);
            $query->bindValue(":Operacao", $objeto->getOperacao(), PDO::PARAM_STR);
            $query->bindValue(":Valor", $objeto->getValor(), PDO::PARAM_INT);
            $query->bindValue(":Data", $this->dataAgora(true), PDO::PARAM_STR);
            $resultado = $query->execute();
            
            if(!$resultado){
                $pdo->rollBack();
                return FALSE;
            }
            
            $IdTransacao = $pdo->lastInsertId();
            
            // insere o anuncio impulsionado
            include_once("../../controller/AnuncioImpulsionadoControlador.php");
            
            $dias = $objeto->getDataDuracao();
            $dias = explode(",", $dias);
            
            for($i = 0; $i < count($dias); $i++){
                
                $objAnuncoAI = AnuncioImpulsionadoControlador::criaObj(
                    $objeto->getIdEmpresa(), $objeto->getIdPlano(), $IdTransacao, 
                    $dias[$i], NULL
                );
                
                $objAnuncioAI = new AnuncioImpulsionadoControlador();
                $objAnuncioAI = $objAnuncioAI->post(null, $objAnuncoAI);
                
                if(!$objAnuncioAI){
                    $pdo->rollBack();
                    return FALSE;   
                }
            }
            
            // invalida cupom
            include_once("../../controller/CuponsControlador.php");
            $objCupom = new CuponsControlador();
            $objCupom = $objCupom->put("invalidaCupom", $objeto->getIdCupom(), NULL);
            
            if(!$objCupom){
                $pdo->rollBack();
                echo $objeto->getIdCupom();
                return FALSE; 
            }else{
                $pdo->commit();
                return TRUE;
            }

        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function remove($id) {
        return false;
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    
    //public function
    
    public function buscaTodasImgAlbum($obj){
        try{
            
            $sql = "
                SELECT * FROM AnuncioApresentacao
                WHERE IdAnuncio = :IdAnuncio
                ;";

            $imagens = "";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":IdAnuncio", $obj->getIdAnuncio(), PDO::PARAM_INT);
            $query->execute();
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($dados as $listado){
                $imagens = $listado["ImgAlbum"];
            }
            
            return $imagens;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function alteraImgPerfil($obj, $img){
        try{
            
            $sql = "
                UPDATE AnuncioApresentacao
                SET
                ImgPerfil = :ImgPerfil
                WHERE
                IdAnuncio = :IdAnuncio
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":ImgPerfil", $img, PDO::PARAM_STR);
            $query->bindValue(":IdAnuncio", $obj->getIdAnuncio(), PDO::PARAM_INT);
            $query->execute();
            $dados = $query->rowCount();
            if($dados == 1){
                return $img;
            }else{
                Mensagem::msgOperacaoErro();
                return FALSE;
            }
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function alteraImgAlbum($obj, $img){
        try{
            
            $sql = "
                UPDATE AnuncioApresentacao
                SET
                ImgAlbum = CONCAT(IFNULL(ImgAlbum, ''), :ImgAlbum)
                WHERE
                IdAnuncio = :IdAnuncio
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":ImgAlbum", $img, PDO::PARAM_STR);
            $query->bindValue(":IdAnuncio", $obj->getIdAnuncio(), PDO::PARAM_INT);
            $query->execute();
            $dados = $query->rowCount();
            if($dados == 1){
                return $img;
            }else{
                Mensagem::msgOperacaoErro();
                return FALSE;
            }
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function removeImgAlbum($obj, $img){
        try{
            
            $imagens = $this->buscaTodasImgAlbum($obj);
            $imagens = $this->removeImagem($imagens, $img);

            $sql = "
                UPDATE AnuncioApresentacao
                SET
                ImgAlbum = :ImgAlbum
                WHERE
                IdAnuncio = :IdAnuncio
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":ImgAlbum", $imagens, PDO::PARAM_STR);
            $query->bindValue(":IdAnuncio", $obj->getIdAnuncio(), PDO::PARAM_INT);
            $query->execute();
            $dados = $query->rowCount();
            if($dados == 1){
                return $img;
            }else{
                Mensagem::msgOperacaoErro();
                return FALSE;
            }
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    private function removeImagem($imagens, $remover){
        $imenda = "";
        $img = explode("-", $imagens);
        array_pop($img);
        for($i = 0; $i < count($img); $i++){
            if($img[$i] == $remover){
                $img[$i] = "";
            }else{
                $imenda .= $img[$i]."-";
            }
        }

        return $imenda;
    } 
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos Fixos e Estáticos">
    
    private function dataAgora($horas){
        date_default_timezone_set('America/Sao_Paulo');
        $data = "";
        if($horas){
            $data = date("Y-m-d H:i:s");
        }else{
            $data = date("Y-m-d");
        }
        return $data;
    }
    
    private function carregaDados($query){
        
        $anuncioApresentacoes = [];
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $anuncioApresentacao = new AnuncioApresentacao();
            $anuncioApresentacao->setNomeExibicao($listado["NomeExibicao"]);
            $anuncioApresentacao->setDescricaoCurta($listado["DescricaoCurta"]);
            $anuncioApresentacao->setDescricaoLonga($listado["DescricaoLonga"]);
            $anuncioApresentacao->setStatus($listado["Status"]);
            $anuncioApresentacoes[] = $anuncioApresentacao;
        }

        switch(count($anuncioApresentacoes)){
            case 0:
                return NULL;
            case 1:
                return $anuncioApresentacoes[0];
            default:
                return $anuncioApresentacoes;
        }
    }

    private function verificaDados($query){
        $dados = $query->rowCount();
        if($dados == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Getters e Setters">

    function getIdTransacao() {
        return $this->IdTransacao;
    }

    function getIdPlano() {
        return $this->IdPlano;
    }

    function getIdEmpresa() {
        return $this->IdEmpresa;
    }

    function getDataDuracao() {
        return $this->DataDuracao;
    }

    function getDesconto() {
        return $this->Desconto;
    }

    function getFormaPagamento() {
        return $this->FormaPagamento;
    }

    function getOperacao() {
        return $this->Operacao;
    }

    function getValor() {
        return $this->Valor;
    }

    function getIdCupom() {
        return $this->IdCupom;
    }

    function setIdCupom($IdCupom) {
        $this->IdCupom = $IdCupom;
    }
    
    function setIdTransacao($IdTransacao) {
        $this->IdTransacao = $IdTransacao;
    }

    function setIdPlano($IdPlano) {
        $this->IdPlano = $IdPlano;
    }

    function setIdEmpresa($IdEmpresa) {
        $this->IdEmpresa = $IdEmpresa;
    }

    function setDataDuracao($DataDuracao) {
        $this->DataDuracao = $DataDuracao;
    }

    function setDesconto($Desconto) {
        $this->Desconto = $Desconto;
    }

    function setFormaPagamento($FormaPagamento) {
        $this->FormaPagamento = $FormaPagamento;
    }

    function setOperacao($Operacao) {
        $this->Operacao = $Operacao;
    }

    function setValor($Valor) {
        $this->Valor = $Valor;
    }
    
    // </editor-fold>

}
