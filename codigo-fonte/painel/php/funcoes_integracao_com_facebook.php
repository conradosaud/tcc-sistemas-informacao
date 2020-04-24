<?php

if(isset($_POST["hiddenNovoFacebook"])){
    $resposta = insere();
    echo $resposta;
}

if(isset($_POST["hiddenAltera"])){
    $obj = json_decode($_POST["obj"]);
    $resposta = altera($obj);
    echo $resposta;
}

if(isset($_POST["hiddenRemove"])){
    $resposta = remove();
    echo $resposta;
}

function busca(){
    include_once("../../controller/AnuncioFacebookControlador.php");
    $objFacebook = new AnuncioFacebookControlador();
    $objFacebook = $objFacebook->get("busca", $_SESSION["IdEmpresa"]);
    
    return $objFacebook;
}

function insere(){
    session_start();
    
    $IdPagina = $_POST["idPagina"];
    $NomePagina = $_POST["nomePagina"];
    $LinkPagina = "http://facebook.com/".$IdPagina."/";
    
    include_once("../../controller/AnuncioFacebookControlador.php");
    $objFacebook = AnuncioFacebookControlador::criaObj(null, $_SESSION["IdEmpresa"], $IdPagina, $NomePagina, $LinkPagina, null, null, null, null);
    $objControlador = new AnuncioFacebookControlador();
    $objControlador = $objControlador->post("insere", $objFacebook);
    
    return $objControlador;
}

function altera($obj){
    session_start();
    
    include_once("../../controller/AnuncioFacebookControlador.php");
    $objFacebook = AnuncioFacebookControlador::criaObj(null, $_SESSION["IdEmpresa"], null, null, null, $obj->cboxCurtidas, $obj->cboxComentarios, $obj->cboxCompartilhar, $obj->cboxEnviar);
    $objControlador = new AnuncioFacebookControlador();
    $objControlador = $objControlador->put(null, null, $objFacebook);
    
    return $objControlador;
}

function remove(){
    session_start();
    
    include_once("../../controller/AnuncioFacebookControlador.php");
    $objControlador = new AnuncioFacebookControlador();
    $objControlador = $objControlador->delete(null, $_SESSION["IdEmpresa"]);
    
    return $objControlador;
}
