<?php

include_once("../../model/Cupons.php");
include_once("../../php/InterfaceREST.php");

class CuponsControlador implements InterfaceREST{
    
    // <editor-fold defaultstate="collapsed" desc="REST">
    
    public function delete($action, $obj) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }

    public function get($action, $obj) {
        switch($action){
            case "verificaCupomPorCodigo":
                $objCupom = new Cupons();
                $objCupom = $objCupom->verificaCupomPorCodigo($obj);
                return $this->validaData($objCupom);
            case "geraCupom":
                $objCupom = new Cupons();
                $objCupom = $objCupom->geraCupom();
                return $objCupom;
            default:
                return false;
        }
        
    }

    public function post($action, $obj) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }

    public function put($action, $objAtual, $objNovo) {
        switch($action){
            case "invalidaCupom":
                $objCupom = new Cupons();
                $objCupom = $objCupom->invalidaCupom($objAtual);
                return $objCupom;
            default:
                return false;
        }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">

    private function validaData($cupom){
        $cupom = $cupom[0];
        
        date_default_timezone_set('America/Sao_Paulo');
        if (new DateTime() > new DateTime($cupom->getDataVencimento()) && $cupom->getStatus() == 'A') {
            $objCupom = new Cupons();
            $objCupom->invalidaCupom($cupom->getIdCupom());
        }
        
        return $cupom;
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos Estáticos">
    

    // </editor-fold>
    
}
