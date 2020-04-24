<?php

include_once("Dao.php");
include_once("../../php/InterfaceCRUD.php");

class AnuncioEndereco implements InterfaceCRUD{
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">
    
    private $IdEndereco;
    private $IdEmpresa;
    private $Rua;
    private $Complemento;
    private $Cep;
    private $Numero;
    private $Bairro;
    private $Email;
    private $Telefone1;
    private $Telefone2;
    private $Celular1;
    private $Celular2;
    private $CboxCelular1;
    private $CboxCelular2;
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
                UPDATE AnuncioEndereco
                SET
                Rua = :Rua,
                Complemento = :Complemento,
                Cep = :Cep,
                Numero = :Numero,
                Bairro = :Bairro,
                Email = :Email,
                Telefone1 = :Telefone1,
                Telefone2 = :Telefone2,
                Celular1 = :Celular1,
                Celular2 = :Celular2,
                WhatsCelular1 = :WhatsCelular1,
                WhatsCelular2 = :WhatsCelular2,
                Data = :Data
                WHERE
                IdEmpresa = :IdEmpresa
                AND
                IdEndereco = :IdEndereco
                ;";
            
            $query = $this->db->prepare($sql);
            $query->bindValue(":Rua", $novo->getRua(), PDO::PARAM_STR);
            $query->bindValue(":Complemento", $novo->getComplemento(), PDO::PARAM_STR);
            $query->bindValue(":Cep", $novo->getCep(), PDO::PARAM_STR);
            $query->bindValue(":Numero", $novo->getNumero(), PDO::PARAM_STR);
            $query->bindValue(":Bairro", $novo->getBairro(), PDO::PARAM_STR);
            $query->bindValue(":Email", $novo->getEmail(), PDO::PARAM_STR);
            $query->bindValue(":Telefone1", $novo->getTelefone1(), PDO::PARAM_STR);
            $query->bindValue(":Telefone2", $novo->getTelefone2(), PDO::PARAM_STR);
            $query->bindValue(":Celular1", $novo->getCelular1(), PDO::PARAM_STR);
            $query->bindValue(":Celular2", $novo->getCelular2(), PDO::PARAM_STR);
            $query->bindValue(":WhatsCelular1", $novo->getCboxCelular1(), PDO::PARAM_BOOL);
            $query->bindValue(":WhatsCelular2", $novo->getCboxCelular2(), PDO::PARAM_BOOL);
            $query->bindValue(":Data", $this->dataAgora(true), PDO::PARAM_STR);
            $query->bindValue(":IdEmpresa", $novo->getIdEmpresa(), PDO::PARAM_INT);
            $query->bindValue(":IdEndereco", $novo->getIdEndereco(), PDO::PARAM_INT);
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
                SELECT * FROM AnuncioEndereco
                WHERE IdEndereco = :IdEndereco
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEndereco", $id, PDO::PARAM_INT);
            $query->execute();
            
            return $this->carregaDados($query);
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function buscaTodos() {
        try{
            
            $sql = "
                SELECT * FROM AnuncioEndereco
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $id, PDO::PARAM_INT);
            $query->execute();
            
            return $this->carregaDados($query);
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function insere($objeto) {
        try{
            
            $sql = "
                INSERT INTO AnuncioEndereco
                (IdEmpresa, Rua, Complemento, Cep, Numero, Bairro ,Email ,Telefone1 ,Telefone2 ,Celular1,
                Celular2, WhatsCelular1, WhatsCelular2, Data)
                VALUES
                (:IdEmpresa, :Rua, :Complemento, :Cep, :Numero, :Bairro, :Email, :Telefone1, :Telefone2,
                :Celular1, :Celular2, :WhatsCelular1, :WhatsCelular2, :Data)
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $objeto->getIdEmpresa(), PDO::PARAM_INT);
            $query->bindValue(":Rua", $objeto->getRua(), PDO::PARAM_STR);
            $query->bindValue(":Complemento", $objeto->getComplemento(), PDO::PARAM_STR);
            $query->bindValue(":Cep", $objeto->getCep(), PDO::PARAM_STR);
            $query->bindValue(":Numero", $objeto->getNumero(), PDO::PARAM_STR);
            $query->bindValue(":Bairro", $objeto->getBairro(), PDO::PARAM_STR);
            $query->bindValue(":Email", $objeto->getEmail(), PDO::PARAM_STR);
            $query->bindValue(":Telefone1", $objeto->getTelefone1(), PDO::PARAM_STR);
            $query->bindValue(":Telefone2", $objeto->getTelefone2(), PDO::PARAM_STR);
            $query->bindValue(":Celular1", $objeto->getCelular1(), PDO::PARAM_STR);
            $query->bindValue(":Celular2", $objeto->getCelular2(), PDO::PARAM_STR);
            $query->bindValue(":WhatsCelular1", $objeto->getCboxCelular1(), PDO::PARAM_BOOL);
            $query->bindValue(":WhatsCelular2", $objeto->getCboxCelular2(), PDO::PARAM_BOOL);
            $query->bindValue(":Data", $this->dataAgora(true), PDO::PARAM_STR);
            $query->execute();
            
            return $this->verificaDados($query);
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }

    public function remove($id) {
        try{
            
            $pdo = $this->db;
            
            // inicia transacao
            $pdo->beginTransaction();
            
            $sql = "
                DELETE FROM AnuncioEndereco
                WHERE IdEndereco = :IdEndereco
                ;";
            
            $query = $pdo->prepare($sql);
            $query->bindValue(":IdEndereco", $id, PDO::PARAM_INT);
            $resultado = $query->execute();

            if(!$resultado){
                $pdo->rollBack();
                return false;
            }
            
            $sql = "
                DELETE FROM AnuncioMaps
                WHERE IdEndereco = :IdEndereco
                ;";
            
            $query = $pdo->prepare($sql);
            $query->bindValue(":IdEndereco", $id, PDO::PARAM_INT);
            $retorno = $query->execute();

            if($retorno){
                $pdo->commit();
                return TRUE;
            }else{
                $pdo->rollBack();
                return FALSE;
            }
            
        } catch (Exception $ex) {
            Mensagem::msgException($ex);
            return NULL;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    
    public function buscaTodosPorIdEmpresa($id) {
        try{
            
            $sql = "
                SELECT * FROM AnuncioEndereco
                WHERE IdEmpresa = :IdEmpresa
                ;";

            $query = $this->db->prepare($sql);
            $query->bindValue(":IdEmpresa", $id, PDO::PARAM_INT);
            $query->execute();
            
            return $this->carregaDados($query);
            
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
        
        $anuncioEnderecos = [];
        
        $dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $anuncioEndereco = new AnuncioEndereco();
            $anuncioEndereco->setIdEndereco($listado["IdEndereco"]);
            $anuncioEndereco->setRua($listado["Rua"]);
            $anuncioEndereco->setComplemento($listado["Complemento"]);
            $anuncioEndereco->setCep($listado["Cep"]);
            $anuncioEndereco->setNumero($listado["Numero"]);
            $anuncioEndereco->setBairro($listado["Bairro"]);
            $anuncioEndereco->setEmail($listado["Email"]);
            $anuncioEndereco->setTelefone1($listado["Telefone1"]);
            $anuncioEndereco->setTelefone2($listado["Telefone2"]);
            $anuncioEndereco->setCelular1($listado["Celular1"]);
            $anuncioEndereco->setCelular2($listado["Celular2"]);
            $anuncioEndereco->setCboxCelular1($listado["WhatsCelular1"]);
            $anuncioEndereco->setCboxCelular2($listado["WhatsCelular2"]);
            $anuncioEnderecos[] = $anuncioEndereco;
        }

        return $anuncioEnderecos;
    }
    
    public function carregaDadosFetch($dados){
        
        $anuncioEnderecos = [];
        
        //$dados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($dados as $listado){
            $anuncioEndereco = new AnuncioEndereco();
            $anuncioEndereco->setIdEndereco($listado["IdEndereco"]);
            $anuncioEndereco->setRua($listado["Rua"]);
            $anuncioEndereco->setComplemento($listado["Complemento"]);
            $anuncioEndereco->setCep($listado["Cep"]);
            $anuncioEndereco->setNumero($listado["Numero"]);
            $anuncioEndereco->setBairro($listado["Bairro"]);
            $anuncioEndereco->setEmail($listado["Email"]);
            $anuncioEndereco->setTelefone1($listado["Telefone1"]);
            $anuncioEndereco->setTelefone2($listado["Telefone2"]);
            $anuncioEndereco->setCelular1($listado["Celular1"]);
            $anuncioEndereco->setCelular2($listado["Celular2"]);
            $anuncioEndereco->setCboxCelular1($listado["WhatsCelular1"]);
            $anuncioEndereco->setCboxCelular2($listado["WhatsCelular2"]);
            $anuncioEnderecos[] = $anuncioEndereco;
        }

        return $anuncioEnderecos;
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
    
    function getIdEndereco() {
        return $this->IdEndereco;
    }

    function getIdEmpresa() {
        return $this->IdEmpresa;
    }

    function getRua() {
        return $this->Rua;
    }

    function getComplemento() {
        return $this->Complemento;
    }

    function getCep() {
        return $this->Cep;
    }

    function getNumero() {
        return $this->Numero;
    }

    function getBairro() {
        return $this->Bairro;
    }

    function getEmail() {
        return $this->Email;
    }

    function getTelefone1() {
        return $this->Telefone1;
    }

    function getTelefone2() {
        return $this->Telefone2;
    }

    function getCelular1() {
        return $this->Celular1;
    }

    function getCelular2() {
        return $this->Celular2;
    }

    function getCboxCelular1() {
        return $this->CboxCelular1;
    }

    function getCboxCelular2() {
        return $this->CboxCelular2;
    }

    function setIdEndereco($IdEndereco) {
        $this->IdEndereco = $IdEndereco;
    }

    function setIdEmpresa($IdEmpresa) {
        $this->IdEmpresa = $IdEmpresa;
    }

    function setRua($Rua) {
        $this->Rua = $Rua;
    }

    function setComplemento($Complemento) {
        $this->Complemento = $Complemento;
    }

    function setCep($Cep) {
        $this->Cep = $Cep;
    }

    function setNumero($Numero) {
        $this->Numero = $Numero;
    }

    function setBairro($Bairro) {
        $this->Bairro = $Bairro;
    }

    function setEmail($Email) {
        $this->Email = $Email;
    }

    function setTelefone1($Telefone1) {
        $this->Telefone1 = $Telefone1;
    }

    function setTelefone2($Telefone2) {
        $this->Telefone2 = $Telefone2;
    }

    function setCelular1($Celular1) {
        $this->Celular1 = $Celular1;
    }

    function setCelular2($Celular2) {
        $this->Celular2 = $Celular2;
    }

    function setCboxCelular1($CboxCelular1) {
        $this->CboxCelular1 = $CboxCelular1;
    }

    function setCboxCelular2($CboxCelular2) {
        $this->CboxCelular2 = $CboxCelular2;
    }
    
    // </editor-fold>

}
