<?php

if(isset($_POST["hiddenEmpresa"])){
    $resposta = altera();
    echo $resposta;
}

function altera(){
    session_start();
    
    include_once("./funcoes_utilidade.php");
    $NomeEmpresa = $_POST["txtNomeEmpresa"];
    $NomeEmpresa = nameCase($NomeEmpresa);
    
    include_once("../../controller/EmpresaControlador.php");
    $objEmpresa = EmpresaControlador::criaObj($_SESSION["IdCliente"], $NomeEmpresa, $_POST["Seguimento"], $_POST["txtEmailEmpresa"], $_POST["txtSiteEmpresa"], null, null);
    $objControlador = new EmpresaControlador();
    $objControlador = $objControlador->put(null, $_SESSION["IdEmpresa"], $objEmpresa);
    
    return $objControlador;
}

function busca(){
    include_once("../../controller/EmpresaControlador.php");
    $objEmpresa = new EmpresaControlador();
    $objEmpresa = $objEmpresa->get("buscaEmpresaPorIdEmpresa", $_SESSION["IdEmpresa"]);
    
    return $objEmpresa;
}

