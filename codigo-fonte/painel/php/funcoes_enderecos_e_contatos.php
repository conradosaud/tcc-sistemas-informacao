<?php

if(isset($_POST["hiddenEndereco"])){
    $resposta = null;
    if(isset($_POST["Cadastro"])){
        $resposta = operacao("insere");
    }else{
        $resposta = operacao("altera");
    }
    echo $resposta;
}

if(isset($_POST["hiddenEmpresaExcluir"])){
    $resposta = excluir($_POST["Senha"], $_POST["IdEndereco"]);
    echo $resposta;
}

function buscaEmpresa(){
    include_once("../../controller/EmpresaControlador.php");
    $obj = new EmpresaControlador();
    $obj = $obj->get("buscaEmpresaPorIdEmpresa", $_SESSION["IdEmpresa"]);
    
    return $obj;
}

function excluir($Senha, $IdEndereco){
    session_start();
    
    // verifica se a empresa pertence ao cliente logado
    include_once("../../controller/EmpresaControlador.php");
    $objEmpresa = new EmpresaControlador();
    $objEmpresa = $objEmpresa->get("verificaAnuncioEmpresa", ["IdEmpresa"=>$_SESSION["IdEmpresa"],"IdCliente"=>$_SESSION["IdCliente"]]);

    // se for, verifica se a senha digitada está correta
    if($objEmpresa){
        include_once("../../controller/ClienteControlador.php");
        $objCliente = new ClienteControlador();
        $objCliente = $objCliente->get("verificaSenha", ["Senha"=>$Senha, "IdCliente"=>$_SESSION["IdCliente"]]);
        
        // se for, excluir o endereco
        if($objCliente){
            include_once("../../controller/AnuncioEnderecoControlador.php");
            $objEndereco = new AnuncioEnderecoControlador();
            $objEndereco = $objEndereco->delete(null, $IdEndereco);
            
            return true;
        }
    }
    
    return false;
}

function busca(){
    include_once("../../controller/AnuncioEnderecoControlador.php");
    $obj = new AnuncioEnderecoControlador();
    $obj = $obj->get("buscaTodosPorIdEmpresa", $_SESSION["IdEmpresa"]);
    
    if($obj != NULL){
        $_SESSION["IdEnderecos"] = [];
        foreach($obj as $id){
            $_SESSION["IdEnderecos"][] = $id->getIdEndereco();
        }
    }else{
        include_once("../../controller/EmpresaControlador.php");
        $objEmpresa = new EmpresaControlador();
        $objEmpresa = $objEmpresa->put("alteraAnunciando", $_SESSION["IdEmpresa"], 0);
    }
    
    return $obj;
}

function operacao($operacao){
    session_start();
    
    $Email = $_POST["txtEmail"];
    $Cep = $_POST["txtCep"];
    //$Cidade = $_POST["txtCidade"];
    $Rua = $_POST["txtRua"];
    $Numero = $_POST["txtNumero"];
    $Bairro = $_POST["txtBairro"];
    $Complemento = $_POST["txtComplemento"];
    $Telefone1 = $_POST["txtTelefone1"];
    $Telefone2 = $_POST["txtTelefone2"];
    $Celular1 = $_POST["txtCelular1"];
    $Celular2 = $_POST["txtCelular2"];
    $cboxCelular1 = ($_POST["cboxCelular1-ajax"]=="true"?1:0);
    $cboxCelular2 = ($_POST["cboxCelular2-ajax"]=="true"?1:0);
    
    include_once("./funcoes_utilidade.php");
    $Rua = nameCase($Rua);
    $Bairro = nameCase($Bairro);
    $Complemento = nameCase($Complemento);
    
    include_once("../../controller/AnuncioEnderecoControlador.php");
    $objEndereco = AnuncioEnderecoControlador::criaObj($_SESSION["IdEmpresa"], (isset($_POST["hiddenIdEndereco"])?$_POST["hiddenIdEndereco"]:0),
            $Email, $Cep, $Rua, $Numero, $Bairro, $Complemento, $Telefone1, $Telefone2, $Celular1, $Celular2, $cboxCelular1, $cboxCelular2);
    
    $objControlador = new AnuncioEnderecoControlador();
    if($operacao == "insere"){
        $objControlador = $objControlador->post("insere", $objEndereco);
    }else{
        // verifica se o IdEndereco consta dentro da sessao de Ids daquela empresa
        if(in_array($objEndereco->getIdEndereco(), $_SESSION["IdEnderecos"])){
            $objControlador = $objControlador->put("altera", null, $objEndereco);
        }else{
            $objEndereco = null;
        }
    }
    
    return $objControlador;
}
