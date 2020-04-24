<?php
    session_start();
    include_once("../php/funcoes_painel.php");
    include_once("../php/funcoes_visao_geral.php");
    $objAnuncio = getTodosAnuncios($_SESSION["IdEmpresa"]);
    $anuncioAtivo = getAtivo($objAnuncio);
?>

<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
    </head>
    <body id="viewVisaoGeral">
        <div class="tutorial" style="display: none;"></div>
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>
            
            
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="etapa4" style="background-color: white;">
                            <h2><i class="fa fa-circle"></i> &nbsp; Visão Geral</h2>   
                            <h5 style="font-size: 16px;">Veja abaixo como está a configuração geral do seu anúncio e o que pode ser feito para melhorá-lo.</h5>
                            </div>
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                    <hr />

                    <?php
                        if($anuncioAtivo){
                    ?>
                    
                    <?php 
                        if($_SESSION["EmpresaAnunciando"] == true){    
                    ?>
                    
                    <div class="row" style="display: block;">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="etapa14">           
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
                    </div>

                    <?php }else{ ?>
                    
                    <div class="row" style="display: block;">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="etapa12">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red">
                                    <i class="fa fa-eye-slash"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text"> Seu anúncio está <strong style="color:#C07473;"><u>desativado</u></strong> no momento.</p>
                                    <p class="text-muted">Os visitantes não possuem acesso seu anúncio e não podem visualizá-lo.</p>
                                    <br>
                                    <div class="text-center">
                                        <a href="../php/funcoes_visao_geral.php?Anunciando=1" class="btn btn-success btn-tutorial-ativar"><i class="fa fa-power-off"></i> Ativar anúncio</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>
                    
                    <?php }else{ ?>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="etapa5">           
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
                    </div>
                    
                    <?php } ?>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12" id="etapa13">           
                                <div class="panel panel-back noti-box">
                                    <div class="panel-body" style="margin-bottom: -30px; margin-top: -20px;">
                                        <span>Seu anúncio está <strong><?php echo getForm($objAnuncio); ?>%</strong> completo</span>
                                        <div class="progress <?php echo (getForm($objAnuncio)==100?null:"progress-striped active"); ?>">
                                            <div class="progress-bar <?php echo (getForm($objAnuncio)==100?"progress-bar-success":"progress-bar-primary"); ?>" role="progressbar" aria-valuenow="<?php echo getForm($objAnuncio); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo getForm($objAnuncio); ?>%">
                                                <span class="sr-only"><?php echo getForm($objAnuncio); ?>% Completo</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <p class="text-muted">
                                        <span class="text-muted color-bottom-txt">Veja abaixo as configurações pendentes:</span>
                                    </p>
                                    <br>
                                    <div class="row">
                                        
                                        <?php
                                            if(formApresentacao($objAnuncio)==100){
                                        ?>
                                        
                                        <div class="col-sm-12" id="etapa6">
                                            <div class="alert alert-success">
                                                <i class="fa fa-star"></i> <strong>Apresentação</strong> (completo)
                                                <a href="apresentacao.php<?php echo (isset($_GET["tutorial"])?"?tutorial=1":null); ?>" class="btn btn-sm btn-success" style="float:right; margin-top: -5px;">Editar <strong><i class="fa fa-angle-right"></i></strong> </a>
                                            </div>
                                        </div>
                                        
                                        <?php }else{ ?>
                                        
                                        <div class="col-sm-12" id="etapa6">
                                            <div class="panel  panel-danger">
                                                <div class="panel-heading">
                                                    <i class="fa fa-star"></i> <strong>Apresentação</strong>  <strong><span style="color:#C07473;">(incompleto e necessário)</span></strong>
                                                </div>
                                                <div class="panel-body">
                                                    <p>A apresentação da sua empresa é seu maior ponto de marketing para promover seu anúncio. É <strong>necessário</strong> o preenchimento das informações para a ativação do seu anúncio.</p>
                                                </div>
                                                <div class="panel-footer text-right">
                                                    <a href="apresentacao.php<?php echo (isset($_GET["tutorial"])?"?tutorial=1":null); ?>" class="btn btn-danger">Preencher agora <strong><i class="fa fa-angle-right"></i></strong> </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php } ?>
                                        
                                        <?php
                                            if(formEnderecos($objAnuncio)==100){
                                        ?>
                                        
                                        <div class="col-sm-12">
                                            <div class="alert alert-success">
                                                <i class="fa fa-map-marker"></i> <strong>Endereços e contatos</strong> (completo)
                                                <a href="enderecos_e_contatos.php" class="btn btn-sm btn-success" style="float:right; margin-top: -5px;">Editar <strong><i class="fa fa-angle-right"></i></strong> </a>
                                            </div>
                                        </div>
                                        
                                        <?php }else{ ?>
                                        
                                        <div class="col-sm-12">
                                            <div class="panel panel-danger">
                                                <div class="panel-heading">
                                                    <i class="fa fa-map-marker"></i> <strong>Endereços e contatos</strong> <strong><span style="color:#C07473;">(incompleto e necessário)</span></strong>
                                                </div>
                                                <div class="panel-body">
                                                    <p>É <strong>necessário</strong> preencher suas informações de contato e endereço. Você pode optar por deixá-los visíveis ou não aos visitantes.</p>
                                                </div>
                                                <div class="panel-footer text-right">
                                                    <a href="enderecos_e_contatos.php" class="btn btn-danger">Preencher agora <strong><i class="fa fa-angle-right"></i></strong> </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php } ?>
                                        
                                        <?php
                                            if(formImagem($objAnuncio)==100){
                                        ?>
                                        
                                        <div class="col-sm-12">
                                            <div class="alert alert-success">
                                                <i class="fa fa-picture-o"></i> <strong>Galeria de Fotos</strong> (completo)
                                                <a href="galeria_de_fotos.php" class="btn btn-sm btn-success" style="float:right; margin-top: -5px;">Editar <strong><i class="fa fa-angle-right"></i></strong> </a>
                                            </div>
                                        </div>
                                        
                                        <?php }else{ ?>
                                        
                                        <div class="col-sm-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-picture-o"></i> <strong>Galeria de fotos</strong> <strong><span style="color:#C07473;">(incompleto)</span></strong>
                                                </div>
                                                <div class="panel-body">
                                                    <p>Caso seu negócio atenda clientes diretamente, é <strong>recomendável</strong> fornecer aos visitantes imagens do seu estabelecimento, pois aumenta o grau de simpatia com seu negócio.</p>
                                                </div>
                                                <div class="panel-footer text-right">
                                                    <a href="galeria_de_fotos.php" class="btn btn-primary">Preencher agora <strong><i class="fa fa-angle-right"></i></strong> </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php } ?>
                                        
                                        <?php
                                            if(formHorarios($objAnuncio)==100){
                                        ?>
                                        
                                        <div class="col-sm-12">
                                            <div class="alert alert-success">
                                                <i class="fa fa-list"></i> <strong>Horários de Funcionamento</strong> (completo)
                                                <a href="horario_de_funcionamento.php" class="btn btn-sm btn-success" style="float:right; margin-top: -5px;">Editar <strong><i class="fa fa-angle-right"></i></strong> </a>
                                            </div>
                                        </div>
                                        
                                        <?php }else{ ?>
                                        
                                        <div class="col-sm-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-list"></i> <strong>Horários de funcionamento</strong> <strong><span style="color:#C07473;">(incompleto)</span></strong>
                                                </div>
                                                <div class="panel-body">
                                                    <p>É <strong>recomendável</strong> informar os horários e dias em que seu negócio funciona para que nossa plataforma possa recomendá-lo quando estiver em funcionamento.</p>
                                                </div>
                                                <div class="panel-footer text-right">
                                                    <a href="horario_de_funcionamento.php" class="btn btn-primary">Preencher agora <strong><i class="fa fa-angle-right"></i></strong> </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php } ?>
                                        
                                        <?php
                                            if(formInfo($objAnuncio)==100){
                                        ?>
                                        
                                        <div class="col-sm-12">
                                            <div class="alert alert-success">
                                                <i class="fa fa-info"></i> <strong>Informações do local</strong> (completo)
                                                <a href="informacoes_do_local.php" class="btn btn-sm btn-success" style="float:right; margin-top: -5px;">Editar <strong><i class="fa fa-angle-right"></i></strong> </a>
                                            </div>
                                        </div>
                                        
                                        <?php }else{ ?>
                                        
                                        <div class="col-sm-12">
                                            <div class="panel panel-warning">
                                                <div class="panel-heading">
                                                    <i class="fa fa-info"></i> <strong>Informações do local</strong> (reveja)
                                                </div>
                                                <div class="panel-body">
                                                    <p>Não é obrigatório o preenchimentos de informações sobre seu negócio, mas atualmente você não tem nenhuma opção marcada em suas informações. Lembre-se de manter seus visitantes orientados.</p>
                                                </div>
                                                <div class="panel-footer panel-warning text-right">
                                                    <a href="informacoes_do_local.php" class="btn btn-primary">Ver agora <strong><i class="fa fa-angle-right"></i></strong> </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php } ?>
                                        
                                        <div class="col-sm-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <i class="fa fa-facebook-square"></i> <strong>Facebook e integrações</strong> <strong><span style="color:#C07473;">(incompleto)</span></strong>
                                                </div>
                                                <div class="panel-body">
                                                    <p>É extremamente <strong>recomendável</strong> utilizar nossas ferramentas de integrações com o Facebook para um marketing mais efetivo do seu anúncio. <a href="#">Saiba mais</a>.</p>
                                                </div>
                                                <div class="panel-footer text-right">
                                                    <a href="#" class="btn btn-primary">Preencher agora <strong><i class="fa fa-angle-right"></i></strong> </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    
                            </div>
                        </div>
                    </div>
                           
                    <hr>
                    
                    <div class="row">
                        <p class="lead"></p>
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
            $("#a_visao_geral").addClass("active-menu");
            $(".nav-second-level").addClass("in");
        </script>
        
        <script src="../javascript/tutorial_painel.js"></script>
    </body>
</html>
