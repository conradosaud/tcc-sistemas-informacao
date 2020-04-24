<?php

include_once("Dao.php");
include_once("../../php/InterfaceCRUD.php");

class AnuncioOperacoes implements InterfaceCRUD{
    
    /***********************************************************************
     *  Relação com a todas tabelas e procedures
    ************************************************************************/
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">
    
    private $IdEmpresa;
    private $NomeExibicao;
    private $DescricaoCurta;
    private $DescricaoLonga;
    private $Observacao;
    private $Status;
    
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
        try{
            
            $sql = "
                UPDATE AnuncioApresentacao
                SET
                NomeExibicao = :NomeExibicao,
                DescricaoCurta = :DescricaoCurta,
                DescricaoLonga = :DescricaoLonga,
                Data = :Data
                WHERE
                IdEmpresa = :IdEmpresa
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":NomeExibicao", $novo->getNomeExibicao(), PDO::PARAM_STR);
            $query->bindValue(":DescricaoCurta", $novo->getDescricaoCurta(), PDO::PARAM_STR);
            $query->bindValue(":DescricaoLonga", $novo->getDescricaoLonga(), PDO::PARAM_STR);
            $query->bindValue(":Data", $this->dataAgora(true), PDO::PARAM_STR);
            $query->bindValue(":IdEmpresa", $novo->getIdEmpresa(), PDO::PARAM_INT);
            $query->execute();
            
            return $this->verificaDados($query);
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function busca($id) {
        try{
            
            $sql = "
                SELECT * FROM AnuncioApresentacao
                WHERE IdEmpresa = :IdEmpresa
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $id, PDO::PARAM_INT);
            $query->execute();
            
            $anuncioApresentacao = $this->carregaDados($query);
            
            return $anuncioApresentacao;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function buscaTodos() {
        
    }

    public function insere($objeto) {
        
    }

    public function remove($id) {
        
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    
    public function buscaAnuncioPorIdEmpresa($obj){
        
        // empresa, apresentacao, info, horarios 
        $objBasico = $this->buscaBasicoPorIdEmpresa($obj);
        
        // imagens
        $objImagens = $this->buscaImagensPorIdEmpresa($obj);
        
        // facebook
        $objFacebook = $this->buscaFacebookPorIdEmpresa($obj);
        
        // maps
        $objMaps = $this->buscaMapsPorIdEmpresa($obj);
        
        // enderecos
        $objEnderecos = $this->buscaEnderecosPorIdEmpresa($obj);

        $obj = ["objEmpresa"=>$objBasico["objEmpresa"][0], "objApresentacao"=>$objBasico["objApresentacao"][0],
            "objHorarios"=>$objBasico["objHorarios"][0], "objInfo"=>$objBasico["objInfo"][0], 
            "objImagem"=>$objImagens["objImagem"], "objFacebook"=>$objFacebook["objFacebook"],
            "objMaps"=>$objMaps["objMaps"], "objEndereco"=>$objEnderecos["objEndereco"]
        ];
        
        return $obj;
    }
    
    public function buscaBasicoPorIdEmpresa($obj){
        try{
            
            $sql = "
                CALL Anuncio_SelecionaTodosPorIdEmpresa(:p1, :p2);
            ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":p1", $obj["Var_IdEmpresa"], PDO::PARAM_INT);
            $query->bindValue(":p2", $obj["Var_Anunciando"], PDO::PARAM_INT);
            $query->execute();
            
            $obj = $this->carregaDados($query, 1, 0, 0, 1, 0, 1, 0, 1);
            
            return $obj;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaImagensPorIdEmpresa($obj){
        try{
            
            $sql = "
                SELECT * FROM AnuncioImagem WHERE IdEmpresa = :IdEmpresa
            ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $obj["Var_IdEmpresa"], PDO::PARAM_INT);
            $query->execute();
            
            $obj = $this->carregaDados($query, 0, 0, 0, 0, 1, 0, 0, 0);
            
            return $obj;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaFacebookPorIdEmpresa($obj){
        try{
            
            $sql = "
                SELECT * FROM AnuncioFacebook WHERE IdEmpresa = :IdEmpresa AND Status = 'A'
            ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $obj["Var_IdEmpresa"], PDO::PARAM_INT);
            $query->execute();
            
            $obj = $this->carregaDados($query, 0, 0, 1, 0, 0, 0, 0, 0);
            
            return $obj;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaMapsPorIdEmpresa($obj){
        try{
            
            $sql = "
                SELECT * FROM AnuncioMaps WHERE IdEmpresa = :IdEmpresa AND Status = 'A'
            ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $obj["Var_IdEmpresa"], PDO::PARAM_INT);
            $query->execute();
            
            $obj = $this->carregaDados($query, 0, 0, 0, 0, 0, 0, 1, 0);
            
            return $obj;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaEnderecosPorIdEmpresa($obj){
        try{
            
            $sql = "
                SELECT * FROM AnuncioEndereco WHERE IdEmpresa = :IdEmpresa
            ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $obj["Var_IdEmpresa"], PDO::PARAM_INT);
            $query->execute();
            
            $obj = $this->carregaDados($query, 0, 1, 0, 0, 0, 0, 0, 0);
            
            return $obj;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaFiltro($obj){
        try{
            
            $query = $this->db->prepare($obj["sql"]);
            $query->execute();
            
            $obj = $this->carregaDados($query, $obj["opcoes"][0], $obj["opcoes"][1], $obj["opcoes"][2],
                    $obj["opcoes"][3], $obj["opcoes"][4], $obj["opcoes"][5], $obj["opcoes"][6], $obj["opcoes"][7]);
            
            return $obj;
            
        } catch (Exception $ex) {
            return NULL;
        }
    }
    
    public function buscaFiltroCategoria($obj){
        try{
            
            $sql = "
                CALL Anuncio_BuscaFiltroCategoria(:p1, :p2, :p3);
            ";

            $query = $this->db->prepare($sql);
            $query->bindValue(":p1", $obj["Var_Anunciando"], PDO::PARAM_BOOL);
            $query->bindValue(":p2", $obj["Var_Ordem"], PDO::PARAM_STR);
            $query->bindValue(":p3", $obj["Var_Categoria"], PDO::PARAM_STR);
            $query->execute();
            
            $obj = $this->carregaDados($query, 1, 0, 0, 1, 1, 1, 0, 1);
            
            return $obj;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaAnuncioGeral($limite){
        try{
            
            $sql = "
                CALL Anuncio_BuscaTodosGeral(:p1);
            ";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":p1", $limite, PDO::PARAM_INT);
            $query->execute();
            
            $obj = $this->carregaDados($query, 1, 0, 0, 1, 1, 0, 0, 1);
            
            return $obj;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaTodosImpulsionados(){
        try{
            
            $sql = "
                CALL Anuncio_BuscaTodosBasicoImpulsionado();
            ";
            
            $query = $this->db->prepare($sql);
            $query->execute();
            
            $obj = $this->carregaDados($query, 1, 0, 0, 1, 1, 0, 0, 1);
            
            return $obj;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaTodosPreencher($qnt){
        try{
            
            $sql = "
                CALL Anuncio_BuscaTodosBasicoPreencher(:p1);
            ";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":p1", $qnt, PDO::PARAM_INT);
            $query->execute();
            
            $obj = $this->carregaDados($query, 1, 0, 0, 1, 1, 0, 0, 1);

            return $obj;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaTodosBasico($obj){
        try{
            
            $sql = "
                CALL Anuncio_BuscaTodosBasicoImpulsionado();
            ";
            
            $query = $this->db->prepare($sql);
            $query->execute();
            
            $obj = $this->carregaDados($query, 1, 0, 0, 1, 1, 1, 0, 1);
            
            return $obj;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
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
    
    private function carregaDados($query, $apresentacao, $endereco, $facebook, $horarios, $imagem, $info, $maps, $empresa){
        $objCarregado = ["objApresentacao"=>null, "objEndereco"=>null, "objFacebook"=>null, "objHorarios"=>null,
            "objImagem"=>null, "objInfo"=>null, "objMaps"=>null, "objEmpresa"=>null];
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);  

        if($apresentacao){
            include_once("AnuncioApresentacao.php");
            $obj = new AnuncioApresentacao();
            $obj = $obj->carregaDadosFetch($dados);
            $objCarregado["objApresentacao"] = $obj;
        }
        if($endereco){
            include_once("AnuncioEndereco.php");
            $obj = new AnuncioEndereco();
            $obj = $obj->carregaDadosFetch($dados);
            $objCarregado["objEndereco"] = $obj;
        }
        if($facebook){
            include_once("AnuncioFacebook.php");
            $obj = new AnuncioFacebook();
            $obj = $obj->carregaDadosFetch($dados);
            $objCarregado["objFacebook"] = $obj;
        }
        if($horarios){
            include_once("AnuncioHorarios.php");
            $obj = new AnuncioHorarios();
            $obj = $obj->carregaDadosFetch($dados);
            $objCarregado["objHorarios"] = $obj;
        }
        if($imagem){
            include_once("AnuncioImagem.php");
            $obj = new AnuncioImagem();
            $obj = $obj->carregaDadosFetch($dados);
            $objCarregado["objImagem"] = $obj;
        }
        if($info){
            include_once("AnuncioInfo.php");
            $obj = new AnuncioInfo();
            $obj = $obj->carregaDadosFetch($dados);
            $objCarregado["objInfo"] = $obj;
        }
        if($maps){
            include_once("AnuncioMaps.php");
            $obj = new AnuncioMaps();
            $obj = $obj->carregaDadosFetch($dados);
            $objCarregado["objMaps"] = $obj;
        }
        if($empresa){
            include_once("Empresa.php");
            $obj = new Empresa();
            $obj = $obj->carregaDadosFetch($dados);
            $objCarregado["objEmpresa"] = $obj;
        }

        return $objCarregado;
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

    function getIdEmpresa() {
        return $this->IdEmpresa;
    }

    function getNomeExibicao() {
        return $this->NomeExibicao;
    }

    function getDescricaoCurta() {
        return $this->DescricaoCurta;
    }

    function getDescricaoLonga() {
        return $this->DescricaoLonga;
    }

    function getObservacao() {
        return $this->Observacao;
    }

    function getStatus() {
        return $this->Status;
    }

    function setIdEmpresa($IdEmpresa) {
        $this->IdEmpresa = $IdEmpresa;
    }

    function setNomeExibicao($NomeExibicao) {
        $this->NomeExibicao = $NomeExibicao;
    }

    function setDescricaoCurta($DescricaoCurta) {
        $this->DescricaoCurta = $DescricaoCurta;
    }

    function setDescricaoLonga($DescricaoLonga) {
        $this->DescricaoLonga = $DescricaoLonga;
    }

    function setObservacao($Observacao) {
        $this->Observacao = $Observacao;
    }

    function setStatus($Status) {
        $this->Status = $Status;
    }
    
    // </editor-fold>

}
