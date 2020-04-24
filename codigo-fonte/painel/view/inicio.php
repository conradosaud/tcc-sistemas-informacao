<?php
session_start();
include_once("../php/funcoes_painel.php");
include_once("../php/funcoes_visao_geral.php");
include_once("../php/funcoes_integracao.php");
$objAnuncio = getTodosAnuncios($_SESSION["IdEmpresa"]);
$objIntegracao = getTodasIntegracoes($_SESSION["IdEmpresa"]);

?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        include_once("./fixo/meta.php");
        include_once("./fixo/header.php");
        ?>
        <link href="../css/inicio.css" rel="stylesheet" />
    </head>
    <body id="viewInicio">
        <div class="tutorial" style="display:none;"></div>
        <div id="wrapper">

            <?php
            include_once("./fixo/navbar-top.php");
            include_once("./fixo/navbar-side.php");
            ?>


            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="etapa1" style="background-color: white;">
                            <h2><i class="fa fa-home"></i> &nbsp; Início</h2>  
                            <h5 style="font-size: 16px;">Olá, <?php echo $_SESSION["NomeCliente"]; ?>, é bom vê-lo aqui. Você está no painel de configurações da empresa <?php echo $_SESSION["NomeEmpresa"]; ?>.</h5>
                            </div>
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                    <hr />

                    <div class="row">
                        <div class="col-md-12">
                            <p class="lead">Acesse rapidamente os paineis:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-6" id="etapa2">   
                            <a href="visao_geral.php" class="btn-tutorial" style="text-decoration: none;">
                                <div class="panel panel-back noti-box">
                                    <span class="icon-box bg-color-red set-icon">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <div class="text-box" >
                                        <p class="text-muted">Editar meu anúncio</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">   
                            <a href="relatorios_e_informacoes.php" style="text-decoration: none;">
                                <div class="panel panel-back noti-box">
                                    <span class="icon-box bg-color-green set-icon">
                                        <i class="fa fa-bar-chart"></i>
                                    </span>
                                    <div class="text-box" >
                                        <p class="text-muted">Relatório e informações</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">     
                            <a href="planos_para_anuncios.php" style="text-decoration: none;">
                                <div class="panel panel-back noti-box">
                                    <span class="icon-box bg-color-blue set-icon">
                                        <i class="fa fa-rocket"></i>
                                    </span>
                                    <div class="text-box" >
                                        <p class="text-muted">Planos para anúncios</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">   
                            <a href="duvidas_e_ajuda.php" style="text-decoration: none;">
                                <div class="panel panel-back noti-box">

                                    <span class="icon-box bg-color-brown set-icon">
                                        <i class="fa fa-info-circle"></i>
                                    </span>
                                    <div class="text-box" >
                                        <p class="text-muted">Dúvidas e informações</p>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                        
                    <div class="row">
                    
                    <?php
                        if(getAtivo($objAnuncio)){
                    ?>
                    
                    <?php 
                        if($_SESSION["EmpresaAnunciando"] == true){    
                    ?>

                        <div class="col-md-6 col-sm-12 col-xs-12">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-green">
                                    <i class="fa fa-eye"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text"> Seu anúncio está <strong style="color:#3C763D;"><u>ativo</u></strong> no momento.</p>
                                    <p class="text-muted">Todos os visitantes podem visitar e visualizar seu anúncio. <a href="#">Clique aqui</a> para ver a exibição do seu anúncio.</p>
                                    <br>
                                    <div class="text-right">
                                        <a href="../php/funcoes_visao_geral.php?Anunciando=0" class="btn btn-sm btn-danger"><i class="fa fa-power-off"></i> Desativar anúncio</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }else{ ?>
                    
                        <div class="col-md-6 col-sm-12 col-xs-12">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red">
                                    <i class="fa fa-eye-slash"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text"> Seu anúncio está <strong style="color:#C07473;"><u>desativado</u></strong> no momento.</p>
                                    <p class="text-muted">Os visitantes não possuem acesso seu anúncio e não podem visualizá-lo.</p>
                                    <br>
                                    <div class="text-center">
                                        <a href="../php/funcoes_visao_geral.php?Anunciando=1" class="btn btn-success"><i class="fa fa-power-off"></i> Ativar anúncio</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <?php } ?>
                    
                    <?php }else{ ?>

                        <div class="col-md-6 col-sm-12 col-xs-12">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red">
                                    <i class="fa fa-window-close"></i>
                                </span>
                                <div class="text-box">
                                    <p class="main-text"> Seu anúncio ainda está incompleto.</p>
                                    <p class="text-muted">Ainda faltam algumas informações para serem preenchidas em relação ao seu anúncio para que o mesmo possa começar a ser visitado pelos usuários.</p>
                                </div>
                            </div>
                        </div>
                    
                    <?php } ?>
                    
                        <div class="col-md-3 col-sm-6 col-xs-12 col-lg-3">
                            <div class="panel panel-primary text-center no-boder <?php echo (getForm($objAnuncio)>=70?"bg-color-green":"bg-color-red"); ?>">
                                <div class="panel-body">
                                    <i class="fa <?php echo (getForm($objAnuncio)>=70?"fa-star":"fa-star-half-o"); ?> fa-5x"></i>
                                    <br>
                                    <span>Seu anúncio está</span><br>
                                    <span class="lead"><strong><?php echo getForm($objAnuncio); ?>%</strong></span><br>
                                </div>
                                <a href="visao_geral.php" style="text-decoration: none; color: white;">
                                    <div class="panel-footer <?php echo (getForm($objAnuncio)>=70?"back-footer-green":"back-footer-red"); ?>">
                                        Ver agora
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-xs-12 col-lg-3">
                            <div class="panel panel-primary text-center no-boder bg-color-blue">
                                <div class="panel-body">
                                    <i class="fa fa-graduation-cap fa-5x"></i>
                                    <br>
                                    <span>Dicas de marketing</span><br>
                                    <span class="lead"><strong>Gratuito!</strong></span><br>
                                </div>
                                <a href="#" style="text-decoration: none; color: white;">
                                    <div class="panel-footer back-footer-green">
                                        Ver agora
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading text-center">
                                    <p style="padding: 0; margin-bottom:0;">Veja o que preparamos para você</p>
                                </div>        
                                <div class="panel-body" style="padding:0;"> 
                                    <iframe style="width: 100%; height: 280px" src="//www.youtube.com/embed/ac7KhViaVqc" allowfullscreen=""></iframe>

                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading text-center">
                                    <p style="padding: 0; margin-bottom:0;">Suas integrações</p>
                                </div>
                                <div class="panel-body">
                                    <span>As integrações que oferecemos são de suma importância para o marketing da sua
                                        empresa. <a href="#">Clique aqui</a> para saber mais.</span><br>
                                    <h5><strong>Facebook</strong></h5>
                                    <div style="margin-bottom:5px;" class="alert <?php echo (validaFacebook($objIntegracao["Facebook"])?"alert-success":"alert-danger"); ?>">
                                        <?php if(validaFacebook($objIntegracao["Facebook"])){?>
                                        Parabéns! Sua integração com o Facebook está completa. <a href="integracao_com_facebook.php">
                                            Clique aqui</a> para vê-la.
                                        <?php }else{ ?>
                                            Você ainda não realizou sua integração com o Facebook, <a href="#">Clique aqui</a> para
                                            integra-la ao nosso sistema e potencialize seu marketing!
                                        <?php } ?>
                                    </div>
                                    <a href="#">Clique aqui</a> para saber mais sobre os benefícios da integração com o Facebook.
                                    <br />
                                    <h5><strong>Google Maps</strong></h5>
                                    <div style="margin-bottom:5px;" class="alert <?php echo (validaMaps($objIntegracao["Maps"])?"alert-success":"alert-danger"); ?>">
                                        <?php if(validaMaps($objIntegracao["Maps"])){?>
                                        Parabéns! Sua integração com o Google Maps está completa. <a href="integracao_com_maps.php">
                                            Clique aqui</a> para vê-la.
                                        <?php }else{ ?>
                                            Você ainda não realizou sua integração com o Google Maps, <a href="integracao_com_maps.php">
                                            clique aqui</a> para integra-la e facilite seus novos freguêses a encontrar seu negócio!
                                        <?php } ?>
                                    </div>
                                    <a href="#">Clique aqui</a> para saber mais sobre os benefícios da integração com o Google Maps.
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12 col-lg-3">
                            <div class="panel panel-primary text-center no-boder bg-color-red">
                                <div class="panel-body">
                                    <i class="fa fa-youtube-play fa-5x"></i>
                                    <br>
                                    <span>Conheça nosso canal no</span><br>
                                    <span class="lead"><strong>Youtube</strong></span><br>
                                </div>
                                <a href="#" style="text-decoration: none; color: white;">
                                    <div class="panel-footer back-footer-red">
                                        Visitar canal
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 col-lg-3">
                            <div class="panel panel-success text-center no-boder bg-color-green">
                                <div class="panel-body">
                                    <i class="fa fa-exclamation fa-5x"></i>
                                    <br>
                                    <span>Você possui</span><br>
                                    <span class="lead"><strong>Sugestões?</strong></span><br>
                                </div>
                                <a href="entrar_em_contato.php" style="text-decoration: none; color: white;">
                                    <div class="panel-footer back-footer-green">
                                        Envie para nós!
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 col-lg-3">
                            <div class="panel panel-success text-center no-boder bg-color-green">
                                <div class="panel-body">
                                    <i class="fa fa-magic fa-5x"></i>
                                    <br>
                                    <span>Você pode refazer o</span><br>
                                    <span class="lead"><strong>Tutorial</strong></span><br>
                                </div>
                                <a href="inicio.php?tutorial=1" style="text-decoration: none; color: white;">
                                    <div class="panel-footer back-footer-green">
                                        Refazer tutorial
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 col-lg-3">
                            <div class="panel panel-success text-center no-boder bg-color-blue">
                                <div class="panel-body">
                                    <i class="fa fa-facebook-square fa-5x"></i>
                                    <br>
                                    <span>Conheça o nosso</span><br>
                                    <span class="lead"><strong>Facebook!</strong></span><br>
                                </div>
                                <a href="#" style="text-decoration: none; color: white;">
                                    <div class="panel-footer back-footer-green">
                                        Visitar página
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
            
            <!--
            
            <div class="hidden-xs">
                <div  class="fixed-btn fixed-right">
                    <span class="dropdown">
                        <a type="button" class="btn btn-preto btn-circle" data-toggle="dropdown"><p class="lead"><i class="fa fa-ellipsis-v"></i></p></a>
                        <ul class="dropdown-menu pull-right" style="top: 40px;">
                            <li><a href="#" data-toggle="modal" data-target="#modalDicas"><i class="fa fa-magic"></i> Ver dicas deste painel</a></li>
                            <li><a href="#"><i class="fa fa-question"></i> Como usar este painel</a></li>
                        </ul>
                    </span>
                </div>
            </div>
            <div class="visible-xs">
                <div  class="fixed-btn fixed-bottom">
                    <span class="dropdown">
                        <a type="button" class="btn btn-preto btn-circle" data-toggle="dropdown"><p class="lead"><i class="fa fa-ellipsis-v"></i></p></a>
                        <ul class="dropdown-menu pull-right" style="margin-top: -100px;">
                            <li><a href="#" data-toggle="modal" data-target="#modalDicas"></i> Ver dicas deste painel</a></li>
                            <li><a href="#"><i class="fa fa-question"></i> Como usar este painel</a></li>
                        </ul>
                    </span>
                </div>
            </div>
            
            -->
            
        </div>
        <!-- /. WRAPPER  -->

        
        
        <!-- Dicas do painel -->
        <div id="modalDicas" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close close-tutorial" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Dicas do painel</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center lead">Inicio</p>
                        <p>No painel de <strong>Início</strong> você possui algumas informações rápidas sobre
                        seu anúncio, assim como alguns botões de acesso rápido a outros menus.
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <button type="button" class="btn btn-branco" data-dismiss="modal">Fechar <i class="fa fa-close"></i></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        
        <?php
        include_once("./fixo/scripts.php");
        ?>

        <script>
            $("#a_inicio").addClass("active-menu");
        </script>

        <script src="../javascript/tutorial_painel.js"></script>
    </body>
</html>
