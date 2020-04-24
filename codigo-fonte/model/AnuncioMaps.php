<?php

include_once("Dao.php");
include_once("../../php/InterfaceCRUD.php");

class AnuncioMaps implements InterfaceCRUD{
    
    /***********************************************************************
     *  Relação com a tabela: AnuncioIntegracao
    ************************************************************************/
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">

    private $IdMaps;
    private $IdEmpresa;
    private $IdEndereco;
    private $Latitude;
    private $Longitude;
    private $Data;
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
                UPDATE AnuncioMaps
                SET
                Latitude = :Latitude,
                Longitude = :Longitude,
                Status = :Status,
                Data = :Data
                WHERE
                IdEndereco = :IdEndereco
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":Latitude", $novo->getLatitude(), PDO::PARAM_STR);
            $query->bindValue(":Longitude", $novo->getLongitude(), PDO::PARAM_STR);
            $query->bindValue(":Status", $novo->getStatus(), PDO::PARAM_BOOL);
            $query->bindValue(":Data", $novo->dataAgora(true), PDO::PARAM_STR);
            $query->bindValue(":IdEndereco", $novo->getIdEndereco(), PDO::PARAM_STR);
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
                SELECT * FROM AnuncioMaps
                WHERE IdEmpresa = :IdEmpresa
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $id, PDO::PARAM_INT);
            $query->execute();
            
            $objMaps = $this->carregaDados($query);
            
            return $objMaps;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function buscaTodos() {
        
    }

    public function insere($objeto) {
        try{

            
            $sql = "
                INSERT INTO AnuncioMaps
                (IdEmpresa, IdEndereco, Latitude, Longitude, Data, Status)
                VALUES
                (:IdEmpresa, :IdEndereco, :Latitude, :Longitude, :Data, 'A');
            ";

            $query = $this->db->prepare($sql);
            $query->bindValue(":Latitude", $objeto->getLatitude(), PDO::PARAM_STR);
            $query->bindValue(":Longitude", $objeto->getLongitude(), PDO::PARAM_STR);
            $query->bindValue(":Data", $this->dataAgora(true), PDO::PARAM_STR);
            $query->bindValue(":IdEndereco", $objeto->getIdEndereco(), PDO::PARAM_INT);
            $query->bindValue(":IdEmpresa", $objeto->getIdEmpresa(), PDO::PARAM_INT);
            $query->execute();
            
            return $this->verificaDados($query);
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function remove($id) {
        try{
            
            $sql = "
                UPDATE AnuncioFacebook SET
                Status = 'I',
                Data = :Data
                WHERE IdEmpresa = :IdEmpresa;
            ";

            $query = $this->db->prepare($sql);
            $query->bindValue(":Data", $this->dataAgora(true), PDO::PARAM_STR);
            $query->bindValue(":IdEmpresa", $id, PDO::PARAM_INT);
            $query->execute();
            
            return $this->verificaDados($query);
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    
    public function buscaPorIdEmpresa($IdEmpresa){
        try{
            
            $sql = "
                Select * FROM AnuncioMaps WHERE IdEmpresa = :IdEmpresa
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $IdEmpresa, PDO::PARAM_INT);
            $query->execute();
           
            $maps = $this->carregaDados($query);
            
            return $maps;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function verificaExistente($IdEndereco){
        try{
            
            $sql = "
                SELECT * FROM AnuncioMaps
                WHERE IdEndereco = :IdEndereco
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEndereco", $IdEndereco, PDO::PARAM_INT);
            $query->execute();
            
            return $this->verificaDados($query);
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function alteraMaps($atual, $novo){
        try{
            
            $sql = "
                UPDATE AnuncioIntegracao
                SET
                GoogleMaps = :GoogleMaps
                WHERE
                IdAnuncio = :IdAnuncio
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":GoogleMaps", $novo->getGoogleMaps(), PDO::PARAM_STR);
            $query->bindValue(":IdAnuncio", $atual->getIdAnuncio(), PDO::PARAM_INT);
            $query->execute();
            $dados = $query->rowCount();
            if($dados == 1){
                return TRUE;
            }else{
                Mensagem::msgOperacaoErro();
                return FALSE;
            }
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    static function criaObjetoIntegracao($FacebookPagina, $IdFacebookPagina, $FacebookCurtidas, $FacebookComentarios, $GoogleMaps, $Observacao){
        $obj = new AnuncioIntegracao();
        $obj->setFacebookPagina($FacebookPagina);
        $obj->setIdFacebookPagina($IdFacebookPagina);
        $obj->setFacebookCurtidas($FacebookCurtidas);
        $obj->setFacebookComentarios($FacebookComentarios);
        $obj->setGoogleMaps($GoogleMaps);
        $obj->setObservacao($Observacao);
        return $obj;
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
        
        $objMapsx = [];
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $objMaps = new AnuncioMaps();
            $objMaps->setIdMaps($listado["IdMaps"]);
            $objMaps->setIdEndereco($listado["IdEndereco"]);
            $objMaps->setLatitude($listado["Latitude"]);
            $objMaps->setLongitude($listado["Longitude"]);
            $objMaps->setStatus($listado["Status"]);
            $objMapsx[] = $objMaps;
        }

        return $objMapsx;
    }
    
    public function carregaDadosFetch($dados){
        
        $objMapsx = [];
        
        //$dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $objMaps = new AnuncioMaps();
            $objMaps->setIdMaps($listado["IdMaps"]);
            $objMaps->setIdEndereco($listado["IdEndereco"]);
            $objMaps->setLatitude($listado["Latitude"]);
            $objMaps->setLongitude($listado["Longitude"]);
            $objMaps->setStatus($listado["Status"]);
            $objMapsx[] = $objMaps;
        }

        return $objMapsx;
    }

    private function verificaDados($query){
        $dados = $query->rowCount();
        if($dados >= 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Getters e Setters">

    function getIdMaps() {
        return $this->IdMaps;
    }

    function getIdEmpresa() {
        return $this->IdEmpresa;
    }

    function getIdEndereco() {
        return $this->IdEndereco;
    }

    function getLatitude() {
        return $this->Latitude;
    }

    function getLongitude() {
        return $this->Longitude;
    }

    function getData() {
        return $this->Data;
    }

    function getStatus() {
        return $this->Status;
    }

    function setIdMaps($IdMaps) {
        $this->IdMaps = $IdMaps;
    }

    function setIdEmpresa($IdEmpresa) {
        $this->IdEmpresa = $IdEmpresa;
    }

    function setIdEndereco($IdEndereco) {
        $this->IdEndereco = $IdEndereco;
    }

    function setLatitude($Latitude) {
        $this->Latitude = $Latitude;
    }

    function setLongitude($Longitude) {
        $this->Longitude = $Longitude;
    }

    function setData($Data) {
        $this->Data = $Data;
    }

    function setStatus($Status) {
        $this->Status = $Status;
    }
    
    // </editor-fold>

}
