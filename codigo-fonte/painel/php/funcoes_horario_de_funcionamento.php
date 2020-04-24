<?php

if(isset($_POST["hiddenHorarios"])){
    $obj = json_decode($_POST["form"]);
    $obj = corrige($obj);
    $resposta = altera($obj);
    echo $resposta;
}

if(isset($_POST["getHorarios"])){
    session_start();
    
    include_once("../../controller/AnuncioHorariosControlador.php");
    $obj = busca();
    $obj = AnuncioHorariosControlador::criaObjJs($obj);
    echo $obj;
}

function busca(){
    include_once("../../controller/AnuncioHorariosControlador.php");
    $objHorarios = new AnuncioHorariosControlador();
    $objHorarios = $objHorarios->get("busca", $_SESSION["IdEmpresa"]);
    
    return $objHorarios;
}

function altera($obj){
    session_start();
    
    include_once("../../controller/AnuncioHorariosControlador.php");
    $objHorarios = new AnuncioHorariosControlador();
    $objHorarios = $objHorarios->put(null, $_SESSION["IdEmpresa"], $obj);
    
    return $objHorarios;
}

function corrige($obj){
    if($obj->segunda->todo == true){$obj->segunda->das = "99:99"; $obj->segunda->as = "99:99";}
    if($obj->terca->todo == true){$obj->terca->das = "99:99"; $obj->terca->as = "99:99";}
    if($obj->quarta->todo == true){$obj->quarta->das = "99:99"; $obj->quarta->as = "99:99";}
    if($obj->quinta->todo == true){$obj->quinta->das = "99:99"; $obj->quinta->as = "99:99";}
    if($obj->sexta->todo == true){$obj->sexta->das = "99:99"; $obj->sexta->as = "99:99";}
    if($obj->sabado->todo == true){$obj->sabado->das = "99:99"; $obj->sabado->as = "99:99";}
    if($obj->domingo->todo == true){$obj->domingo->das = "99:99"; $obj->domingo->as = "99:99";}
    
    return $obj;
}

