<?php

include_once("../../model/Visitante.php");
include_once("../../php/InterfaceREST.php");

class VisitanteControlador implements InterfaceREST{
    
    // <editor-fold defaultstate="collapsed" desc="REST">
    
    public function delete($action, $obj) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }

    public function get($action, $obj) {
        switch($action){
            case "buscaTodosPorCliente":
                $objEmpresa = new Empresa();
                $objEmpresa = $objEmpresa->buscaTodosPorCliente($obj);
                return $objEmpresa;
            default:
                return false;
        }
        
    }

    public function post($action, $obj) {
        return $this->verificaInsereVisitante($obj);
    }

    public function put($action, $objAtual, $objNovo) {
        
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">

    private function verificaInsereVisitante($obj){
        $objVisitante = new Visitante();
        $objVisitante = $objVisitante->buscaPorIdFacebook($obj);
        
        if($objVisitante->getIdVisitante()){
            $objVisitante = false;
        }else{
            $objVisitante = new Visitante();
            $objVisitante = $objVisitante->insere($obj);
        }
        
        return $objVisitante;
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos Estáticos">

    static function criaObjetoCompleto($IdVisitante, $IdFacebook, $LinkFacebook, $Nome, $Email, $PrimeiroNome, $Sobrenome, $Sexo, $Status){
        $objVisitante = new Visitante();
        $objVisitante->setIdVisitante($IdVisitante);
        $objVisitante->setIdFacebook($IdFacebook);
        $objVisitante->setLinkFacebook($LinkFacebook);
        $objVisitante->setNome($Nome);
        $objVisitante->setEmail($Email);
        $objVisitante->setPrimeiroNome($PrimeiroNome);
        $objVisitante->setSobrenome($Sobrenome);
        $objVisitante->setSexo($Sexo);
        $objVisitante->setStatus($Status);
        return $objVisitante;
    }
    
    static function criaObjetoSimples($IdFacebook, $LinkFacebook, $Nome, $Email, $PrimeiroNome, $Sobrenome, $Sexo){
        return self::criaObjetoCompleto(null, $IdFacebook, $LinkFacebook, $Nome, $Email, $PrimeiroNome, $Sobrenome, $Sexo, null);
    }
    
    static function criaObjetoIncompleto($IdFacebook, $Nome){
        return self::criaObjetoCompleto(null, $IdFacebook, null, $Nome, null, null, null, null, null, null);
    }

    // </editor-fold>
    
}
