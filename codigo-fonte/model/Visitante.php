<?php

include_once("../../php/InterfaceCRUD.php");
include_once("Dao.php");

class Visitante implements InterfaceCRUD{
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">
    
    private $IdVisitante;
    private $IdFacebook;
    private $LinkFacebook;
    private $Nome;
    private $Email;
    private $PrimeiroNome;
    private $Sobrenome;
    private $Sexo;
    private $DataCadastro;
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

    public function buscaTodos() {
        try{
            
            $query = $this->db->prepare("SELECT * FROM Visitante");
            $query->execute();
            
            $visitantes = $this->carregaDadosLista($query);
            
            return $visitantes;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function busca($IdVisitante) {
        try{
            
            $visitante = new Visitante();
            
            $query = $this->db->prepare("SELECT * FROM Visitante WHERE IdVisitante = :IdVisitante");
            $query->bindValue(":IdVisitante", $IdVisitante, PDO::PARAM_STR);
            $query->execute();
            
            $visitante = $this->carregaDados($query);
            
            return $visitante;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function insere($objeto) {
        try{
           
            $data = date("Y-m-d");
            
            $sql = "
                INSERT INTO Visitante
                (IdFacebook, LinkFacebook, Nome, Email, PrimeiroNome, Sobrenome, Sexo, DataCadastro, Status)
                VALUES
                (:IdFacebook, :LinkFacebook, :Nome, :Email, :PrimeiroNome, :Sobrenome, :Sexo, '$data', 1)
                ;";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":IdFacebook", $objeto->getIdFacebook(), PDO::PARAM_STR);
            $query->bindValue(":LinkFacebook", $objeto->getLinkFacebook(), PDO::PARAM_STR);
            $query->bindValue(":Nome", $objeto->getNome(), PDO::PARAM_STR);
            $query->bindValue(":Email", $objeto->getEmail(), PDO::PARAM_STR);
            $query->bindValue(":PrimeiroNome", $objeto->getPrimeiroNome(), PDO::PARAM_STR);
            $query->bindValue(":Sobrenome", $objeto->getSobrenome(), PDO::PARAM_STR);
            $query->bindValue(":Sexo", $objeto->getSexo(), PDO::PARAM_STR);
            $query->execute();
            $dados = $query->rowCount();
            if($dados == 1){
                return TRUE;
            }else{
                return FALSE;
            }
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
    
    public function buscaPorIdFacebook($objeto) {
        try{
            
            $visitante = new Visitante();
            
            $query = $this->db->prepare("SELECT * FROM Visitante WHERE IdFacebook = :IdFacebook");
            $query->bindValue(":IdFacebook", $objeto->getIdFacebook(), PDO::PARAM_STR);
            $query->execute();
            
            $visitante = $this->carregaDados($query);
            
            return $visitante;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Metodos Fixos e Estáticos">
    
    private function carregaDados($query){
        $visitante = new Visitante();
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $visitante->setIdVisitante($listado["IdVisitante"]);
            $visitante->setIdFacebook($listado["IdFacebook"]);
            $visitante->setLinkFacebook($listado["LinkFacebook"]);
            $visitante->setNome($listado["Nome"]);
            $visitante->setPrimeiroNome($listado["PrimeiroNome"]);
            $visitante->setSobrenome($listado["Sobrenome"]);
            $visitante->setSexo($listado["Sexo"]);
            $visitante->setDataCadastro($listado["DataCadastro"]);
            $visitante->setStatus($listado["Status"]);
        }
        return $visitante;
    }
    
    private function carregaDadosLista($query){
        $visitantes = [];
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $visitantes = new Visitante();
            $visitante->setIdVisitante($listado["IdVisitante"]);
            $visitante->setIdFacebook($listado["IdFacebook"]);
            $visitante->setLinkFacebook($listado["LinkFacebook"]);
            $visitante->setNome($listado["Nome"]);
            $visitante->setPrimeiroNome($listado["PrimeiroNome"]);
            $visitante->setSobrenome($listado["Sobrenome"]);
            $visitante->setSexo($listado["Sexo"]);
            $visitante->setDataCadastro($listado["DataCadastro"]);
            $visitante->setStatus($listado["Status"]);
            $visitantes[] = $visitante;
        }
        return $visitantes;
    }

    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Getters e Setters">
    
    function getIdVisitante() {
        return $this->IdVisitante;
    }

    function getIdFacebook() {
        return $this->IdFacebook;
    }

    function getNome() {
        return $this->Nome;
    }

    function getEmail() {
        return $this->Email;
    }

    function getPrimeiroNome() {
        return $this->PrimeiroNome;
    }

    function getSobrenome() {
        return $this->Sobrenome;
    }

    function getSexo() {
        return $this->Sexo;
    }

    function getDataCadastro() {
        return $this->DataCadastro;
    }

    function getObservacao() {
        return $this->Observacao;
    }

    function getStatus() {
        return $this->Status;
    }

    function getLinkFacebook() {
        return $this->LinkFacebook;
    }

    function setLinkFacebook($LinkFacebook) {
        $this->LinkFacebook = $LinkFacebook;
    }
    
    function setIdVisitante($IdVisitante) {
        $this->IdVisitante = $IdVisitante;
    }

    function setIdFacebook($IdFacebook) {
        $this->IdFacebook = $IdFacebook;
    }

    function setNome($Nome) {
        $this->Nome = $Nome;
    }

    function setEmail($Email) {
        $this->Email = $Email;
    }

    function setPrimeiroNome($PrimeiroNome) {
        $this->PrimeiroNome = $PrimeiroNome;
    }

    function setSobrenome($Sobrenome) {
        $this->Sobrenome = $Sobrenome;
    }

    function setSexo($Sexo) {
        $this->Sexo = $Sexo;
    }

    private function setDataCadastro($DataCadastro) {
        $this->DataCadastro = $DataCadastro;
    }

    function setObservacao($Observacao) {
        $this->Observacao = $Observacao;
    }

    function setStatus($Status) {
        $this->Status = $Status;
    }
    
     // </editor-fold>
    
}
