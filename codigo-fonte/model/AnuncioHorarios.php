<?php

include_once("Dao.php");
include_once("../../php/InterfaceCRUD.php");

class AnuncioHorarios implements InterfaceCRUD{
    
    /***********************************************************************
     *  Relação com a tabela: AnuncioInfo
    ************************************************************************/
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">

    private $IdEmpresa;
    private $SegundaDas;
    private $SegundaAs;
    private $TercaDas;
    private $TercaAs;
    private $QuartaDas;
    private $QuartaAs;
    private $QuintaDas;
    private $QuintaAs;
    private $SextaDas;
    private $SextaAs;
    private $SabadoDas;
    private $SabadoAs;
    private $DomingoDas;
    private $DomingoAs;
    private $Todo;
    
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
                UPDATE AnuncioHorarios
                SET
                SegundaDas = :SegundaDas,
                SegundaAs = :SegundaAs,
                TercaDas = :TercaDas,
                TercaAs = :TercaAs,
                QuartaDas = :QuartaDas,
                QuartaAs = :QuartaAs,
                QuintaDas = :QuintaDas,
                QuintaAs = :QuintaAs,
                SextaDas = :SextaDas,
                SextaAs = :SextaAs,
                SabadoDas = :SabadoDas,
                SabadoAs = :SabadoAs,
                DomingoDas = :DomingoDas,
                DomingoAs = :DomingoAs,
                Data = :Data
                WHERE
                IdEmpresa = :IdEmpresa
                ;";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":SegundaDas", $novo->segunda->das, PDO::PARAM_STR);
            $query->bindValue(":SegundaAs", $novo->segunda->as, PDO::PARAM_STR);
            $query->bindValue(":TercaDas", $novo->terca->das, PDO::PARAM_STR);
            $query->bindValue(":TercaAs", $novo->terca->as, PDO::PARAM_STR);
            $query->bindValue(":QuartaDas", $novo->quarta->das, PDO::PARAM_STR);
            $query->bindValue(":QuartaAs", $novo->quarta->as, PDO::PARAM_STR);
            $query->bindValue(":QuintaDas", $novo->quinta->das, PDO::PARAM_STR);
            $query->bindValue(":QuintaAs", $novo->quinta->as, PDO::PARAM_STR);
            $query->bindValue(":SextaDas", $novo->sexta->das, PDO::PARAM_STR);
            $query->bindValue(":SextaAs", $novo->sexta->as, PDO::PARAM_STR);
            $query->bindValue(":SabadoDas", $novo->sabado->das, PDO::PARAM_STR);
            $query->bindValue(":SabadoAs", $novo->sabado->as, PDO::PARAM_STR);
            $query->bindValue(":DomingoDas", $novo->domingo->das, PDO::PARAM_STR);
            $query->bindValue(":DomingoAs", $novo->domingo->as, PDO::PARAM_STR);
            $query->bindValue(":Data", $this->dataAgora(true), PDO::PARAM_STR);
            $query->bindValue(":IdEmpresa", $atual, PDO::PARAM_INT);
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
                SELECT * FROM AnuncioHorarios
                WHERE IdEmpresa = :IdEmpresa
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $id, PDO::PARAM_INT);
            $query->execute();
            
            $anuncioHorarios = $this->carregaDados($query);
            
            return $anuncioHorarios;
            
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
    
    private function carregaDados($query){
        
        $anuncioHorarios = [];
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $anuncioHorario = new AnuncioHorarios();
            $anuncioHorario->setSegundaDas($listado["SegundaDas"]);
            $anuncioHorario->setSegundaAs($listado["SegundaAs"]);
            $anuncioHorario->setTercaDas($listado["TercaDas"]);
            $anuncioHorario->setTercaAs($listado["TercaAs"]);
            $anuncioHorario->setQuartaDas($listado["QuartaDas"]);
            $anuncioHorario->setQuartaAs($listado["QuartaAs"]);
            $anuncioHorario->setQuintaDas($listado["QuintaDas"]);
            $anuncioHorario->setQuintaAs($listado["QuintaAs"]);
            $anuncioHorario->setSextaDas($listado["SextaDas"]);
            $anuncioHorario->setSextaAs($listado["SextaAs"]);
            $anuncioHorario->setSabadoDas($listado["SabadoDas"]);
            $anuncioHorario->setSabadoAs($listado["SabadoAs"]);
            $anuncioHorario->setDomingoDas($listado["DomingoDas"]);
            $anuncioHorario->setDomingoAs($listado["DomingoAs"]);
            $anuncioHorarios[] = $anuncioHorario;
        }

        return $anuncioHorarios[0];
    }
    
    public function carregaDadosFetch($dados){
        
        $anuncioHorarios = [];
        
        //$dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $anuncioHorario = new AnuncioHorarios();
            $anuncioHorario->setSegundaDas($listado["SegundaDas"]);
            $anuncioHorario->setSegundaAs($listado["SegundaAs"]);
            $anuncioHorario->setTercaDas($listado["TercaDas"]);
            $anuncioHorario->setTercaAs($listado["TercaAs"]);
            $anuncioHorario->setQuartaDas($listado["QuartaDas"]);
            $anuncioHorario->setQuartaAs($listado["QuartaAs"]);
            $anuncioHorario->setQuintaDas($listado["QuintaDas"]);
            $anuncioHorario->setQuintaAs($listado["QuintaAs"]);
            $anuncioHorario->setSextaDas($listado["SextaDas"]);
            $anuncioHorario->setSextaAs($listado["SextaAs"]);
            $anuncioHorario->setSabadoDas($listado["SabadoDas"]);
            $anuncioHorario->setSabadoAs($listado["SabadoAs"]);
            $anuncioHorario->setDomingoDas($listado["DomingoDas"]);
            $anuncioHorario->setDomingoAs($listado["DomingoAs"]);
            $anuncioHorarios[] = $anuncioHorario;
        }

        return $anuncioHorarios;
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

    function getSegundaDas() {
        return $this->SegundaDas;
    }

    function getSegundaAs() {
        return $this->SegundaAs;
    }

    function getTercaDas() {
        return $this->TercaDas;
    }

    function getTercaAs() {
        return $this->TercaAs;
    }

    function getQuartaDas() {
        return $this->QuartaDas;
    }

    function getQuartaAs() {
        return $this->QuartaAs;
    }

    function getQuintaDas() {
        return $this->QuintaDas;
    }

    function getQuintaAs() {
        return $this->QuintaAs;
    }

    function getSextaDas() {
        return $this->SextaDas;
    }

    function getSextaAs() {
        return $this->SextaAs;
    }

    function getSabadoDas() {
        return $this->SabadoDas;
    }

    function getSabadoAs() {
        return $this->SabadoAs;
    }

    function getDomingoDas() {
        return $this->DomingoDas;
    }

    function getDomingoAs() {
        return $this->DomingoAs;
    }
    
    function getTodo() {
        return $this->Todo;
    }

    function setTodo($Todo) {
        $this->Todo = $Todo;
    }
    
    function setIdEmpresa($IdEmpresa) {
        $this->IdEmpresa = $IdEmpresa;
    }

    function setSegundaDas($SegundaDas) {
        $this->SegundaDas = $SegundaDas;
    }

    function setSegundaAs($SegundaAs) {
        $this->SegundaAs = $SegundaAs;
    }

    function setTercaDas($TercaDas) {
        $this->TercaDas = $TercaDas;
    }

    function setTercaAs($TercaAs) {
        $this->TercaAs = $TercaAs;
    }

    function setQuartaDas($QuartaDas) {
        $this->QuartaDas = $QuartaDas;
    }

    function setQuartaAs($QuartaAs) {
        $this->QuartaAs = $QuartaAs;
    }

    function setQuintaDas($QuintaDas) {
        $this->QuintaDas = $QuintaDas;
    }

    function setQuintaAs($QuintaAs) {
        $this->QuintaAs = $QuintaAs;
    }

    function setSextaDas($SextaDas) {
        $this->SextaDas = $SextaDas;
    }

    function setSextaAs($SextaAs) {
        $this->SextaAs = $SextaAs;
    }

    function setSabadoDas($SabadoDas) {
        $this->SabadoDas = $SabadoDas;
    }

    function setSabadoAs($SabadoAs) {
        $this->SabadoAs = $SabadoAs;
    }

    function setDomingoDas($DomingoDas) {
        $this->DomingoDas = $DomingoDas;
    }

    function setDomingoAs($DomingoAs) {
        $this->DomingoAs = $DomingoAs;
    }
    
    // </editor-fold>

}
