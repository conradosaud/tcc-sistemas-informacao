<?php

include_once("../../model/Transacao.php");
include_once("../../php/InterfaceREST.php");

class TransacaoControlador implements InterfaceREST{
    
    // <editor-fold defaultstate="collapsed" desc="REST">
    
    public function delete($action, $obj) {
        
    }

    public function get($action, $obj) {
        
    }

    public function post($action, $obj) {
        $objTransacao = new Transacao();
        $objTransacao = $objTransacao->insere($obj);
        return $objTransacao;
    }

    public function put($action, $objAtual, $objNovo) {
         
    }
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">

    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos Estáticos">
    
    static function criaObj($IdPlano, $IdEmpresa, $IdCupom, $Desconto, $DataDuracao, $FormaPagamento, $Operacao, $Valor){
        $objTransacao = new Transacao();
        $objTransacao->setIdPlano($IdPlano);
        $objTransacao->setIdEmpresa($IdEmpresa);
        $objTransacao->setIdCupom($IdCupom);
        $objTransacao->setDesconto($Desconto);
        $objTransacao->setDataDuracao($DataDuracao);
        $objTransacao->setFormaPagamento($FormaPagamento);
        $objTransacao->setOperacao($Operacao);
        $objTransacao->setValor($Valor);

        return $objTransacao;
    }

    // </editor-fold>
    
}
