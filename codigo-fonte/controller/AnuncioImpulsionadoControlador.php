<?php

include_once("../../model/AnuncioImpulsionado.php");
include_once("../../php/InterfaceREST.php");

class AnuncioImpulsionadoControlador implements InterfaceREST{
    
    // <editor-fold defaultstate="collapsed" desc="REST">
    
    public function delete($action, $obj) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }

    public function get($action, $obj) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }

    public function post($action, $obj) {
        $objAnuncioAI = new AnuncioImpulsionado();
        $objAnuncioAI = $objAnuncioAI->insere($obj);
        return $objAnuncioAI;
    }

    public function put($action, $objAtual, $objNovo) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    
    
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos Estáticos">
    
    public static function criaObj($IdEmpresa, $IdPlano, $IdTransacao, $DataDuracao, $Status){
        $objAI = new AnuncioImpulsionado();
        $objAI->setIdEmpresa($IdEmpresa);
        $objAI->setIdPlano($IdPlano);
        $objAI->setIdTransacao($IdTransacao);
        $objAI->setDataDuracao($DataDuracao);
        $objAI->setStatus($Status);
        
        return $objAI;
    }

    // </editor-fold>

}
