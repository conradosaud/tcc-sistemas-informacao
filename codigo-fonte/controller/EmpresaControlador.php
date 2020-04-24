<?php

include_once("../../model/Empresa.php");
include_once("../../php/InterfaceREST.php");

class EmpresaControlador implements InterfaceREST{
    
    // <editor-fold defaultstate="collapsed" desc="REST">
    
    public function delete($action, $obj) {
        switch ($action){
            case "removeEmpresa":
                $objEmpresa = new Empresa();
                $objEmpresa = $objEmpresa->remove($obj);
                return $objEmpresa;
            default:
                return false;
        }
    }

    public function get($action, $obj) {
        switch ($action){
            case "buscaEmpresaPorIdEmpresa":
                $objEmpresa = new Empresa();
                $objEmpresa = $objEmpresa->busca($obj);
                return $objEmpresa;
            case "buscaTodosPorCliente":
                $objEmpresas = new Empresa();
                $objEmpresas = $objEmpresas->buscaTodosPorCliente($obj);
                return $objEmpresas;
            case "buscaEmpresaAnuncioApresentacao":
                $objEmpresas = new Empresa();
                $objEmpresas = $objEmpresas->buscaEmpresaAnuncioApresentacao($obj);
                return $objEmpresas;
            case "verificaAnuncioEmpresa":
                $objEmpresa = new Empresa();
                $objEmpresa = $objEmpresa->verificaAnuncioEmpresa($obj["IdEmpresa"], $obj["IdCliente"]);
                return $objEmpresa;
            case "buscaEmpresaIdAnuncio":
                $objEmpresa = new Empresa();
                $objEmpresa = $objEmpresa->buscaEmpresaIdAnuncio($obj);
                return $objEmpresa;
            default:
                return false;
        }
    }

    public function post($action, $obj) {
        $objEmpresa = new Empresa();
        $objEmpresa = $objEmpresa->insere($obj);
        return $objEmpresa;
    }

    public function put($action, $objAtual, $objNovo) {
         switch ($action){
            case "altera":
                $objEmpresa = new Empresa();
                $objEmpresa = $objEmpresa->altera($objAtual, $objNovo);
                return $objEmpresa;
            case "alteraAnunciando":
                $objEmpresa = new Empresa();
                $objEmpresa = $objEmpresa->alteraAnunciando($objAtual, $objNovo);
                return $objEmpresa;
            default:
                $objEmpresa = new Empresa();
                $objEmpresa = $objEmpresa->altera($objAtual, $objNovo);
                return $objEmpresa;
         }
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">

    
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos Estáticos">
    
    static function criaObj($IdCliente, $NomeEmpresa, $TipoNegocio, $Email, $Site, $Cidade, $Estado){
        $objEmpresa = new Empresa();
        $objEmpresa->setIdCliente($IdCliente);
        $objEmpresa->setNomeEmpresa($NomeEmpresa);
        $objEmpresa->setTipoNegocio($TipoNegocio);
        $objEmpresa->setEmail($Email);
        $objEmpresa->setSite($Site);
        $objEmpresa->setCidade($Cidade);
        $objEmpresa->setEstado($Estado);

        return $objEmpresa;
    }

    // </editor-fold>
    
}
