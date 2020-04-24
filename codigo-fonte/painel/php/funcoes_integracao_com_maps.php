<?php

if(isset($_POST["hiddenMaps"])){
    $resposta = altera();
    echo $resposta;
}

if(isset($_POST["buscaMaps"])){
    session_start();
    $obj = buscaMaps($_SESSION["IdEmpresa"]);
    if($obj){
        include_once("../../controller/AnuncioMapsControlador.php");
        $final = [];
        foreach ($obj as $x){
            if($x->getLatitude() && $x->getLongitude() && $x->getStatus()=="A"){
                $final[] = ["latitude"=>$x->getLatitude(), "longitude"=>$x->getLongitude()];
            }
        }
        if(count($final)!= 0){
            echo json_encode($final);
        }else{
            echo "nenhumaCoordenada";
        }
    }else{
        echo "nenhumaCoordenada";
    }
}

function buscaEndereco(){
    include_once("../../controller/AnuncioEnderecoControlador.php");
    $objEndereco = new AnuncioEnderecoControlador();
    $objEndereco = $objEndereco->get("buscaTodosPorIdEmpresa", $_SESSION["IdEmpresa"]);
    
    $enderecos = array();
    
    foreach($objEndereco as $obj){
        if($obj->getCep()){
            $enderecos[] = $obj;
        }
    }
    
    return $enderecos;
}

function buscaMaps(){
    include_once("../../controller/AnuncioMapsControlador.php");
    $objMaps = new AnuncioMapsControlador();
    $objMaps = $objMaps->get("busca", $_SESSION["IdEmpresa"]);
    
    return $objMaps;
}

function busca(){
    include_once("../../controller/AnuncioEnderecoControlador.php");
    $objEndereco = new AnuncioEnderecoControlador();
    $objEndereco = $objEndereco->get("busca", $_POST["IdEndereco"]);
    
    return $objEndereco;
}

function altera(){
    session_start();
    
    $objEndereco = busca();
    $objEndereco = $objEndereco[0];
    
    $Latitude = (isset($_POST["Latitude"])?$_POST["Latitude"]:null);
    $Longitude = (isset($_POST["Longitude"])?$_POST["Longitude"]:null);
    
    include_once("../../controller/AnuncioMapsControlador.php");
    $objControlador = new AnuncioMapsControlador();
    $objMaps = AnuncioMapsControlador::criaObj(null, $_SESSION["IdEmpresa"], $objEndereco->getIdEndereco(), $Latitude, $Longitude, $_POST["Status"]);
    $verificaExistente = AnuncioMapsControlador::verificaExistente($objEndereco->getIdEndereco());
    if($verificaExistente){
        $objControlador = $objControlador->put(null, null, $objMaps);
    }else{
        $objControlador = $objControlador->post(null, $objMaps);
    }
    
    return $objControlador;
}

