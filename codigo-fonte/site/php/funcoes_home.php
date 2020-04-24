<?php

// busca todos os anuncios impulsionados
$objAnuncio = NULL;
$objAnuncio = buscaAnuncioImpulsionado();
if(count($objAnuncio) >= 1){
    // mostra os anuncios impulsionados que estão abertos primeiro
    $objAnuncio = priorizaAbertos($objAnuncio);
}

// preenhe a tela de recomendados caso nao haja anuncios impulsionados suficiente
$objAnuncioPreencher = NULL;
$objAnuncioPreencher = buscaAnuncioPreencher($objAnuncio);

// prenche a parte debaixo do site com ate 15 anuncios aleatorios
$objAnuncioGeral = NULL;
$objAnuncioGeral = buscaAnuncioGeral();

/* VERIFICAR DEPOIS @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

// se a quantidade de anuncios a preencher ainda nao for suficiente, completa com anuncios aleatorios
if(count($objAnuncio["objEmpresa"]) <= 2){
    if(count($objPreencher["objEmpresa"]) < (3 - count($objAnuncio["objEmpresa"]))){
        $qnt = (3 - count($objAnuncio["objEmpresa"])) - count($objPreencher["objEmpresa"]);
        for($i = 0; $i < $qnt; $i++){
            $objPreencher["objEmpresa"] += $objAnuncioGeral["objEmpresa"][$i];
            $objPreencher["objApresentacao"] += $objAnuncioGeral["objApresentacao"][$i];
            $objPreencher["objHorarios"] += $objAnuncioGeral["objHorarios"][$i];
            $objPreencher["objImagem"] += $objAnuncioGeral["objImagem"][$i];
        }
    }
}
 */

//var_dump($objAnuncioGeral["objEmpresa"]);

include_once("funcoes_geral.php");
//$objAnuncio = ordernarAnunciosHome($objAnuncio);
//var_dump($objAnuncio);

// busca todos os anuncios que serão exibidos na parte final do site (proximo ao rodapé)
function buscaAnuncioGeral(){
    include_once("../../controller/AnuncioOperacoesControlador.php");
    $objAnuncio = new AnuncioOperacoesControlador();
    $objAnuncio = $objAnuncio->get("buscaAnuncioGeral", 15);
 
    return $objAnuncio;
}

// busca todos anuncios impulsionados
function buscaAnuncioImpulsionado(){
    include_once("../../controller/AnuncioOperacoesControlador.php");
    $objAnuncio = new AnuncioOperacoesControlador();
    $objAnuncio = $objAnuncio->get("buscaTodosImpulsionados", NULL);
 
    return $objAnuncio;
}

// preenche com anuncios normais a tela principal se o numero de anuncios impulsionados nao for suficiente
function buscaAnuncioPreencher($objAnuncio){
    if(count($objAnuncio["objEmpresa"]) <= 2){
        include_once("../../controller/AnuncioOperacoesControlador.php");
        $objPreencher = new AnuncioOperacoesControlador();
        $objPreencher = $objPreencher->get("buscaTodosPreencher", (3 - count($objAnuncio["objEmpresa"])));

        return $objPreencher;
    }else{
        return NULL;
    }
}

// prioriza os anuncios que estão abertos no momento
function priorizaAbertos($objOperacoes){
    include_once("funcoes_geral.php");

    for($y = 0; $y < count($objOperacoes["objEmpresa"]); $y++){
        if(isOpen($objOperacoes["objHorarios"][$y])){
            $objAux["objEmpresa"][] = $objOperacoes["objEmpresa"][$y];
            $objAux["objApresentacao"][] = $objOperacoes["objApresentacao"][$y];
            $objAux["objInfo"][] = $objOperacoes["objInfo"][$y];
            $objAux["objHorarios"][] = $objOperacoes["objHorarios"][$y];
            $objAux["objImagem"][] = $objOperacoes["objImagem"][$y];
        }
    }
    for($y = 0; $y < count($objOperacoes["objEmpresa"]); $y++){
        if(!isOpen($objOperacoes["objHorarios"][$y])){
            $objAux["objEmpresa"][] = $objOperacoes["objEmpresa"][$y];
            $objAux["objApresentacao"][] = $objOperacoes["objApresentacao"][$y];
            $objAux["objInfo"][] = $objOperacoes["objInfo"][$y];
            $objAux["objHorarios"][] = $objOperacoes["objHorarios"][$y];
            $objAux["objImagem"][] = $objOperacoes["objImagem"][$y];
        }
    }
    
    if(isset($objAux)){
        $objOperacoes = $objAux;
    }
    
    return $objOperacoes;
}

