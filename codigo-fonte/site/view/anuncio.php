<?php
   include_once("../php/funcoes_anuncio.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php")
        ?>
        <!--<link rel="stylesheet" href="../css/anunciados/filtro.css" />
        <link rel="stylesheet" href="../css/anunciados/lista_anuncios.css" />-->
        <link rel="stylesheet" href="../css/anuncio.css" />
        <link rel="stylesheet" href="../css/anuncio/anuncio-individual.css" />
        <link rel="stylesheet" href="../css/anuncio/404.css" />
        
        <link rel="stylesheet" href="../../assets/slider/css/extra.css" />
        
    </head>
    <body style="background-color: #F3EFE0">
        
        <?php
            include_once("./fixo/topbar.php");
            include_once("./fixo/cabecalho1.php");
        ?>

        <div class="container-fluid">
            <div class="row">
                
                <div class="st-menu">
                <?php
                    if($objAnuncio["objEmpresa"]){
                        include_once("./componentes/anuncio/interface_anuncio.php");
                    }else{
                        include_once("./componentes/anuncio/404.php");
                    }
                ?>
                </div>

            </div>
        </div>

        <?php
            include_once("./fixo/rodape.php");
        ?>

        
        <?php
            include_once("./fixo/scripts.php");
        ?>
        
        <style>
            .fbCarregando{
                display: none;
            }
        </style>
        
        <script type="text/javascript" src="../javascript/facebook.js"></script>
        <script type="text/javascript" src="../javascript/anuncio.js"></script>
        
        <!-- Imagem slider -->
        <script type="text/javascript" src="../../assets/slider/js/extra.js"></script>
        <script src="../../assets/slider/js/jssor.slider-26.1.5.min.js"></script>
    </body>
</html>
