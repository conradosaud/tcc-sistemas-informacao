<?php

if(isset($_POST["verificaCupom"])){
    $resposta = verificaCupom($_POST["cupom"]);
    if($resposta){
        if($resposta->getStatus() == "A"){
            
            $cupom = json_encode((array)$resposta);
            $cupom = str_ireplace('\u0000Cupons\u0000', '', $cupom);
            
            $plano = buscaPlano($resposta);
            $plano = json_encode((array)$plano[0]);
            $plano = str_ireplace('\u0000Plano\u0000', '', $plano);
            
            $json = ["Cupom"=>$cupom, "Plano"=>$plano];
            $json = json_encode($json);

            echo $json;
            
        }else{
            echo "cupomInvalido";
        }
    }else{
        echo "cupomInexistente";
    }
    exit();
}

if(isset($_POST["contratarPlano"])){
    $resposta = realizaTransacao();
    if($resposta){
        echo "Sucesso";
    }else{
        echo "Erro";
    }
}

if(isset($_POST["ativarCupom"])){
    $resposta = ativarCupom($_POST["cupom"]);
    if($resposta){
        echo TRUE;
    }else{
        echo FALSE;
    }
}

if(isset($_GET["new"]) && $_GET["new"]=="cupom"){
    include_once("../../controller/CuponsControlador.php");
    $objCupom = new CuponsControlador();
    $objCupom = $objCupom->get("geraCupom", NULL);
    echo "<script>alert('Novo cupo gerado: ".$objCupom."');</script>";
}

function realizaTransacao(){
    $IdPlano = $_POST["IdPlano"];
    $IdCupom = $_POST["IdCupom"];
    $DataDuracao = $_POST["diasEscolhidos"];
    $Valor = $_POST["Valor"];
    $Desconto = $_POST["Desconto"];
    
    session_start();
    include_once("../../controller/TransacaoControlador.php");
    $obj = TransacaoControlador::criaObj($IdPlano, $_SESSION["IdEmpresa"], $IdCupom, $Desconto, $DataDuracao, NULL, NULL, $Valor);

    $objTransacao = new TransacaoControlador();
    $objTransacao = $objTransacao->post(null, $obj);
    
    return $objTransacao;
}

function buscaPlano($cupom){
    include_once("../../controller/PlanoControlador.php");
    $objPlano = new PlanoControlador();
    $objPlano = $objPlano->get("buscaPlanoPorCupom", $cupom);
    
    return $objPlano;
}

function verificaCupom($cupom){
    include_once("../../controller/CuponsControlador.php");
    $objCupom = new CuponsControlador();
    $objCupom = $objCupom->get("verificaCupomPorCodigo", $cupom);
    
    return $objCupom;
}

function ativarCupom($cupom){
    include_once("../../controller/CuponsControlador.php");
    $objCupom = new CuponsControlador();
    $objCupom = $objCupom->get("ativarCupom", $cupom);
    
    return $objCupom;
}

function nomeMes($mes){
    switch($mes){
        case 1: return "Janeiro";
        case 2: return "Fevereiro";
        case 3: return "Março";
        case 4: return "Abril";
        case 5: return "Maio";
        case 6: return "Junho";
        case 7: return "Julho";
        case 8: return "Agosto";
        case 9: return "Setembro";
        case 10: return "Outubro";
        case 11: return "Novembro";
        case 12: return "Dezembro";
    }
}

