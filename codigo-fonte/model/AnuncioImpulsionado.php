<?php

include_once("../../php/InterfaceCRUD.php");
include_once("Dao.php");

class AnuncioImpulsionado implements InterfaceCRUD{
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">
    
    private $IdAnuncioImpulsionado;
    private $IdEmpresa;
    private $IdPlano;
    private $IdTransacao;
    private $DataDuracao;
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
                WHERE Status = 'A';
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
    
    public function busca($IdEmpresa) {
        try{
            $sql = " 
            SELECT * FROM Empresa WHERE
            IdEmpresa = :IdEmpresa
            AND Status = 'A';
            ";
            
            $empresas = array();
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $IdEmpresa, PDO::PARAM_INT);
            $query->execute();
            
            $empresas = $this->carregaDados($query);
            
            return $empresas;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function insere($objeto) {
        try{

            $sql = "
                INSERT INTO AnuncioImpulsionado
                (IdEmpresa, IdPlano, IdTransacao, DataDuracao, Status)
                VALUES
                (:IdEmpresa, :IdPlano, :IdTransacao, :DataDuracao, 'G');
            ";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $objeto->getIdEmpresa(), PDO::PARAM_INT);
            $query->bindValue(":IdPlano", $objeto->getIdPlano(), PDO::PARAM_INT);
            $query->bindValue(":IdTransacao", $objeto->getIdTransacao(), PDO::PARAM_INT);
            $query->bindValue(":DataDuracao", $objeto->getDataDuracao(), PDO::PARAM_STR);
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
            UPDATE Empresa
            SET Status = 'I', Anunciando = 0
            WHERE IdEmpresa = :IdEmpresa;
            ";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $id, PDO::PARAM_INT);
            $query->execute();
            
            $empresa = $this->verificaDados($query);
            
            return $empresa;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function altera($atual, $novo) {
        try{
            $sql = " 
            UPDATE Empresa
            SET NomeEmpresa = :NomeEmpresa,
            TipoNegocio = :TipoNegocio,
            Email = :Email,
            Site = :Site,
            Data = :Data
            WHERE IdEmpresa = :IdEmpresa;
            ";

            $query = $this->db->prepare($sql);
            $query->bindValue(":NomeEmpresa", $novo->getNomeEmpresa(), PDO::PARAM_STR);
            $query->bindValue(":TipoNegocio", $novo->getTipoNegocio(), PDO::PARAM_STR);
            $query->bindValue(":Email", $novo->getEmail(), PDO::PARAM_STR);
            $query->bindValue(":Site", $novo->getSite(), PDO::PARAM_STR);
            $query->bindValue(":Data", $this->dataAgora(true), PDO::PARAM_STR);
            $query->bindValue(":IdEmpresa", $atual, PDO::PARAM_INT);
            $query->execute();
            
            $empresa = $this->verificaDados($query);
            
            return $empresa;
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Metodos">  
    
    public function alteraAnunciando($IdEmpresa, $Anunciando){
        try{
            
            $sql = "
                UPDATE Empresa
                SET Anunciando = :Anunciando
                WHERE IdEmpresa = :IdEmpresa;
                ";

            $query = $this->db->prepare($sql);
            $query->bindValue(":Anunciando", $Anunciando, PDO::PARAM_BOOL);
            $query->bindValue(":IdEmpresa", $IdEmpresa, PDO::PARAM_INT);
            $query->execute();
            
            return $this->verificaDados($query);
                     
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaTodosPorCliente($id){
        try{
            
            $sql = "
                SELECT * FROM Empresa
                WHERE IdCliente = :IdCliente AND Status = 'A' order by Anunciando;
                ";
            
            $empresas = array();
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":IdCliente", $id, PDO::PARAM_STR);
            $query->execute();
            
            $empresas = $this->carregaDados($query);
            
            return $empresas;
                     
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaEmpresaAnuncioApresentacao($idCliente){
        try{
            
            $sql = "
                CALL Empresa_SelecionaAnuncioApresentacao(:IdCliente);
                ";
            
            $empresas = array();
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":IdCliente", $idCliente, PDO::PARAM_INT);
            $query->execute();
            while($listado = $query->fetch(PDO::FETCH_ASSOC)){
                $empresa = new Empresa();
                $nomeExibicao = "";
                
                $empresa->setIdCliente($listado["IdCliente"]);
                $empresa->setIdEmpresa($listado["IdEmpresa"]);
                $empresa->setIdAnuncio($listado["IdAnuncio"]);
                $empresa->setAnunciando($listado["Anunciando"]);
                $empresa->setNomeEmpresa($listado["NomeEmpresa"]);
                $empresa->setTipoNegocio($listado["TipoNegocio"]);
                $empresa->setCidade($listado["Cidade"]);
                $empresa->setEstado($listado["Estado"]);
                
                $nomeExibicao = $listado["NomeExibicao"];
                
                $array = [];
                $array[] = $empresa;
                $array[] = $nomeExibicao;
                
                $empresas[] = $array;
            }
            
            return $empresas;
                     
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function buscaEmpresaIdAnuncio($idAnuncio){
        try{
            
            $sql = "
                SELECT * FROM Empresa WHERE IdAnuncio = :IdAnuncio AND Status = 'A';
                ";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":IdAnuncio", $idAnuncio, PDO::PARAM_INT);
            $query->execute();
            while($listado = $query->fetch(PDO::FETCH_ASSOC)){
                $empresa = new Empresa();
                $nomeExibicao = "";
                
                $empresa->setIdCliente($listado["IdCliente"]);
                $empresa->setIdEmpresa($listado["IdEmpresa"]);
                $empresa->setIdAnuncio($listado["IdAnuncio"]);
                $empresa->setAnunciando($listado["Anunciando"]);
                $empresa->setNomeEmpresa($listado["NomeEmpresa"]);
                $empresa->setTipoNegocio($listado["TipoNegocio"]);
                $empresa->setCidade($listado["Cidade"]);
                $empresa->setEstado($listado["Estado"]);
            }
            
            return $empresa;
                     
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    public function verificaAnuncioEmpresa($idEmpresa, $idCliente){
        try{
            
            $sql = "
                SELECT * FROM Empresa
                WHERE Empresa.IdEmpresa = :IdEmpresa
                AND Empresa.IdCliente = :IdCliente;
                AND Status = 'A';
                ";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $idEmpresa, PDO::PARAM_INT);
            $query->bindValue(":IdCliente", $idCliente, PDO::PARAM_INT);
            $query->execute();
            
            return $this->verificaDados($query);
                     
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    private function insereAnuncio($obj, $IdEmpresa, $pdo){

        $sqlAnuncioApresentacao = "INSERT INTO AnuncioApresentacao (IdEmpresa, NomeExibicao) VALUES ($IdEmpresa, '".$obj->getNomeEmpresa()."');";
        $query = $pdo->prepare($sqlAnuncioApresentacao);
        $resultado = $query->execute();
        if(!$resultado){return false;}
        
        $sqlAnuncioInfo = "INSERT INTO AnuncioInfo (IdEmpresa) VALUES ($IdEmpresa);";
        $query = $pdo->prepare($sqlAnuncioInfo);
        $resultado = $query->execute();
        if(!$resultado){return false;}
        
        $sqlAnuncioIntegracao = "INSERT INTO AnuncioIntegracao (IdEmpresa) VALUES ($IdEmpresa);";
        $query = $pdo->prepare($sqlAnuncioIntegracao);
        $resultado = $query->execute();
        if(!$resultado){return false;}
        
        $sqlAnuncioIntegracao = "INSERT INTO AnuncioHorarios (IdEmpresa) VALUES ($IdEmpresa);";
        $query = $pdo->prepare($sqlAnuncioIntegracao);
        $resultado = $query->execute();
        if(!$resultado){return false;}
        
        return true;
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
    
    private function carregaDados($query){
        
        $empresas = [];
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $empresa = new Empresa();
            $empresa->setIdCliente($listado["IdCliente"]);
            $empresa->setIdEmpresa($listado["IdEmpresa"]);
            $empresa->setAnunciando($listado["Anunciando"]);
            $empresa->setEmail($listado["Email"]);
            $empresa->setSite($listado["Site"]);
            $empresa->setNomeEmpresa($listado["NomeEmpresa"]);
            $empresa->setTipoNegocio($listado["TipoNegocio"]);
            $empresa->setCidade($listado["Cidade"]);
            $empresa->setEstado($listado["Estado"]);
            $empresas[] = $empresa;
        }

        switch(count($empresas)){
            case 0:
                return NULL;
            case 1:
                return $empresas[0];
            default:
                return $empresas;
        }
    }
    
    public function carregaDadosFetch($dados){
        
        $empresas = [];
        
        //$dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $empresa = new Empresa();
            $empresa->setIdCliente($listado["IdCliente"]);
            $empresa->setIdEmpresa($listado["IdEmpresa"]);
            $empresa->setAnunciando($listado["Anunciando"]);
            $empresa->setEmail($listado["Email"]);
            $empresa->setSite($listado["Site"]);
            $empresa->setNomeEmpresa($listado["NomeEmpresa"]);
            $empresa->setTipoNegocio($listado["TipoNegocio"]);
            $empresa->setCidade($listado["Cidade"]);
            $empresa->setEstado($listado["Estado"]);
            $empresas[] = $empresa;
        }

        return $empresas; // ???????????
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

    function getIdAnuncioImpulsionado() {
        return $this->IdAnuncioImpulsionado;
    }

    function getIdEmpresa() {
        return $this->IdEmpresa;
    }

    function getIdPlano() {
        return $this->IdPlano;
    }

    function getDataDuracao() {
        return $this->DataDuracao;
    }

    function getStatus() {
        return $this->Status;
    }
    
    function getIdTransacao() {
        return $this->IdTransacao;
    }

    function setIdTransacao($IdTransacao) {
        $this->IdTransacao = $IdTransacao;
    }
    
    function setIdAnuncioImpulsionado($IdAnuncioImpulsionado) {
        $this->IdAnuncioImpulsionado = $IdAnuncioImpulsionado;
    }

    function setIdEmpresa($IdEmpresa) {
        $this->IdEmpresa = $IdEmpresa;
    }

    function setIdPlano($IdPlano) {
        $this->IdPlano = $IdPlano;
    }

    function setDataDuracao($DataDuracao) {
        $this->DataDuracao = $DataDuracao;
    }

    function setStatus($Status) {
        $this->Status = $Status;
    }
    
    // </editor-fold>
    
}
