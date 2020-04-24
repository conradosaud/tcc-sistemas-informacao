<?php

include_once("../../php/InterfaceCRUD.php");
include_once("Dao.php");

class Cliente implements InterfaceCRUD{
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">
    
    private $IdCliente;
    private $Nome;
    private $Cpf;
    private $Email;
    private $Senha;
    private $Telefone1;
    private $Telefone2;
    private $Observacao;
    private $DataCadastro;
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

    public function buscaTodos() {
        try{
            
            $cliente = new Cliente();
            
            $query = $this->db->prepare("SELECT * FROM Cliente");
            $query->execute();
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($dados as $listado){
                $cliente->setIdCliente($listado["IdCliente"]);
                $cliente->setCpf($listado["Cpf"]);
                $cliente->setNome($listado["Nome"]);
                $cliente->setTelefone1($listado["Telefone1"]);
                $cliente->setTelefone2($listado["Telefone2"]);
                $cliente->setEmail($listado["Email"]);
                $cliente->setStatus($listado["Status"]);
            }
            
            return $cliente;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function busca($IdCliente) {
        try{
            $query = $this->db->prepare("SELECT * FROM Cliente WHERE IdCliente = :IdCliente");
            $query->bindValue(":IdCliente", $IdCliente, PDO::PARAM_STR);
            $query->execute();
            
            $cliente = $this->carregaDados($query);
            
            return $cliente;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function insere($objeto) {
        try{
            
            $sql = "
                INSERT INTO Cliente
                (Nome, Email, Telefone1, Senha, DataCadastro, Status)
                VALUES
                (:Nome, :Email, :Telefone1, :Senha, :DataCadastro, 'A')
                ;";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":Nome", $objeto->getNome(), PDO::PARAM_STR);
            $query->bindValue(":Email", $objeto->getEmail(), PDO::PARAM_STR);
            $query->bindValue(":Telefone1", $objeto->getTelefone1(), PDO::PARAM_STR);
            $query->bindValue(":Senha", $objeto->getSenha(), PDO::PARAM_STR);
            $query->bindValue(":DataCadastro", $this->dataAgora(false), PDO::PARAM_STR);
            $query->execute();
            
            return $this->verificaDados($query);
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function remove($id) {
        // NAO E POSSIVEL REMOVER USUARIOS
    }
    
    public function altera($atual, $novo) {
        // NAO E POSSIVEL ALTERAR USUARIOS
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Metodos">
    
    public function verificaEmail($Email){
        try{
            
            $sql = "SELECT * FROM Cliente Where Email = :Email
            ;";
           
            $query = $this->db->prepare($sql);
            $query->bindValue(":Email", $Email, PDO::PARAM_STR);
            $query->execute();
            
            $cliente = $this->verificaDados($query);
            
            return $cliente;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function alteraInformacoes($objnull, $obj){
        try{
            
            $sql = "UPDATE Cliente
                    SET Nome = :Nome,
                    Email = :Email,
                    Telefone1 = :Telefone1
                WHERE IdCliente = :IdCliente
            ;";
           
            $query = $this->db->prepare($sql);
            $query->bindValue(":Nome", $obj->getNome(), PDO::PARAM_STR);
            $query->bindValue(":Email", $obj->getEmail(), PDO::PARAM_STR);
            $query->bindValue(":Telefone1", $obj->getTelefone1(), PDO::PARAM_STR);
            $query->bindValue(":IdCliente", $obj->getIdCliente(), PDO::PARAM_INT);
            $query->execute();
            
            $cliente = $this->verificaDados($query);
            
            return $cliente;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function alteraSenha($objAtual, $objNovo){
        try{
            
            $sql = "UPDATE Cliente
                    SET Senha = :SenhaNova
                WHERE Senha = :SenhaAtual
                AND
                IdCliente = :IdCliente
            ;";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":SenhaNova", $objNovo->getSenha(), PDO::PARAM_STR);
            $query->bindValue(":SenhaAtual", $objAtual, PDO::PARAM_STR);
            $query->bindValue(":IdCliente", $objNovo->getIdCliente(), PDO::PARAM_INT);
            $query->execute();
            
            $cliente = $this->verificaDados($query);
            
            return $cliente;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscarPorEmail($Email){
        try{
            
            $cliente = new Cliente();
            
            $query = $this->db->prepare("SELECT * FROM Cliente WHERE Email = :Email");
            $query->bindValue(":Email", $Email, PDO::PARAM_STR);
            $query->execute();
            
            $cliente = $this->carregaDados($query);
            
            return $cliente;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function verificaSenha($Senha, $IdCliente){
        $cliente = new Cliente();

        $query = $this->db->prepare("SELECT * FROM Cliente WHERE Senha = :Senha AND IdCliente = :IdCliente;");
        $query->bindValue(":Senha", $Senha, PDO::PARAM_STR);
        $query->bindValue(":IdCliente", $IdCliente, PDO::PARAM_STR);
        $query->execute();
        $dados = $query->rowCount();
        if($dados == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Metodos Fixos e Estáticos">
    
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

    private function verificaDados($query){
        $dados = $query->rowCount();
        if($dados == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function autenticarCliente($Email, $Senha){
        try{
            
            $sql = "
                SELECT * FROM Cliente WHERE
                Email = :Email AND Senha = :Senha
                ;";
            
            $cliente = new Cliente();
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":Email", $Email, PDO::PARAM_STR);
            $query->bindValue(":Senha", $Senha, PDO::PARAM_STR);
            $query->execute();
            
            $cliente = $this->carregaDados($query);

            return $cliente;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    private function carregaDados($query){
        
        $clientes = [];
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $cliente = new Cliente();
            $cliente->setIdCliente($listado["IdCliente"]);
            $cliente->setNome($listado["Nome"]);
            $cliente->setTelefone1($listado["Telefone1"]);
            $cliente->setEmail($listado["Email"]);
            $cliente->setStatus($listado["Status"]);
            
            $clientes[] = $cliente;
        }
        
        switch(count($clientes)){
            case 0:
                return NULL;
            case 1:
                return $clientes[0];
            default:
                return $clientes;
        }
    }

    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Getters e Setters">
    
    function getIdCliente() {
        return $this->IdCliente;
    }

    function getNome() {
        return $this->Nome;
    }

    function getCpf() {
        return $this->Cpf;
    }

    function getEmail() {
        return $this->Email;
    }

    function getSenha() {
        return $this->Senha;
    }

    function getTelefone1() {
        return $this->Telefone1;
    }

    function getTelefone2() {
        return $this->Telefone2;
    }

    function getObservacao() {
        return $this->Observacao;
    }

    function getDataCadastro() {
        return $this->DataCadastro;
    }
    
    function getStatus() {
        return $this->Status;
    }

    function setStatus($Status) {
        $this->Status = $Status;
    }
    
    function setIdCliente($IdCliente) {
        $this->IdCliente = $IdCliente;
    }

    function setNome($Nome) {
        $this->Nome = $Nome;
    }

    function setCpf($Cpf) {
        $this->Cpf = $Cpf;
    }

    function setEmail($Email) {
        $this->Email = $Email;
    }

    function setSenha($Senha) {
        $this->Senha = $Senha;
    }

    function setTelefone1($Telefone1) {
        $this->Telefone1 = $Telefone1;
    }

    function setTelefone2($Telefone2) {
        $this->Telefone2 = $Telefone2;
    }

    function setObservacao($Observacao) {
        $this->Observacao = $Observacao;
    }

    function setDataCadastro($DataCadastro) {
        $this->DataCadastro = $DataCadastro;
    }
    
     // </editor-fold>
    
}
