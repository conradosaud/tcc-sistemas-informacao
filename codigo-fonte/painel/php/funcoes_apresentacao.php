<?php

if(isset($_POST["hiddenApresentacao"])){
    $resposta = altera();
    echo $resposta;
}


function busca(){
    include_once("../../controller/AnuncioApresentacaoControlador.php");
    $obj = new AnuncioApresentacaoControlador();
    $obj = $obj->get("busca", $_SESSION["IdEmpresa"]);
    
    return $obj;
}

function altera(){
    session_start();
    
    $NomeExibicao = $_POST["txtNomeExibicao"];
    $DescricaoCurta = $_POST["txtDescricaoCurta"];
    $DescricaoLonga = $_POST["txtDescricaoLonga"];
    
    include_once("./funcoes_utilidade.php");
    $NomeExibicao = nameCase($NomeExibicao);
    $DescricaoCurta = textCase($DescricaoCurta);
    $DescricaoLonga = textCase($DescricaoLonga);
    
    include_once("../../controller/AnuncioApresentacaoControlador.php");
    $obj = AnuncioApresentacaoControlador::criaObj($_SESSION["IdEmpresa"], $NomeExibicao, $DescricaoCurta, $DescricaoLonga);
    
    $objApresentacao = new AnuncioApresentacaoControlador();
    $objApresentacao = $objApresentacao->put("altera", null, $obj);
    
    return $objApresentacao;
}
