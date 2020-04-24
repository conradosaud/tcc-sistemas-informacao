<?php

function getTodasIntegracoes($IdEmpresa){
    include_once("../../controller/AnuncioFacebookControlador.php");
    include_once("../../controller/AnuncioMapsControlador.php");
    
    $objFacebook = new AnuncioFacebookControlador();
    $objMaps = new AnuncioMapsControlador();
    
    $objFacebook = $objFacebook->get("buscaPorIdEmpresa", $IdEmpresa);
    $objMaps = $objMaps->get("buscaPorIdEmpresa", $IdEmpresa);
    
    $objIntegracao = ["Facebook"=>$objFacebook, "Maps"=>$objMaps];
    
    return $objIntegracao;
}

function validaFacebook($obj){
    if($obj->getIdFacebook()){
        return true;
    }else{
        return false;
    }
}

function validaMaps($obj){
    $validado = false;
    foreach($obj as $map){
        if($map->getIdMaps() && $map->getStatus() == "A"){
            $validado = true;
            return $validado;
        }
    }
    return $validado;
}