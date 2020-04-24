<?php
    include_once("../php/funcoes_home.php");
?>

<!DOCTYPE html>
<html>
    <head>
        
        <?php
            include_once("fixo/meta.php");
            include_once("fixo/header.php");
        ?>
        
        <link rel="stylesheet" href="../css/home/home.css" />
        <link rel="stylesheet" href="../css/home/cards.css" />
        <link rel="stylesheet" href="../css/home/listaCheckbox.css" />
        <!--<link rel="stylesheet" href="../../assets/tympanus/SidebarTransitions/css/component.css" />-->
        
    </head>
    <body style="background-color: #FFF3E0;" id="bodyHome">
        
        <?php
            include_once("fixo/topbar.php");
            include_once("fixo/cabecalho1.php");
        ?>

        <div class="container-fluid">

            <?php 
                include_once("./componentes/home/1_recomendamos_para_voce.php");
                include_once("./componentes/home/2_encontre_o_que_esta_procurando.php");
            ?>
            
        </div>
        
        <?php
            include_once("./componentes/home/3_cadastre_sua_empresa.php");
        ?>
        
        <div class="container-fluid">
        
            <?php
                include_once("./componentes/home/4_veja_mais_opcoes.php");
            ?>

        </div>

        <?php
            include_once("./fixo/rodape.php");
            include_once("./fixo/scripts.php");
        ?>
        
        <script type="text/javascript" src="../javascript/home.js"></script>
        <script type="text/javascript" src="../javascript/filtro.js"></script>
    </body>
</html>
