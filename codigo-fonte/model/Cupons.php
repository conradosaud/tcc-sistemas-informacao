<?php

include_once("Dao.php");

class Cupons {
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">
    
    private $IdCupom;
    private $IdPlano;
    private $Codigo;
    private $Desconto;
    private $DataVencimento;
    private $Status;
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Construtor">
    
    private $db;
    public function __construct(){
        $db = new Dao();
        $this->db = $db->instance();
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    
    public function geraCupom(){
        $codigo = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVXWYZ0123456789"), 0, 7);
        $data = Date('Y:m:d H:i:s', strtotime("+1 days"));
        
        $sql = "
            INSERT INTO Cupons
            (IdPlano, Codigo, Desconto, DataVencimento, Status)
            VALUES
            (:IdPlano, :Codigo, :Desconto, :DataVencimento, :Status);
            ";
        
        $query = $this->db->prepare($sql);
        $query->bindValue(":IdPlano", 17, PDO::PARAM_INT);
        $query->bindValue(":Codigo", $codigo, PDO::PARAM_STR);
        $query->bindValue(":Desconto", NULL, PDO::PARAM_NULL);
        $query->bindValue(":DataVencimento", $data, PDO::PARAM_STR);
        $query->bindValue(":Status", "A", PDO::PARAM_STR);
        $query->execute();
        
        if(!$this->verificaDados($query)){
            $codigo = NULL;
        }
        
        return $codigo;       
    }
    
    public function verificaCupomPorCodigo($codigo){
        try{

            $sql = "
                SELECT * FROM Cupons
                WHERE Codigo = :Codigo
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":Codigo", $codigo, PDO::PARAM_STR);
            $query->execute();
            
            $cupom = NULL;
            
            if($this->verificaDados($query)){
                $cupom = $this->carregaDados($query);
            }
            
            return $cupom;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function invalidaCupom($IdCupom){
        try{

            $sql = "
                UPDATE Cupons SET Status = 'I' WHERE IdCupom = :IdCupom
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdCupom", $IdCupom, PDO::PARAM_INT);
            $query->execute();
            
            return $this->verificaDados($query);
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos Fixos e estáticos">
    
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
        
        $cupons = [];
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $cupom = new Cupons();
            $cupom->setIdCupom($listado["IdCupom"]);
            $cupom->setIdPlano($listado["IdPlano"]);
            $cupom->setCodigo($listado["Codigo"]);
            $cupom->setDesconto($listado["Desconto"]);
            $cupom->setDataVencimento($listado["DataVencimento"]);
            $cupom->setStatus($listado["Status"]);
            $cupons[] = $cupom;
        }

        return $cupons;
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
    
    function getIdCupom() {
        return $this->IdCupom;
    }

    function getIdPlano() {
        return $this->IdPlano;
    }

    function getCodigo() {
        return $this->Codigo;
    }

    function getDataVencimento() {
        return $this->DataVencimento;
    }

    function getStatus() {
        return $this->Status;
    }

    function getDesconto() {
        return $this->Desconto;
    }

    function setDesconto($Desconto) {
        $this->Desconto = $Desconto;
    }
    
    function setIdCupom($IdCupom) {
        $this->IdCupom = $IdCupom;
    }

    function setIdPlano($IdPlano) {
        $this->IdPlano = $IdPlano;
    }

    function setCodigo($Codigo) {
        $this->Codigo = $Codigo;
    }

    function setDataVencimento($DataVencimento) {
        $this->DataVencimento = $DataVencimento;
    }

    function setStatus($Status) {
        $this->Status = $Status;
    }
    
    // </editor-fold>
}
