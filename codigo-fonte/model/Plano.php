<?php

include_once("../../php/InterfaceCRUD.php");
include_once("Dao.php");

class Plano implements InterfaceCRUD{
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">
    
    private $IdPlano;
    private $Valor;
    private $ValorDesconto;
    private $Duracao;
    private $Nome;
    private $TipoDia;
    private $TipoPlano;
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
            
            $sql = "
                SELECT * FROM empresa
                ";
                    
            $query = $this->db->prepare($sql);
            $query->execute();
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);
            return $dados;
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function busca($IdPlano) {
        try{
            $sql = " 
            SELECT * FROM Plano WHERE
            IdPlano = :IdPlano;
            ";
            
            $plano = new Plano();
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":IdPlano", $IdPlano, PDO::PARAM_INT);
            $query->execute();
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($dados as $listado){
                $plano->setIdPlano($listado["IdPlano"]);
                $plano->setValor($listado["Valor"]);
                $plano->setDuracao($listado["Duracao"]);
                $plano->setNome($listado["Nome"]);
                $plano->setTipoDia($listado["TipoDia"]);
                $plano->setTipoPlano($listado["TipoPlano"]);
                $plano->setValorDesconto($listado["ValorDesconto"]);
                $plano->setObservacao($listado["Observacao"]);
                $plano->setStatus($listado["Status"]);
            }
            
            return $plano;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function insere($objeto) {
        try{
            
            $pdo = $this->db;
            
            // inicia transacao
            $pdo->beginTransaction();
            
            // insere empresa
            $sql = "
                INSERT INTO Empresa
                (IdCliente, IdAnuncio, NomeEmpresa, TipoNegocio, Anunciando, Estado, Cidade)
                VALUES
                (:IdCliente, 0, :NomeEmpresa, :TipoNegocio, 1, 'SP', :Cidade);
            ";
            
            $query = $pdo->prepare($sql);
            $query->bindValue(":IdCliente", $objeto->getIdCliente(), PDO::PARAM_STR);
            $query->bindValue(":NomeEmpresa", $objeto->getNomeEmpresa(), PDO::PARAM_STR);
            $query->bindValue(":TipoNegocio", $objeto->getTipoNegocio(), PDO::PARAM_STR);
            $query->bindValue(":Cidade", $objeto->getCidade(), PDO::PARAM_STR);
            $resultado = $query->execute();

            if(!$resultado){
                $pdo->rollBack();
                return false;
            }
            
            // insere anuncio
            $id = $pdo->lastInsertId();
            $retorno = $this->insereAnuncio($objeto, $id, $pdo);

            if($retorno){
                $pdo->commit();
            }else{
                $pdo->rollBack();
                return false;
            }
            
            return true;

        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
        
    }
    
    public function remove($id) {
        // NAO E POSSIVEL REMOVER EMPRESAS
    }
    
    public function altera($atual, $novo) {
        // NAO E POSSIVEL ALTERAR EMPRESAS
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Metodos">  
    
    public function buscaPlanoPorCupom($objCupom){
        try{
            $sql = "
                SELECT * FROM Plano WHERE IdPlano = :IdPlano;
                ";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdPlano", $objCupom->getIdPlano(), PDO::PARAM_INT);
            $query->execute();
            
            $objPlanos = $this->carregaDados($query);
            
            return $objPlanos;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaTodosPlanosValidosAnuncioImpulsionado(){
        try{
            $sql = "
                SELECT * FROM Plano WHERE TipoPlano = 'Anúncio Impulsionado' AND Status = 1;
                ";
            
            $planos = array();
            
            $query = $this->db->prepare($sql);
            $query->execute();
            $dados = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($dados as $listado){
                $plano = new Plano();
                $plano->setIdPlano($listado["IdPlano"]);
                $plano->setValor($listado["Valor"]);
                $plano->setDuracao($listado["Duracao"]);
                $plano->setNome($listado["Nome"]);
                $plano->setTipoDia($listado["TipoDia"]);
                $plano->setTipoPlano($listado["TipoPlano"]);
                $plano->setValorDesconto($listado["ValorDesconto"]);
                $plano->setObservacao($listado["Observacao"]);
                $plano->setStatus($listado["Status"]);
                $planos[] = $plano;
            }
            
            return $planos;
            
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
    
    private function carregaDados($query){
        
        $planos = [];
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $plano = new Plano();
            $plano->setIdPlano($listado["IdPlano"]);
            $plano->setDuracao($listado["Duracao"]);
            $plano->setNome($listado["Nome"]);
            $plano->setValorDesconto($listado["ValorDesconto"]);
            $plano->setValor($listado["Valor"]);
            $plano->setTipoPlano($listado["TipoPlano"]);
            $plano->setTipoDia($listado["TipoDia"]);
            $plano->setStatus($listado["Status"]);
            $planos[] = $plano;
        }

        return $planos;
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

    function getIdPlano() {
        return $this->IdPlano;
    }

    function getValor() {
        return $this->Valor;
    }

    function getValorDesconto() {
        return $this->ValorDesconto;
    }

    function getDuracao() {
        return $this->Duracao;
    }

    function getNome() {
        return $this->Nome;
    }

    function getTipoDia() {
        return $this->TipoDia;
    }

    function getTipoPlano() {
        return $this->TipoPlano;
    }

    function getStatus() {
        return $this->Status;
    }
    
    function getObservacao() {
        return $this->Observacao;
    }

    function setObservacao($Observacao) {
        $this->Observacao = $Observacao;
    }
    
    function setIdPlano($IdPlano) {
        $this->IdPlano = $IdPlano;
    }

    function setValor($Valor) {
        $this->Valor = $Valor;
    }

    function setValorDesconto($ValorDesconto) {
        $this->ValorDesconto = $ValorDesconto;
    }

    function setDuracao($Duracao) {
        $this->Duracao = $Duracao;
    }

    function setNome($Nome) {
        $this->Nome = $Nome;
    }

    function setTipoDia($TipoDia) {
        $this->TipoDia = $TipoDia;
    }

    function setTipoPlano($TipoPlano) {
        $this->TipoPlano = $TipoPlano;
    }

    function setStatus($Status) {
        $this->Status = $Status;
    }
    
    // </editor-fold>
    
}
