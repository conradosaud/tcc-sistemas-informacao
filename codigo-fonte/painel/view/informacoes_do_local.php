<?php
    session_start();
    include_once("../php/funcoes_painel.php");
    include_once("../php/funcoes_informacoes_do_local.php");
    $objInfo = busca();
    //var_dump($objInfo);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
    </head>
    <body id="viewInformacoesDoLocal">
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>
            
            
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><i class="fa fa-info"></i> &nbsp; Editar Informações do Local</h2>  
                            <h5 style="font-size: 16px;">Marque as opções que correspondam com o seu estabelecimento.</h5>
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                    <hr />

                    <div class="row">
                        <div class="col-md-12">
                            <!--   Kitchen Sink -->
                            <div class="panel panel-default">
                                <div class="panel-heading text-right">
                                    <button id="btnSalvar" class="btn btn-success"><i class="fa fa-save"></i> Salvar alterações</button>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr id="trAtendeLocal">
                                                    <td><label><input type="checkbox" <?php echo ($objInfo->getAtendeLocal()?"checked":null); ?> /> Atendemos no local</label></td>
                                                    <td><span class="text-muted">Não atendemos clientes em nosso estabelecimento.</span></td>
                                                </tr>
                                                <tr id="trEntregasDomicilio">
                                                    <td><label><input type="checkbox" <?php echo ($objInfo->getEntregaDomicilio()?"checked":null); ?> /> Entrega a domicílio</label></td>
                                                    <td><span class="text-muted">Não realizamos entregas a domicílio.</span></td>
                                                </tr>
                                                <tr id="trEstacionamento">
                                                    <td><label><input type="checkbox" <?php echo ($objInfo->getEstacionamento()?"checked":null); ?> /> Estacionamento</label></td>
                                                    <td><span class="text-muted">Não possuimos estacionamento para clientes.</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="panel-footer text-right">
                                    <button id="btnSalvarProsseguir" class="btn btn-primary">Salvar e prosseguir <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <!-- End  Kitchen Sink -->
                        </div>
                    </div>
                    
                    
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
            $("#a_informacoes_do_local").addClass("active-menu");
            $(".nav-second-level").addClass("in");
        </script>
        
        <script src="../javascript/informacoes_do_local.js"></script>
    </body>
</html>
