<?php
    include_once("../php/funcoes_anunciados.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php")
        ?>
        <link rel="stylesheet" href="../css/anunciados/filtro.css" />
        <link rel="stylesheet" href="../css/anunciados/lista_anuncios.css" />
        <link rel="stylesheet" href="../css/anuncio.css" />
        <link rel="stylesheet" href="../css/home/listaCheckbox.css" />
        
        <!--<link rel="stylesheet" href="../assets/tympanus/SidebarTransitions/css/component.css" />-->
        <link rel="stylesheet" href="../../assets/geral/css/ribbon.css" />
    </head>
    <body style="background-color: #F3EFE0">

        <?php
            include_once("./fixo/topbar.php");
            include_once("./fixo/cabecalho1.php");
        ?>

        <div class="container-fluid menu-list">
            <div class="row">

                <?php
                    include_once("./componentes/anunciados/filtro.php");
                    include_once("./componentes/anunciados/lista_anuncios.php");
                ?>

            </div>
        </div>

        <?php
            include_once("./fixo/rodape.php");
        ?>

        <?php
            include_once("./fixo/scripts.php");
        ?>
        
        <script type="text/javascript" src="../javascript/anunciados.js"></script>
        <script type="text/javascript" src="../javascript/filtro.js"></script>
    </body>
</html>
