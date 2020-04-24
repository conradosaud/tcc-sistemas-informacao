<?php


// --------------------------------------------------------
/* Identificadores de ações */

if(isset($_GET["Anunciando"])){
    session_start();
    
    echo "Aguarde...";
    
    $anunciando = 0;
    switch($_GET["Anunciando"]){
        case 1:
            $anunciando = 1;
            break;
        case 2:
            $anunciando = 0;
            break;
        default:
            $anunciando = 0;
            break;
    }
    
    include_once("../../controller/EmpresaControlador.php");
    $objEmpresa = new EmpresaControlador();
    $objEmpresa = $objEmpresa->put("alteraAnunciando", $_SESSION["IdEmpresa"], $anunciando);
    
    if($objEmpresa){
        $_SESSION["EmpresaAnunciando"] = $anunciando;
    }else{
        $_SESSION["EmpresaAnunciando"] = 0;
    }
    
    if(isset($_GET["tutorial"])){
        echo "<script>window.location.href = '../view/visao_geral.php?tutorial=1'</script>";
    }else{
        echo "<script>window.location.href = '../view/visao_geral.php'</script>";
    }
}

// --------------------------------------------------------
/* Funções */


function getTodosAnuncios($IdEmpresa){
    
    include_once("../../controller/AnuncioApresentacaoControlador.php");
    include_once("../../controller/AnuncioEnderecoControlador.php");
    include_once("../../controller/AnuncioHorariosControlador.php");
    include_once("../../controller/AnuncioImagemControlador.php");
    include_once("../../controller/AnuncioInfoControlador.php");
    
    $objApresentacao = new AnuncioApresentacaoControlador();
    $objEndereco = new AnuncioEnderecoControlador();
    $objHorarios = new AnuncioHorariosControlador();
    $objImagem = new AnuncioImagemControlador();
    $objInfo = new AnuncioInfoControlador();
    
    $objApresentacao = $objApresentacao->get("busca", $IdEmpresa);
    $objEndereco = $objEndereco->get("buscaTodosPorIdEmpresa", $IdEmpresa);
    $objHorarios = $objHorarios->get("busca", $IdEmpresa);
    $objImagem = $objImagem->get("busca", $IdEmpresa);
    $objInfo = $objInfo->get("busca", $IdEmpresa);

    $objAnuncio = ["Apresentacao"=>$objApresentacao, "Endereco"=>$objEndereco, 
        "Horarios"=>$objHorarios, "Imagem"=>$objImagem, "Info"=>$objInfo];
    
    return $objAnuncio;
}

function formApresentacao($obj){
    $apresentacao = 0;
    if($obj["Apresentacao"]->getNomeExibicao()){
        $apresentacao += 34;
    }
    if($obj["Apresentacao"]->getDescricaoCurta()){
        $apresentacao += 33;
    }
    if($obj["Apresentacao"]->getDescricaoLonga()){
        $apresentacao += 33;
    }
    
    return $apresentacao;
}

function formEnderecos($obj){
    return (count($obj["Endereco"]) >= 1?100:0);
}

function formHorarios($obj){
    if($obj["Horarios"]->getSegundaDas() || $obj["Horarios"]->getTercaDas() || $obj["Horarios"]->getQuartaDas() || $obj["Horarios"]->getQuintaDas() || $obj["Horarios"]->getSextaDas() || $obj["Horarios"]->getSabadoDas() || $obj["Horarios"]->getDomingoDas()){
        return 100;
    }
    return 0;
}

function formImagem($obj){
    $imagem = 0;
    if(count($obj["Imagem"]) == 1){
        $imagem = 25;
    }
    if(count($obj["Imagem"]) >= 2 ){
        $imagem = 50;
    }
    foreach($obj["Imagem"] as $img){
        if($img->getPrincipal()){
            $imagem += 50;
            break;
        }
    }
    return $imagem;
}

function formInfo($obj){
    if(!$obj["Info"]->getEntregaDomicilio() && !$obj["Info"]->getAtendeLocal() && !$obj["Info"]->getEstacionamento()){
        return 0;
    }else{
        return 100;
    }
}

function getForm($obj){
    $porcentagem = 0;
    $apresentacao = formApresentacao($obj);
    $enderecos = formEnderecos($obj);
    $imagem = formImagem($obj);
    $horarios = formHorarios($obj);
    $info = formInfo($obj);

    if($apresentacao == 100){
        $porcentagem += 30;
    }
    if($enderecos == 100){
        $porcentagem += 20;
    }
    if($imagem == 100){
        $porcentagem += 20;
    }
    if($horarios == 100){
        $porcentagem += 20;
    }
    if($info == 100){
        $porcentagem += 10;
    }
    
    return $porcentagem;
}

function getAtivo($obj){
    $apresentacao = formApresentacao($obj);
    $endereco = formEnderecos($obj);
    if($apresentacao && $endereco == 100){
        return true;
    }else{
        return false;
    }
}
