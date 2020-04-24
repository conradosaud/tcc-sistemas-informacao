<?php

$objAnuncios = NULL;
$objAnunciosImpulsionados = NULL;


if(
        (isset($_GET["filtro"]) && $_GET["filtro"] == "on")
        ||
        (isset($_GET["Pesquisa"]) && strlen($_GET["Pesquisa"]) > 2)
    ){
    $obj = buscaFiltros($_GET);
    $objAnuncios = $obj["geral"];
    $objAnunciosImpulsionados = $obj["impulsionados"];
}else{
    $obj = buscaFiltros(NULL);
    $objAnuncios = $obj["geral"];
    $objAnunciosImpulsionados = $obj["impulsionados"];
}
    

    


include_once("funcoes_geral.php");

// Funções @@@@@@@@@@@@

function buscaPesquisar($texto){
    include_once("../../controller/AnuncioOperacoesControlador.php");
    $objOperacoes = new AnuncioOperacoesControlador();
    $objOperacoes = $objOperacoes->get("buscaPesquisa", $texto);

    $objOperacoes["geral"] = consertaHorariosFiltro($objOperacoes["geral"], $filtros);
    
    return $objOperacoes;
}

function buscaFiltros($filtros){
    include_once("../../controller/AnuncioOperacoesControlador.php");
    $objOperacoes = new AnuncioOperacoesControlador();
    $objOperacoes = $objOperacoes->get("buscaFiltros", $filtros);

    $objOperacoes["geral"] = consertaHorariosFiltro($objOperacoes["geral"], $filtros);
    $objOperacoes["impulsionados"] = consertaHorariosFiltro($objOperacoes["impulsionados"], $filtros);
    
    return $objOperacoes;
}

function consertaHorariosGeral($objOperacoes){
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

function consertaHorariosFiltro($objOperacoes, $filtros){
    $filtrados = false;
    if(isset($filtros["F"])){
        $fHorarios = explode("%", $filtros["F"]);
        if(count($fHorarios)!=0){
            if($fHorarios = "Todos"){
                $objOperacoes = consertaHorariosGeral($objOperacoes);
            }
            for($i = 0; $i < count($fHorarios); $i++){
                // procurar por "to agora" para "aberto agora" na string, ta bugado
                if(strpos($fHorarios[$i], "to agora") !== false){
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
                }
                if(strpos($fHorarios[$i], "do agora") !== false){
                    include_once("funcoes_geral.php");
                    for($y = 0; $y < count($objOperacoes["objEmpresa"]); $y++){
                        if(!isOpen($objOperacoes["objHorarios"][$y])){
                            $objAux["objEmpresa"][] = $objOperacoes["objEmpresa"][$y];
                            $objAux["objApresentacao"][] = $objOperacoes["objApresentacao"][$y];
                            $objAux["objInfo"][] = $objOperacoes["objInfo"][$y];
                            $objAux["objHorarios"][] = $objOperacoes["objHorarios"][$y];
                            $objAux["objImagem"][] = $objOperacoes["objImagem"][$y];
                        }
                    }
                }
                
                if(isset($objAux) && isset($objAux["objEmpresa"])){
                    $objOperacoes = $objAux;
                }
            }
        }
    }else{
        $objOperacoes = consertaHorariosGeral($objOperacoes);
    }
    
    return $objOperacoes;
}

function verificaFiltro($filtro){
    switch($filtro){
        case isset($filtro["Categoria"]):
            return buscaFiltroTipo($filtro["Categoria"]);
        default:
            return buscaTodos();
    }
}

function buscaTodos(){
    include_once("../../controller/AnuncioOperacoesControlador.php");
    $objOperacoes = new AnuncioOperacoesControlador();
    $procedureVar = ["Var_Anunciando"=>1, "Var_Ordem"=>"empresa.IdEmpresa DESC"];
    $objOperacoes = $objOperacoes->get("buscaTodosBasico", $procedureVar);

    return $objOperacoes;
}

function buscaFiltroTipo($tipo){
    include_once("../../controller/AnuncioOperacoesControlador.php");
    $objOperacoes = new AnuncioOperacoesControlador();
    $procedureVar = ["Var_Anunciando"=>"1", "Var_Ordem"=>"empresa.IdEmpresa DESC", "Var_Categoria"=>$tipo];
    $objOperacoes = $objOperacoes->get("buscaFiltroCategoria", $procedureVar);
    
    return $objOperacoes;
}


