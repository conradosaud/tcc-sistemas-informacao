<?php

function isOpen($obj){

    // cria array
    $array = [];
    $array[0][0] = NULL; $array[0][1] = NULL;
    $array[1][0] = $obj->getSegundaDas(); $array[1][1] = $obj->getSegundaAs();
    $array[2][0] = $obj->getTercaDas(); $array[2][1] = $obj->getTercaAs();
    $array[3][0] = $obj->getQuartaDas(); $array[3][1] = $obj->getQuartaAs();
    $array[4][0] = $obj->getQuintaDas(); $array[4][1] = $obj->getQuintaAs();
    $array[5][0] = $obj->getSextaDas(); $array[5][1] = $obj->getSextaAs();
    $array[6][0] = $obj->getSabadoDas(); $array[6][1] = $obj->getSabadoAs();
    $array[7][0] = $obj->getDomingoDas(); $array[7][1] = $obj->getDomingoAs();
    
    // verifica se foi inserido um horário para aquele dia
    $dia = date('N');
    if($array[$dia][0] == NULL){
        return false;
    }
    
    // verifica horarios
    date_default_timezone_set('America/Sao_Paulo');
    $currentTime = date("H:i", time());
    $currentTime = strtotime($currentTime);
    $startTime = strtotime($array[$dia][0]);
    $endTime = strtotime($array[$dia][1]);
    
    if (
    ($startTime < $endTime &&$currentTime >= $startTime &&$currentTime <= $endTime) ||
    ($startTime > $endTime && ($currentTime >= $startTime ||$currentTime <= $endTime))) {
        return true;
    }else {
        return false;
    }
}

function ordernarAnunciosHome($recomendados){
    $abertosAgora = array();
    $fechadosAgora = array();
    $embaralhados = array();
    
    for($i = 0; $i < count($recomendados["objEmpresa"]); $i++){
        if(!isset($recomendados["objEmpresa"][$i])){
            continue;
        }
        if(isOpen($recomendados["objHorarios"][$i])){
            $abertosAgora["objEmpresa"][] = $recomendados["objEmpresa"][$i];
            $abertosAgora["objHorarios"][] = $recomendados["objHorarios"][$i];
            $abertosAgora["objImagem"][] = $recomendados["objImagem"][$i];
            $abertosAgora["objEmpresa"][] = $recomendados["objEmpresa"][$i];
            $abertosAgora["objApresentacao"][] = $recomendados["objApresentacao"][$i];
            $abertosAgora["objInfo"][] = $recomendados["objInfo"][$i];
        }else{
            $fechadosAgora["objEmpresa"][] = $recomendados["objEmpresa"][$i];
            $fechadosAgora["objHorarios"][] = $recomendados["objHorarios"][$i];
            $fechadosAgora["objImagem"][] = $recomendados["objImagem"][$i];
            $fechadosAgora["objEmpresa"][] = $recomendados["objEmpresa"][$i];
            $fechadosAgora["objApresentacao"][] = $recomendados["objApresentacao"][$i];
            $fechadosAgora["objInfo"][] = $recomendados["objInfo"][$i];
        }
    }
    
    for($i = 0; $i < count($abertosAgora["objEmpresa"]); $i++){
        if(!isset($abertosAgora["objEmpresa"][$i])){
            continue;
        }
        $embaralhados["objEmpresa"][] = $abertosAgora["objEmpresa"][$i];      
        $embaralhados["objHorarios"][] = $abertosAgora["objHorarios"][$i];
        $embaralhados["objImagem"][] = $abertosAgora["objImagem"][$i];
        $embaralhados["objEmpresa"][] = $abertosAgora["objEmpresa"][$i];
        $embaralhados["objApresentacao"][] = $abertosAgora["objApresentacao"][$i];
        $embaralhados["objInfo"][] = $abertosAgora["objInfo"][$i];
    }
    for($i = 0; $i < count($fechadosAgora["objEmpresa"]); $i++){
        if(!isset($fechadosAgora["objEmpresa"][$i])){
            continue;
        }
        $embaralhados["objEmpresa"][] = $fechadosAgora["objEmpresa"][$i];
        $embaralhados["objHorarios"][] = $fechadosAgora["objHorarios"][$i];
        $embaralhados["objImagem"][] = $fechadosAgora["objImagem"][$i];
        $embaralhados["objEmpresa"][] = $fechadosAgora["objEmpresa"][$i];
        $embaralhados["objApresentacao"][] = $fechadosAgora["objApresentacao"][$i];
        $embaralhados["objInfo"][] = $fechadosAgora["objInfo"][$i];
    }
    
    var_dump($embaralhados);
    
    return $embaralhados;
    
}

