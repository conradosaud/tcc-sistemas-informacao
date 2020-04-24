<?php


// --------------------------------------------------------
/* Identificadores de ações */

if(isset($_POST["hiddenCadastroCliente"])){
    $resposta = cadastraUsuario();
    echo $resposta;
}

if(isset($_POST["hiddenAcessarPainel"])){
    $resposta = validaLogin();
    if($resposta){
        /*
        if($_POST["cboxMantermeConectado"] == true){
            $tempo = time() + 3600 * 24 * 30;
            setcookie('ManterConectado', $resposta->getIdCliente(), $tempo, '/');
        }
         */
        
        adicionaSessao($resposta);
        echo "ok";
    }else{
        echo "false";
    }
}

if((isset($_POST["Logout"]) && $_POST["Logout"]==true) || (isset($_GET["Logout"]) && $_GET["Logout"]==true)){
    session_start();
    $_SESSION["IdCliente"] = null;
    $_SESSION["NomeCliente"] = null;
    
    session_destroy();
    
    echo "<script>window.location.href = '../login/painel_de_acesso.php'</script>";
}

// --------------------------------------------------------
/* Funções */
function validaLogin(){
    $Email = $_POST["txtEmailLogin"];
    $Senha = $_POST["txtSenhaLogin"];
    
    include_once("../../controller/ClienteControlador.php");
    $resposta = ClienteControlador::autenticarCliente($Email, $Senha);
    
    return $resposta;
}

function adicionaSessao($obj){
    session_start();
    
    $Nome = $obj->getNome();
    $Nome = explode(" ", $Nome);
    $_SESSION["NomeCliente"] = $Nome[0];
    $_SESSION["IdCliente"] = $obj->getIdCliente();
}

function cadastraUsuario(){
    $Nome = $_POST["txtNomeCad"];
    $Email = $_POST["txtEmailCad"];
    $Senha = $_POST["txtSenhaCad"];
    $Telefone = $_POST["txtTelefoneCad"];
    
    include_once("./funcoes_utilidade.php");
    $Nome = titleCase($Nome);

    include_once("../../controller/ClienteControlador.php");
    $objCliente = ClienteControlador::criaObj(null, $Nome, $Email, $Telefone, $Senha);
    $objControlador = new ClienteControlador();
    $objControlador = $objControlador->get("verificaEmail", $objCliente->getEmail());
    if($objControlador){
        return "emailExistente";
    }else{
        $objControlador = new ClienteControlador();
        $objControlador = $objControlador->post(null, $objCliente);
    }

    if($objControlador){
        return "ok";
    }else{
        return "false";
    }
}

