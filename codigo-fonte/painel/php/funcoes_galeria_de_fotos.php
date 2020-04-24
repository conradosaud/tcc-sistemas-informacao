<?php

if(isset($_FILES["fileAlbum"])){
    session_start();
    $nome = formataImg();
    if($nome==null){
        echo "false cuazumammmma";
    }else{
        $resposta = insereImagem($nome);
        echo $resposta;
    }
    exit();
}


if(isset($_POST["hiddenTornarPrincipal"])){
    $resposta = tornaPrincipal();
    echo $resposta;
}

if(isset($_POST["hiddenRemover"])){
   $resposta = removerImagens();
   echo $resposta;
}

function removerImagens(){
    session_start();
    
    $imagens = explode(",", $_POST["ImgRemover"]);

    include_once("../../controller/AnuncioImagemControlador.php");
    $obj = new AnuncioImagemControlador();
    $obj = $obj->delete(null, $imagens);
    
    return $obj;
}

function tornaPrincipal(){
    session_start();
    
    $IdImagem = $_POST["ImgPrincipal"];
    
    include_once("../../controller/AnuncioImagemControlador.php");
    $obj = new AnuncioImagemControlador();
    $obj = $obj->put("tornaPrincipal", $_SESSION["IdEmpresa"], $IdImagem);
    
    return $obj;
}

function busca(){
    include_once("../../controller/AnuncioImagemControlador.php");
    $obj = new AnuncioImagemControlador();
    $obj = $obj->get("busca", $_SESSION["IdEmpresa"]);
    
    return $obj;
}

function insereImagem($nome){
    include_once("../../controller/AnuncioImagemControlador.php");
    
    $objImagem = AnuncioImagemControlador::criaObj($_SESSION["IdEmpresa"], $nome, 0);
    
    $objControlador = new AnuncioImagemControlador();
    $objControlador = $objControlador->post(null, $objImagem);
    
    return $objControlador;
}

function verificaLimite(){
    include_once("../../controller/AnuncioImagemControlador.php");
    $objControlador = new AnuncioImagemControlador();
    $objControlador = $objControlador->get("totalImagens", $_SESSION["IdEmpresa"]);
    
    return $objControlador;
}

function formataImg(){
    $range = rand(0,9999);
    list($w, $h) = getimagesize($_FILES['fileAlbum']['tmp_name']);
    $nome = $range."-".$_FILES['fileAlbum']['name'];
    mkdir('../img/'.$_SESSION["IdEmpresa"].'/', 0755, true);
    $path = '../img/'.$_SESSION["IdEmpresa"].'/'.$nome;
    
    $imgString = file_get_contents($_FILES['fileAlbum']['tmp_name']);
    $image = imagecreatefromstring($imgString);
    $tmp = imagecreatetruecolor($w, $h);
    imagecopyresampled($tmp, $image, 0, 0, 0, 0, $w, $h, $w, $h);

    
     switch ($_FILES['fileAlbum']['type']) {
     case 'image/jpeg':
       imagejpeg($tmp, $path, 100);
       break;
     case 'image/png':
       imagepng($tmp, $path, 0);
       break;
     default:
       return false;
    }
    
    return $nome;
}
