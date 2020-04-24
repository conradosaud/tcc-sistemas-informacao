<?php
    session_start();
    include_once("../php/funcoes_painel.php");
    include_once("../php/funcoes_apresentacao.php");
    $objApresentacao = busca();
    //var_dump($objApresentacao);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
    </head>
    <body id="viewApresentacao">
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>
            
            
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="font-size: 16px;">Página em construção...</h5>
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        
        <?php
            include_once("./fixo/scripts.php");
        ?>
        
        <script>
            $("#a_editar_meu_anuncio").addClass("active-menu");
            $("#a_integracao_com_analytics").addClass("active-menu");
            $(".nav-second-level").addClass("in");
        </script>
        
        <script src="../javascript/apresentacao.js"></script>
    </body>
</html>
