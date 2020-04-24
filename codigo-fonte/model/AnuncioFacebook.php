<?php

include_once("Dao.php");
include_once("../../php/InterfaceCRUD.php");

class AnuncioFacebook implements InterfaceCRUD{
    
    /***********************************************************************
     *  Relação com a tabela: AnuncioIntegracao
    ************************************************************************/
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">

    private $IdFacebook;
    private $IdEmpresa;
    private $IdPagina;
    private $NomePagina;
    private $LinkPagina;
    private $BoolCurtidas;
    private $BoolComentarios;
    private $BoolCompartilhar;
    private $BoolEnviar;
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
                UPDATE AnuncioFacebook
                SET
                BoolCurtidas = :BoolCurtidas,
                BoolComentarios = :BoolComentarios,
                BoolCompartilhar = :BoolCompartilhar,
                BoolEnviar = :BoolEnviar,
                Data = :Data
                WHERE
                IdEmpresa = :IdEmpresa
                AND
                Status = 'A'
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":BoolCurtidas", $novo->getBoolCurtidas(), PDO::PARAM_BOOL);
            $query->bindValue(":BoolComentarios", $novo->getBoolComentarios(), PDO::PARAM_BOOL);
            $query->bindValue(":BoolCompartilhar", $novo->getBoolCompartilhar(), PDO::PARAM_BOOL);
            $query->bindValue(":BoolEnviar", $novo->getBoolEnviar(), PDO::PARAM_BOOL);
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
                SELECT * FROM AnuncioFacebook
                WHERE IdEmpresa = :IdEmpresa
                AND Status = 'A'
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $id, PDO::PARAM_INT);
            $query->execute();
            
            $anuncioFacebook = $this->carregaDados($query);
            
            return $anuncioFacebook;
            
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
                UPDATE AnuncioFacebook SET Status = 'I', Data = :Data WHERE IdEmpresa = :IdEmpresa;
                INSERT INTO AnuncioFacebook
                (IdEmpresa, IdPagina, NomePagina, LinkPagina, Status, Data)
                VALUES
                (:IdEmpresa, :IdPagina, :NomePagina, :LinkPagina, 'A', :Data);
            ";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdPagina", $objeto->getIdPagina(), PDO::PARAM_INT);
            $query->bindValue(":NomePagina", $objeto->getNomePagina(), PDO::PARAM_STR);
            $query->bindValue(":LinkPagina", $objeto->getLinkPagina(), PDO::PARAM_STR);
            $query->bindValue(":Data", $this->dataAgora(true), PDO::PARAM_STR);
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
                Select * FROM AnuncioFacebook WHERE IdEmpresa = :IdEmpresa
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $IdEmpresa, PDO::PARAM_INT);
            $query->execute();
           
            $empresa = $this->carregaDados($query);
            
            return $empresa;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function alteraFacebook($atual, $novo){
        try{
            
            $sql = "
                UPDATE AnuncioIntegracao
                SET
                FacebookPagina = :FacebookPagina,
                IdFacebookPagina = :IdFacebookPagina,
                FacebookCurtidas = :FacebookCurtidas,
                FacebookComentarios = :FacebookComentarios
                WHERE
                IdAnuncio = :IdAnuncio
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":FacebookPagina", $novo->getFacebookPagina(), PDO::PARAM_STR);
            $query->bindValue(":IdFacebookPagina", $novo->getIdFacebookPagina(), PDO::PARAM_STR);
            $query->bindValue(":FacebookCurtidas", $novo->getFacebookCurtidas(), PDO::PARAM_STR);
            $query->bindValue(":FacebookComentarios", $novo->getFacebookComentarios(), PDO::PARAM_STR);
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
        
        $objFacebook = new AnuncioFacebook();
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $objFacebook->setIdFacebook($listado["IdFacebook"]);
            $objFacebook->setIdPagina($listado["IdPagina"]);
            $objFacebook->setNomePagina($listado["NomePagina"]);
            $objFacebook->setLinkPagina($listado["LinkPagina"]);
            $objFacebook->setBoolCurtidas($listado["BoolCurtidas"]);
            $objFacebook->setBoolComentarios($listado["BoolComentarios"]);
            $objFacebook->setBoolCompartilhar($listado["BoolCompartilhar"]);
            $objFacebook->setBoolEnviar($listado["BoolEnviar"]);
            $objFacebook->setStatus($listado["Status"]);
        }

        return $objFacebook;
    }
    
    public function carregaDadosFetch($dados){
        
        $objFacebook = new AnuncioFacebook();
        
        //$dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $objFacebook->setIdFacebook($listado["IdFacebook"]);
            $objFacebook->setIdPagina($listado["IdPagina"]);
            $objFacebook->setNomePagina($listado["NomePagina"]);
            $objFacebook->setLinkPagina($listado["LinkPagina"]);
            $objFacebook->setBoolCurtidas($listado["BoolCurtidas"]);
            $objFacebook->setBoolComentarios($listado["BoolComentarios"]);
            $objFacebook->setBoolCompartilhar($listado["BoolCompartilhar"]);
            $objFacebook->setBoolEnviar($listado["BoolEnviar"]);
            $objFacebook->setStatus($listado["Status"]);
        }

        return $objFacebook;
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

    function getIdFacebook() {
        return $this->IdFacebook;
    }

    function getIdEmpresa() {
        return $this->IdEmpresa;
    }

    function getIdPagina() {
        return $this->IdPagina;
    }

    function getNomePagina() {
        return $this->NomePagina;
    }

    function getLinkPagina() {
        return $this->LinkPagina;
    }

    function getBoolCurtidas() {
        return $this->BoolCurtidas;
    }

    function getBoolComentarios() {
        return $this->BoolComentarios;
    }

    function getBoolCompartilhar() {
        return $this->BoolCompartilhar;
    }

    function getBoolEnviar() {
        return $this->BoolEnviar;
    }

    function getData() {
        return $this->Data;
    }

    function getStatus() {
        return $this->Status;
    }

    function setStatus($Status) {
        $this->Status = $Status;
    }
    
    function setIdFacebook($IdFacebook) {
        $this->IdFacebook = $IdFacebook;
    }

    function setIdEmpresa($IdEmpresa) {
        $this->IdEmpresa = $IdEmpresa;
    }

    function setIdPagina($IdPagina) {
        $this->IdPagina = $IdPagina;
    }

    function setNomePagina($NomePagina) {
        $this->NomePagina = $NomePagina;
    }

    function setLinkPagina($LinkPagina) {
        $this->LinkPagina = $LinkPagina;
    }

    function setBoolCurtidas($BoolCurtidas) {
        $this->BoolCurtidas = $BoolCurtidas;
    }

    function setBoolComentarios($BoolComentarios) {
        $this->BoolComentarios = $BoolComentarios;
    }

    function setBoolCompartilhar($BoolCompartilhar) {
        $this->BoolCompartilhar = $BoolCompartilhar;
    }

    function setBoolEnviar($BoolEnviar) {
        $this->BoolEnviar = $BoolEnviar;
    }

    function setData($Data) {
        $this->Data = $Data;
    }

    // </editor-fold>

}
