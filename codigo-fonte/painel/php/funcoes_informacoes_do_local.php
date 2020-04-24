<?php

if(isset($_POST["hiddenInfo"])){
    $obj = json_decode($_POST["obj"]);
    $resposta = altera($obj);
    echo $resposta;
}

function busca(){
    include_once("../../controller/AnuncioInfoControlador.php");
    $objInfo = new AnuncioInfoControlador();
    $objInfo = $objInfo->get("busca", $_SESSION["IdEmpresa"]);
    
    return $objInfo;
}

function altera($obj){
    session_start();
    
    include_once("../../controller/AnuncioInfoControlador.php");
    $objInfo = AnuncioInfoControlador::criaObj($obj->entregasDomicilio, $obj->atendeLocal, $obj->estacionamento);
    $objControlador = new AnuncioInfoControlador();
    $objControlador = $objControlador->put(null, $_SESSION["IdEmpresa"], $objInfo);
    
    return $objControlador;
    
}
