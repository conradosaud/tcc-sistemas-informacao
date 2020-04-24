<?php

include_once("Dao.php");
include_once("../../php/InterfaceCRUD.php");

class AnuncioApresentacao implements InterfaceCRUD{
    
    /***********************************************************************
     *  Relação com a tabela: AnuncioApresentacao
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
    
    public function carregaDadosFetch($dados){
        
        $anuncioApresentacoes = [];
        
        //$dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $anuncioApresentacao = new AnuncioApresentacao();
            $anuncioApresentacao->setIdEmpresa($listado["IdEmpresa"]);
            $anuncioApresentacao->setNomeExibicao($listado["NomeExibicao"]);
            $anuncioApresentacao->setDescricaoCurta($listado["DescricaoCurta"]);
            $anuncioApresentacao->setDescricaoLonga($listado["DescricaoLonga"]);
            $anuncioApresentacao->setStatus($listado["Status"]);
            $anuncioApresentacoes[] = $anuncioApresentacao;
        }

        return $anuncioApresentacoes;
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
