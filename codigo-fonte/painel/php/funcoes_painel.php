<?php

if(isset($_GET["IdEmpresa"])){
    session_start();
    
    echo "Aguarde...";
    
    // verifica se o anuncio da empresa $_GET pertence ao usuário conectado
    include_once("../../controller/EmpresaControlador.php");
    $objEmpresa = new EmpresaControlador();
    $objEmpresa = $objEmpresa->get("verificaAnuncioEmpresa", ["IdEmpresa"=>$_GET["IdEmpresa"],"IdCliente"=>$_SESSION["IdCliente"]]);
    
    // se for, seta as variaveis daquela empresa
    if($objEmpresa){
        $objEmpresa = new EmpresaControlador();
        $objEmpresa = $objEmpresa->get("buscaEmpresaPorIdEmpresa", $_GET["IdEmpresa"]);
        
        $_SESSION["IdEmpresa"] = $objEmpresa->getIdEmpresa();
        $_SESSION["NomeEmpresa"] = $objEmpresa->getNomeEmpresa();
        $_SESSION["EmpresaAnunciando"] = $objEmpresa->getAnunciando();
        
        if(isset($_GET["tutorial"]) && $_GET["tutorial"]==1){
            echo "<script>window.location.href='../view/inicio.php?tutorial=1';</script>";
        }else{
            echo "<script>window.location.href='../view/inicio.php';</script>";
        }
    }else{
        echo "<script>window.location.href='../view/painel_de_empresas.php';</script>";
    }
}

if(isset($_GET["tutorial"]) && $_GET["tutorial"]==1){
    echo "<script>var tutorial = true;</script>";
}

if(!isset($_SESSION)){
    echo "<script>window.location.href='../login/painel_de_acesso.php';</script>";
}

if(!isset($_SESSION["IdEmpresa"])){
    echo "<script>window.location.href='../login/painel_de_acesso.php';</script>";
}

if(!isset($_SESSION["IdCliente"])){
    echo "<script>window.location.href='../login/painel_de_acesso.php';</script>";
}

if(!isset($_SESSION["NomeCliente"])){
    echo "<script>window.location.href='../login/painel_de_acesso.php';</script>";
}

if(!isset($_SESSION["NomeEmpresa"])){
    echo "<script>window.location.href='../login/painel_de_acesso.php';</script>";
}

if(basename($_SERVER['PHP_SELF']) != "enderecos_e_contatos.php"){
    if(isset($_SESSION["IdEnderecos"])){
        unset($_SESSION["IdEnderecos"]);
    }
}


