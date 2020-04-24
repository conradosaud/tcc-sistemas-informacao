<?php

include_once("Dao.php");
include_once("../../php/InterfaceCRUD.php");

class AnuncioInfo implements InterfaceCRUD{
    
    /***********************************************************************
     *  Relação com a tabela: AnuncioInfo
    ************************************************************************/
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">

    private $IdEmpresa;
    private $EntregaDomicilio;
    private $AtendeLocal;
    private $Estacionamento;
    private $Observacao;
    
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
                UPDATE AnuncioInfo
                SET
                EntregaDomicilio = :EntregaDomicilio,
                AtendeLocal = :AtendeLocal,
                Estacionamento = :Estacionamento,
                Data = :Data
                WHERE
                IdEmpresa = :IdEmpresa
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":EntregaDomicilio", $novo->getEntregaDomicilio(), PDO::PARAM_STR);
            $query->bindValue(":AtendeLocal", $novo->getAtendeLocal(), PDO::PARAM_STR);
            $query->bindValue(":Estacionamento", $novo->getEstacionamento(), PDO::PARAM_STR);
            $query->bindValue(":Data", $this->dataAgora(true), PDO::PARAM_STR);
            $query->bindValue(":IdEmpresa", $atual, PDO::PARAM_INT);
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

    public function busca($id) {
        try{
            
            $sql = "
                SELECT * FROM AnuncioInfo
                WHERE IdEmpresa = :IdEmpresa
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $id, PDO::PARAM_INT);
            $query->execute();
            
            $anuncioInfo = $this->carregaDados($query);
            
            return $anuncioInfo;
            
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
    
    static function criaObjetoInfo($EntregaDomicilio, $HorarioFuncionamento, $AtendeLocal, $Observacao){
        $obj = new AnuncioInfo();
        $obj->setEntregaDomicilio($EntregaDomicilio);
        $obj->setHorarioFuncionamento($HorarioFuncionamento);
        $obj->setAtendeLocal($AtendeLocal);
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
    
    public function carregaDados($query){
        
        $anuncioInfos = [];
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $anuncioInfo = new AnuncioInfo();
            $anuncioInfo->setEntregaDomicilio($listado["EntregaDomicilio"]);
            $anuncioInfo->setAtendeLocal($listado["AtendeLocal"]);
            $anuncioInfo->setEstacionamento($listado["Estacionamento"]);
            $anuncioInfos[] = $anuncioInfo;
        }

        switch(count($anuncioInfos)){
            case 0:
                return NULL;
            case 1:
                return $anuncioInfos[0];
            default:
                return $anuncioInfos;
        }
        
        return $anuncioInfos;
    }
    
    public function carregaDadosFetch($dados){
        
        $anuncioInfos = [];
        
        //$dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $anuncioInfo = new AnuncioInfo();
            $anuncioInfo->setEntregaDomicilio($listado["EntregaDomicilio"]);
            $anuncioInfo->setAtendeLocal($listado["AtendeLocal"]);
            $anuncioInfo->setEstacionamento($listado["Estacionamento"]);
            $anuncioInfos[] = $anuncioInfo;
        }

        return $anuncioInfos;
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

    function getEntregaDomicilio() {
        return $this->EntregaDomicilio;
    }

    function getHorarioFuncionamento() {
        return $this->HorarioFuncionamento;
    }

    function getAtendeLocal() {
        return $this->AtendeLocal;
    }

    function getObservacao() {
        return $this->Observacao;
    }
    
    function getIdEmpresa() {
        return $this->IdEmpresa;
    }

    function getEstacionamento() {
        return $this->Estacionamento;
    }

    function setIdEmpresa($IdEmpresa) {
        $this->IdEmpresa = $IdEmpresa;
    }

    function setEstacionamento($Estacionamento) {
        $this->Estacionamento = $Estacionamento;
    }
    
    function setEntregaDomicilio($EntregaDomicilio) {
        $this->EntregaDomicilio = $EntregaDomicilio;
    }

    function setHorarioFuncionamento($HorarioFuncionamento) {
        $this->HorarioFuncionamento = $HorarioFuncionamento;
    }

    function setAtendeLocal($AtendeLocal) {
        $this->AtendeLocal = $AtendeLocal;
    }

    function setObservacao($Observacao) {
        $this->Observacao = $Observacao;
    }
    
    // </editor-fold>

}
