<?php

include_once("../../model/Cliente.php");
include_once("../../php/InterfaceREST.php");

class ClienteControlador implements InterfaceREST{
    
    // <editor-fold defaultstate="collapsed" desc="REST">
    
    public function delete($action, $obj) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }

    public function get($action, $obj) {
        switch($action){
            case "busca":
                $objCliente = new Cliente();
                $objCliente = $objCliente->busca($obj);
                return $objCliente;
            case "buscaTodosPorCliente":
                $objEmpresa = new Empresa();
                $objEmpresa = $objEmpresa->buscaTodosPorCliente($obj);
                return $objEmpresa;
            case "verificaEmail":
                $objCliente = new Cliente();
                $objCliente = $objCliente->verificaEmail($obj);
                return $objCliente;
            case "verificaSenha":
                $objCliente = new Cliente();
                $objCliente = $objCliente->verificaSenha($obj["Senha"], $obj["IdCliente"]);
                return $objCliente;
            default:
                return false;
        }
        
    }

    public function post($action, $obj) {
        $objCliente = new Cliente();
        $objCliente = $objCliente->insere($obj);
        return $objCliente;
    }

    public function put($action, $objAtual, $objNovo) {
        switch($action){
            case "alteraInformacoes":
                $objCliente = new Cliente();
                $objCliente = $objCliente->alteraInformacoes(null, $objNovo);
                return $objCliente;
            case "alteraSenha":
                $objCliente = new Cliente();
                $objCliente = $objCliente->alteraSenha($objAtual, $objNovo);
                return $objCliente;
            default:
                return false;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">

    private function buscaPorEmail($obj){
        $objCliente = new Cliente();
        return $objCliente->buscarPorEmail($obj->getEmail());
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos Estáticos">

    static function criaObj($IdCliente, $Nome, $Email, $Telefone1, $Senha){
        $obj = new Cliente();
        $obj->setIdCliente($IdCliente);
        $obj->setNome($Nome);
        $obj->setEmail($Email);
        $obj->setTelefone1($Telefone1);
        $obj->setSenha($Senha);
        
        return $obj;
    }
    
    static function autenticarCliente($Email, $Senha){
        $objCliente = new Cliente();
        $objCliente = $objCliente->autenticarCliente($Email, $Senha);
        return $objCliente;
    }

    // </editor-fold>
    
}
