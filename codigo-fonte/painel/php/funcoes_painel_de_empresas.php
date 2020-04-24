<?php


// --------------------------------------------------------
/* Identificadores de ações */

if(isset($_POST["Logout"]) && $_POST["Logout"]==true){
    session_start();
    
    session_destroy();
    
    echo true;
    exit();
}

if(isset($_POST["hiddenCadastrarEmpresa"])){
    $id = cadastraEmpresa();
    if($id){
        $resposta = setaSessaoEmpresa($id);
        if($resposta){
            echo "$id";
            exit();
        }
    }
    echo "false";
    exit();
}

if(isset($_GET["tutorialP"])){
    echo "<script>var tutorialP = true;</script>";
}

if(isset($_POST["hiddenEmpresaExcluir"])){
    session_start();
    $resposta = excluirEmpresa();
    echo $resposta;
    exit();
}

if(isset($_POST["hiddenCliente"])){
    $resposta = alteraInfo();
    echo $resposta;
}

if(isset($_POST["hiddenSenha"])){
    $resposta = alteraSenha();
    echo $resposta;
}

// --------------------------------------------------------
/* Funções */

function getCliente(){
    include_once("../../controller/ClienteControlador.php");
    $objControlador = new ClienteControlador();
    $objControlador = $objControlador->get("busca", $_SESSION["IdCliente"]);
    
    return $objControlador;
}

function alteraInfo(){
    session_start();
    
    include_once("./funcoes_utilidade.php");
    $Nome = $_POST["NomeCompleto"];
    $Nome = titleCase($Nome);
    
    include_once("../../controller/ClienteControlador.php");
    $objCliente = ClienteControlador::criaObj($_SESSION["IdCliente"], $Nome, $_POST["Email"], $_POST["Telefone1"], null);
    $objControlador = new ClienteControlador();
    $objControlador = $objControlador->put("alteraInformacoes", null, $objCliente);
  
    return $objControlador;
}

function alteraSenha(){
    session_start();

    include_once("../../controller/ClienteControlador.php");
    $objCliente = ClienteControlador::criaObj($_SESSION["IdCliente"], null, null, null, $_POST["SenhaNova"]);
    $objControlador = new ClienteControlador();
    $objControlador = $objControlador->put("alteraSenha", $_POST["SenhaAtual"], $objCliente);
    
    return $objControlador;
}

function getEmpresasAnuncios(){
    include_once("../../controller/EmpresaControlador.php");
    $objEmpresas = new EmpresaControlador();
    $objEmpresas = $objEmpresas->get("buscaTodosPorCliente", $_SESSION["IdCliente"]);
    
    return $objEmpresas;
}

function cadastraEmpresa(){
    session_start();
    
    $NomeEmpresa = $_POST["txtNomeEmpresa"];
    $Seguimento = $_POST["selectSeguimento"];
    $Cidade = $_POST["selectCidade"];
    $Estado = $_POST["selectCidade"];
    $Email = $_POST["txtEmailEmpresa"];
    $Site = $_POST["txtSiteEmpresa"];
    
    if($Cidade != "Outro..."){
        $aux = explode(" - ", $Cidade);
        $Cidade = $aux[0];
        $Estado = $aux[1];
    }

    include_once("./funcoes_utilidade.php");
    $NomeEmpresa = nameCase($NomeEmpresa);
    
    include_once("../../controller/EmpresaControlador.php");
    $objEmpresa = EmpresaControlador::criaObj($_SESSION["IdCliente"], $NomeEmpresa, $Seguimento, $Email, $Site, $Cidade, $Estado);
    $objControlador = new EmpresaControlador();
    $objEmpresa = $objControlador->post(null, $objEmpresa);
    
    return $objEmpresa;
}

function setaSessaoEmpresa($id){
    include_once("../../controller/EmpresaControlador.php");
    $objControlador = new EmpresaControlador();
    $objEmpresa = $objControlador->get("buscaEmpresaPorIdEmpresa", $id);
    
    $_SESSION["IdEmpresa"] = $objEmpresa->getIdEmpresa();
    //$_SESSION["NomeEmpresa"] = $objEmpresa->getNomeEmpresa();
    //$_SESSION["EmpresaAnunciando"] = $objEmpresa->getAnunciando();
    
    return $objEmpresa;
}

function excluirEmpresa(){
    $IdEmpresa = $_POST["hiddenEmpresaExcluir"];
    $Senha = $_POST["txtSenhaExcluir"];

    // verifica se a empresa pertence ao cliente logado
    include_once("../../controller/EmpresaControlador.php");
    $objEmpresa = new EmpresaControlador();
    $objEmpresa = $objEmpresa->get("verificaAnuncioEmpresa", ["IdEmpresa"=>$IdEmpresa,"IdCliente"=>$_SESSION["IdCliente"]]);

    // se for, verifica se a senha digitada está correta
    if($objEmpresa){
        include_once("../../controller/ClienteControlador.php");
        $objCliente = new ClienteControlador();
        $objCliente = $objCliente->get("verificaSenha", ["Senha"=>$Senha, "IdCliente"=>$_SESSION["IdCliente"]]);
        
        // se for, excluir a empresa
        if($objCliente){
            $objEmpresa = new EmpresaControlador();
            $objEmpresa = $objEmpresa->delete("removeEmpresa", $IdEmpresa);
            
            return true;
        }
    }
    
    return false;
}