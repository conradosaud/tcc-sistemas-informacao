<?php

class Mensagem {
    
    // <editor-fold defaultstate="collapsed" desc="Atributos">
    
    private static $inicioScript = "<script>";
    private static $fimScript = "</script>";
    
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="Métodos">
    
    public static function msgOperacaoErro(){
        return false;
    }
    
    public static function msgException($exception){
        return false;
    }
    
    public static function redicionar($diretorio){
        $redirecionamento = "window.location.href='$diretorio';";
        $script = self::$inicioScript.$redirecionamento. self::$fimScript;
        echo $script;
    }
    
    public static function formularioValidado($resposta){
        return false;
    }
    
    public static function enviarScript(){
        return false;
    }
    
    // </editor-fold>
    
}
