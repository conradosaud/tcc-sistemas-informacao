<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
        
        <link href="../css/relatorios_e_informacoes.css" rel="stylesheet"/>
        <link href="../../assets/charts/morris-chart/morris-0.4.3.min.css" rel="stylesheet"/>
        
    </head>
    <body>
        
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>

            </nav>  
            <!-- /. NAV SIDE  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><i class="fa fa-bar-chart"></i> Relatórios e informações</h2>   
                            <h5 class="subtitulo">Apresentamos abaixo seu relatório de visualizações, visitas, interação com Facebook e muitos outros. Os dados dos relatórios são atualizados a cada 24hs.</h5>
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                    <hr />
                    
                    
                    
                    <div class="row" style="display:none;">
                        <div class="col-sm-12">
                            <div class="panel panel-back noti-box">
                                <div class="text-right" style="float:right; opacity: 0.5;">
                                    <a href="#" class="btnFecharMsgPainel"><i class="fa fa-close fa-2x"></i></a>
                                </div>
                                <span class="icon-box bg-color-red">
                                    <i class="fa fa-warning"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text">Você ainda não terminou de montar seu anúncio! </p>
                                    <p class="text-muted">Ainda restam algumas informações a serem preenchidas para que seu anúncio esteja completo. Lembre-se que quanto mais completo estiver seu anúncios, mais pessoas o irão visitá-lo.</p>
                                    <br>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-danger">Editar agora &nbsp;<i class="fa fa-external-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="display:none;">
                        <div class="col-sm-12">
                            <div class="panel panel-back noti-box">
                                <div class="text-right" style="float:right; opacity: 0.5;">
                                    <a href="#" class="btnFecharMsgPainel"><i class="fa fa-close fa-2x"></i></a>
                                </div>
                                <span class="icon-box bg-color-green">
                                    <i class="fa fa-info"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text">Aumente as visualizações no seu anúncio! </p>
                                    <p class="text-muted">Você pode aumentar em, pelo menos, <strong>duas vezes mais</strong> as visitas no seu anúncio e ganhar novos freguêses para seu negócio, saiba mais sobre nossos planos de <strong>anúncio impulsionado</strong>.</p>
                                    <br>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-success">Ver planos &nbsp;<i class="fa fa-external-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="display:none;">
                        <div class="col-sm-12">
                            <div class="panel panel-back noti-box">
                                <div class="text-right" style="float:right; opacity: 0.5;">
                                    <a href="#" class="btnFecharMsgPainel"><i class="fa fa-close fa-2x"></i></a>
                                </div>
                                <span class="icon-box bg-color-red">
                                    <i class="fa fa-eye-slash"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text">Seu anúncio está desativado! </p>
                                    <p class="text-muted">Neste momento seu anúncio está <strong> desativado</strong> e nenhum visitante pode visualizá-lo. Acesse painel <strong>Editar Meu Anúncio</strong> para alterar as configurações.</p>
                                    <br>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-danger">Acessar painel &nbsp;<i class="fa fa-external-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="display:none;">
                        <div class="col-sm-12">
                            <div class="panel panel-back noti-box">
                                <div class="text-right" style="float:right; opacity: 0.5;">
                                    <a href="#" class="btnFecharMsgPainel"><i class="fa fa-close fa-2x"></i></a>
                                </div>
                                <span class="icon-box bg-color-green">
                                    <i class="fa fa-info"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text">Promova um produto e aumente suas vendas! </p>
                                    <p class="text-muted">Tem algum produto com promoção imperdível e gostaria que os visitantes soubessem? Saiba mais sobre nossos planos de <strong>promover produtos</strong> e faça mais vendas!</p>
                                    <br>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-success">Saber mais &nbsp;<i class="fa fa-external-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="row carregando1">
                        <div class="col-sm-12 painel-data">
                            <p>Filtrar data de busca:</p>
                            <!--<span class="label label-default">Teste</span>-->
                        </div>
                        <div class="col-xs-12" style="padding-top: 10px;padding-bottom: 10px;">
                            <span class="btnData label label-info" name="ontem">Ontem</span>
                            <span class="btnData label label-info" name="semana">Semana</span>
                            <span class="btnData label label-info" name="mes">Mês</span>
                            <span> ou</span>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                De: <input id="dateInicio" class="form-control" type="date" value="2011-08-19">
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                À: <input id="dateFim" class="form-control" type="date" value="2011-08-19">
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-12 col-xs-12" style="margin-top: 20px;">
                                <a id="btnAtualizar" class="btn btn-warning"><i class="fa fa-repeat"></i> Atualizar</a>
                            </div>
                        </div>
                    </div>                
                    
                    <!-- /. ROW  -->
                    <div class="row" style="margin-top: 10px;"> 
                        <div class="col-md-12 col-sm-12 col-xs-12">                     
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Relatório de <strong>visualizações</strong> em seu anúncio &nbsp; <i class="fa fa-question-circle" title="teste??"> </i>
                                </div>
                                <div class="panel-body">
                                    <div class="carregando2 carregando text-center">
                                        <span><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span>
                                        <br><br>
                                        <span>Aguarde...</span>
                                    </div>
                                    <div id="semRegistros1" class="text-center" style="color: #D9534F; display: none;">
                                        <span class="lead"><i class="fa fa-3x fa-calendar-times-o"></i></span><br><br>
                                        <span>
                                            <strong class="lead">Sem registros</strong><br>
                                            Não foi encontrado nenhum registro referente a data pesquisada.
                                        </span>
                                    </div>
                                    
                                    <div id="chart1" style="width: 100%; padding: 0; margin: 0;"></div>
                                    
                                </div>
                            </div>            
                        </div>

                    </div>
                    <!-- /. ROW  -->
                    
                    <!-- /. ROW  -->
                    <div class="row"> 
                        
                        <div class="col-md-6 col-sm-12 col-xs-12">                     
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Novos visitantes x visitantes recorrentes
                                </div>
                                <div class="panel-body">
                                    <div class="carregando3 carregando text-center">
                                        <span><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span>
                                        <br><br>
                                        <span>Aguarde...</span>
                                    </div>
                                    <div id="semRegistros2" class="text-center" style="color: #D9534F; display: none;">
                                        <span class="lead"><i class="fa fa-3x fa-calendar-times-o"></i></span><br><br>
                                        <span>
                                            <strong class="lead">Sem registros</strong><br>
                                            Não foi encontrado nenhum registro referente a data pesquisada.
                                        </span>
                                    </div>
                                    
                                    <div id="chart2" style="margin: 0; padding: 0;"></div>
                                </div>
                            </div>            
                        </div>
                        
                        <div class="col-md-6 col-sm-12 col-xs-12">                     
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Outros dados
                                </div>
                                <div class="panel-body">
                                    <div class="carregado4">
                                        
                                        <span><i class="carregando5 fa fa-spinner fa-spin fa-fw"></i></span>
                                        <span class="carregado5" style="display:none;">O tempo de permanencia média dos visitantes em seu anúncio são de <strong><span id="spanTempoMedio">?</span></strong> minutos/segundos.</span>  
                                        <span id="semRegistros5" style="display:none;">O tempo de permanencia neste período foi igual ou inferior a 1 segundo.</span>
                                        
                                        <br><hr>
                                        
                                        <span><i class="carregando6 fa fa-spinner fa-spin fa-fw"></i></span>
                                        <span class="carregado6" style="display:none;">Cerca de <strong><span id="spanSexoM">?</span></strong> dos visitantes são homens, e <strong><span id="spanSexoF">?</span></strong> são mulheres.</span>
                                        <span id="semRegistros6" style="display: none;">Não foram encontrados registros relevantes sobre o sexo dos usuários neste período.</span>
                                        
                                        <br><hr>
                                        
                                        <span><i class="carregando7 fa fa-spinner fa-spin fa-fw"></i></span>
                                        <span class="carregado7" style="display:none;"><strong><span id="spanDispositivoMobile">?</span></strong> dos acessos foram feitos através de celulares/tablets, e <strong><span id="spanDispositivoDesktop">?</span></strong> de computadores/notebooks.</span>
                                        <span id="semRegistros7" style="display: none;">Não foram encontrados registros relevantes sobre os dispositivos dos usuários neste período.</span>
                                    </div>
                                </div>
                            </div>            
                        </div>

                    </div>
                    <!-- /. ROW  -->
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="lead"><i href="#" class="fa fa-facebook-square"></i> Relatório do Facebook</p>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-red set-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text">3 Comentários</p>
                                    <p class="text-muted">Novos comentários realizados pelos usuários</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-green set-icon">
                                    <i class="fa fa-bars"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text text-center">5 Curtidas</p>
                                    <p class="text-muted">Novas curtidas que sua página recebeu</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-blue set-icon">
                                    <i class="fa fa-bell-o"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text">3 Compartilhamento</p>
                                    <p class="text-muted">As pessoas compartilharam seu anúncio</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">           
                            <div class="panel panel-back noti-box">
                                <span class="icon-box bg-color-brown set-icon">
                                    <i class="fa fa-rocket"></i>
                                </span>
                                <div class="text-box" >
                                    <p class="main-text">1 Envio</p>
                                    <p class="text-muted">As pessoas recomendaram seu anúncio</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="row" >
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="panel panel-primary text-center no-boder bg-color-green">
                                <div class="panel-body">
                                    <i class="fa fa-thumbs-up fa-5x"></i>
                                    <h4>Saiba como ganhar mais curtidas e comentários em sua página do Facebook! </h4>
                                    <a href="#" class="btn btn-default">Saber mais</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12 col-xs-12">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Veja as pessoas que interagiram com seu anúncio
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nome</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Larry</td>
                                                    <td>the Bird</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Larry</td>
                                                    <td>the Bird</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                           
                    
                    
                    
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        
        <?php
            include_once("./fixo/scripts.php");
        ?>

        <script type="text/javascript" src="../../assets/charts/morris-chart/morris.js"></script>
        <script type="text/javascript" src="../../assets/charts/morris-chart/raphael-2.1.0.min.js"></script>
        <script type="text/javascript" src="../../assets/charts/google-chart/loader.js"></script>
        
        <script type="text/javascript" src="../javascript/relatorios_e_informacoes.js"></script>
        
        <script>
            $("#a_relatorios_e_informacoes").addClass("active-menu");
        </script>
        
    </body>
</html>
