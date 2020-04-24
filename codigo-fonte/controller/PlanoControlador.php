<?php

include_once("../../model/Plano.php");
include_once("../../php/InterfaceREST.php");

class PlanoControlador implements InterfaceREST{
    
    // <editor-fold defaultstate="collapsed" desc="REST">
    
    public function delete($action, $obj) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }

    public function get($action, $obj) {
        $objPlano = new Plano();
        switch ($action){
            case "buscarPlano":
                $objPlano = $objPlano->busca($obj);
                return $objPlano;
            case "buscaPlanoPorCupom":
                $objPlano = $objPlano->buscaPlanoPorCupom($obj);
                return $objPlano;
            case "buscaTodosPlanosValidosAnuncioImpulsionado":
                $objPlano = $objPlano->buscaTodosPlanosValidosAnuncioImpulsionado();
                $objPlano = $this->montaObjAnuncioImpulsionado($objPlano);
                return $objPlano;
            default:
                return false;
        }
    }

    public function post($action, $obj) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }

    public function put($action, $objAtual, $objNovo) {
        // METODO NAO UTILIZADO NESTA CLASSE
        return false;
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">

    private function montaObjAnuncioImpulsionado($obj){
        $newSemanal = array();
        $newFimSemana = array();
        
        foreach($obj as $x){
            
            $x->setValor(number_format($x->getValor(), 2, ',', '.'));
            if($x->getValorDesconto()>0){
                $x->setValorDesconto(number_format($x->getValorDesconto(), 2, ',', '.'));
            }
            
            if($x->getTipoDia() == "Semanal"){
                $newSemanal[] = $x;
            }else{
                $newFimSemana[] = $x;
            }
        }
        
        $new = array();
        $new["Semanal"] = $newSemanal;
        $new["FimSemana"] = $newFimSemana;
        
        return $new;
    }

    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos Estáticos">

    static function criaObjetoSimples($tipo, $dias, $plano){
        $objEmpresa = Empresa::criaObj(null, $IdCliente, null, $NomeEmpresa, $TipoNegocio, null, null, $Cidade, null);
        return $objEmpresa;
    }
    
    static function criaObjetoJSPlano($objPlano){
        $obj = '{"IdPlano":'.$objPlano->getIdPlano().', "Valor":'.$objPlano->getValor().',
            "ValorDesconto":'.($objPlano->getValorDesconto()>0?$objPlano->getValorDesconto():0).', "Duracao":'.$objPlano->getDuracao().',
            "Nome":"'.$objPlano->getNome().'", "TipoDia":"'.$objPlano->getTipoDia().'", "TipoPlano":"'.$objPlano->getTipoPlano().'"}';
    
        return $obj;
    }

    // </editor-fold>
    
}
