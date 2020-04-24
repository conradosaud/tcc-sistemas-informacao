<?php

if(isset($_POST["buscaMaps"])){
    $obj = getMaps();
    exit();
}

$objAnuncio = getAnuncio();
$urlFacebook = getUrlFacebook($objAnuncio);

if(!isset($_GET["Anuncio"]) || $_GET["Anuncio"] <= 0 || !filter_var($_GET["Anuncio"], FILTER_VALIDATE_INT)){
    echo "<script>window.location.href='home.php'</script>";
}

include_once("funcoes_geral.php");

// Funções @@@@@@@@@@@@

function getMaps(){
    $IdEmpresa = $_POST["buscaMaps"];
    include_once("../../controller/AnuncioOperacoesControlador.php");
    $objControlador = new AnuncioOperacoesControlador();
    $objControlador = $objControlador->get("buscaMap", $IdEmpresa);
    
    return $objControlador;
}

function getAnuncio(){
    $IdEmpresa = $_GET["Anuncio"];
    
    include_once("../..//controller/AnuncioOperacoesControlador.php");
    $objControlador = new AnuncioOperacoesControlador();
    $objControlador = $objControlador->get("buscaAnuncioPorIdEmpresa", ["Var_Anunciando"=>1, "Var_IdEmpresa"=>$IdEmpresa]);
    
    if($objControlador){
        return $objControlador;
    }
}

function validaHorarios($obj){
    if($obj->getSegundaDas()){return true;}
    if($obj->getTercaDas()){return true;}
    if($obj->getQuartaDas()){return true;}
    if($obj->getQuintaDas()){return true;}
    if($obj->getSextaDas()){return true;}
    if($obj->getSabadoDas()){return true;}
    if($obj->getDomingoDas()){return true;}
    return false;
}

function validaMaps($obj){
    if($obj != NULL){
        foreach($obj as $map){
            if($map->getStatus() == "A"){
                return true;
            }
        }
    }
    
    return false;
}

function getUrlFacebook($obj){
    if($obj == NULL){
        return NULL;
    }
    
    if(strlen($obj["objFacebook"]->getLinkPagina()) > 1){
        return $obj["objFacebook"]->getLinkPagina();
    }else{
        return NULL;
    }
}