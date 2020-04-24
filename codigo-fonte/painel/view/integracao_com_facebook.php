<?php
    session_start();
    include_once("../php/funcoes_painel.php");
    include_once("../php/funcoes_integracao_com_facebook.php");
    $objFacebook = busca();
    //var_dump($objFacebook);
    $integracao = ($objFacebook->getIdFacebook());
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
    </head>
    <body id="viewIntegracaoComFacebook">
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>
            
            
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><i class="fa fa-facebook-square"></i> &nbsp; Integração com Facebook</h2>  
                            <h5 style="font-size: 16px;">Trabalhamos diretamente com a vinculação das empresas com o Facebook e outras integrações. Isso aumenta e potencializa o marketing de você cliente, além de facilitar o acesso do cliente em nosso site ao fazer avaliações, comentários, compartilhamentos, e outros. Além disso, todos esses dados são convertidos em registros que podem ser visualizados no relatório do seu anúncio. Tudo isso é feito de forma <strong>gratuita</strong>! <br><br>Você pode saber mais sobre nossos serviços de integração com o Facebook <a href="#">clicando aqui</a>.</h5>
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                    <hr />
                    
                    <?php
                        if($integracao){
                    ?>
                    
                    <div id="divIntegrado">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Form Elements -->
                                <div class="panel panel-default">
                                    <div class="panel-heading text-right">
                                        <button id="btnSalvar" class="btn btn-success"><i class="fa fa-save"></i> Salvar alterações</button>
                                    </div>
                                    <div class="panel-body">
                                        <div class="text-center">
                                            <p>Integrado com <strong><?php echo $objFacebook->getNomePagina(); ?></strong></p>
                                        </div>

                                        <span>Selecione abaixo as opções de integração que os usuários poderão interir com sua página através do nosso site</span>
                                        <div class="table-responsive" style="margin-top: 15px;">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr id="trCurtidas">
                                                        <td><label><input id="cboxCurtidas" type="checkbox" <?php echo ($objFacebook->getBoolCurtidas()?"checked":null); ?> /> Botão curtir</label></td>
                                                        <td>Os visitantes podem curtir seu anúncio. As curtidas realizadas no seu anúncio também são contabilizadas na sua página do Facebook. </td>
                                                    </tr>
                                                    <tr id="trComentarios">
                                                        <td><label><input id="cboxComentarios" type="checkbox" <?php echo ($objFacebook->getBoolComentarios()?"checked":null); ?> /> Habilitar comentários</label></td>
                                                        <td>Os visitantes podem utilizar a caixa de comentários do Facebook para comentar a respeito do seu anúncio.</td>
                                                    </tr>
                                                    <tr id="trCompartilhar">
                                                        <td><label><input id="cboxCompartilhar" type="checkbox" <?php echo ($objFacebook->getBoolCompartilhar()?"checked":null); ?> /> Permitir compartilhar</label></td>
                                                        <td>Os visitantes podem compartilhar seu anúncio e sua página em suas linhas do tempo, na linha do tempo de amigos e em grupos do Facebook.</td>
                                                    </tr>
                                                    <tr id="trEnviar">
                                                        <td><label><input id="cboxEnviar" type="checkbox" <?php echo ($objFacebook->getBoolEnviar()?"checked":null); ?> /> Autorizar recomendações</label></td>
                                                        <td>Os visitantes podem recomendar seu anúncio para amigos pelo Messenger.</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <span>Recomendamos que habilite todas as opções de integração, pois uma vez que uma das ações acima é realizada pelo visitante, o mesmo também é implicado diretamente em sua página, aumentando ainda mais o marketing do seu negócio. <a href="#">Clique aqui</a> para saber mais sobre a integração com o Facebook.</span>


                                    </div>
                                    <div class="panel-footer text-left">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-xs-12">
                                                <a type="button" id="btnRemoverIntegracao" href="#" class="btn btn-danger"><i class="fa fa-chain-broken"></i> Remover integração</a>
                                            </div>
                                            <div class="col-sm-6 col-md-6 hidden-xs text-right">
                                                <button type="button" id="btnSalvarProsseguir" href="#" class="btn btn-primary">Salvar e prosseguir <i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Form Elements -->
                            </div>
                        </div>

                    </div>
                    
                    <?php
                        }else{
                    ?>
                    
                    <div id="divIntegrar">
                    
                        <div class="row" style="margin-bottom: 15px; display:block;">
                            <div class="col-md-12 text-center">
                                <p>Você ainda não integrou nenhuma página ao nosso site.</p>
                                <span>Siga o passo a passo abaixo para realizar a integração. É simples e muito rápido!</span>
                            </div>
                        </div>

                        <div class="row" style="display:block;" id="preVinculacao">
                            <div class="col-md-12">
                                <!-- Form Elements -->
                                <div class="panel panel-default">
                                    <div class="panel-heading text-left">
                                        <span class="lead"><strong>Passo 1:</strong> Conecte-se com o Facebook</span>
                                    </div>
                                    <div class="panel-body text-center">
                                        
                                        <div class="alert alert-danger lista-comum text-left" id="divErrosIntegracao" style="display: none;">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <p class="text-center"><strong>Erro ao vincular sua página do Facebook</strong></p>
                                            <p>
                                            Ocorreu um erro ao solicitar sua lista de páginas do Facebook. Este erro pode ter acontecido
                                            por algum dos motivos abaixo:
                                            </p>
                                            <ul>
                                                <li>
                                                    <strong>Você pode não ter nenhuma página no Facebook.</strong>
                                                    <br>Se você ainda não tem nenhuma página no Facebook, <strong><a href="#" style="color:#BC5542">clique aqui</a></strong> para saber mais.
                                                </li>
                                                <li>
                                                    <strong>Talvez você não seja o administrador da página.</strong>
                                                    <br>Você precisa ter as permissões de adminsitrador para que possamos vincular sua página. <strong><a href="#" style="color:#BC5542">Clique aqui</a></strong> para saber mais.
                                                </li>
                                                <li>
                                                    <strong>A permissão de acesso a lista de páginas foi negada.</strong>
                                                    <br>Tenha certeza de que você autorizou nosso acesso a sua lista de páginas do Facebook. <strong><a href="#" style="color:#BC5542">Clique aqui</a></strong> para saber mais.
                                                </li>
                                            </ul>
                                            <p>
                                                Caso seu problema não esteja relacionado aos itens acima, tente novamente mais tarde. Se o erro persistir, entre em contato com o nosso suporte.
                                            </p>
                                        </div>
                                        
                                        <p>Clique no botão abaixo e conecte-se com o Facebook.</p>
                                        
                                        <a id="fbPermissao" href="#" class="btn btn-lg btn-primary">Conectar agora</a>
                                        <br>
                                        <br>
                                        <span>Lembre-se de autorizar a permissão de acessarmos suas páginas. Não se preocupe, não temos permissão para publicar nelas.</span>
                                    </div>
                                    <div class="panel-footer text-right">
                                        
                                    </div>
                                </div>
                                <!-- End Form Elements -->
                            </div>
                        </div>

                        <div class="row" style="display:none;" id="posVinculacao">
                            <div class="col-md-12">
                                <!-- Form Elements -->
                                <div class="panel panel-default">
                                    <div class="panel-heading text-left">
                                        <span class="lead"><strong>Passo 2:</strong> Escolha uma página</span>
                                    </div>
                                    <div class="panel-body text-center">
                                        <p>Escolha abaixo a página que deseja integrar</p>
                                        <div id="listaPaginas"></div>
                                        <br>
                                    </div>
                                    <div class="panel-footer text-right">
                                       
                                    </div>
                                </div>
                                <!-- End Form Elements -->
                            </div>
                        </div>

                        <div class="row" style="display:none;" id="divIntegracaoAguarde">
                            <div class="col-md-12 text-center">
                                <!-- Form Elements -->
                                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                                <br><span class="text-muted">Aguarde...</span>
                                <!-- End Form Elements -->
                            </div>
                        </div>

                        <div class="row" style="display:none;" id="divIntegracaoErro">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading text-left">
                                        <span class="lead">Integração não realizada</span>
                                    </div>
                                    <div class="panel-body text-center">
                                        <!-- Form Elements -->
                                        <div class="alert alert-danger text-left">
                                            <strong>Erro ao integrar página:</strong> ocorreu um erro no processo de integração.
                                            <br>
                                            <strong><a href="#" onclick="location.reload();">Atualize esta página</a></strong> e tente realizar a integração novamente.
                                            Se o problema persistir, entre em contato com nossa equipe de suporte.
                                        </div>
                                        <!-- End Form Elements -->
                                    </div>
                                    <div class="panel-footer text-center">
                                        <input type="button" onclick="location.reload();" class="btn btn-primary" value="Tentar novamente">
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    
                    <?php
                        }
                    ?>
                    
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        
        
        <!-- modal de exclusão -->
        <div id="modalRemoverIntegracao" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Deseja excluir remover sua integração?</h4>
                    </div>
                    <div class="modal-body">
                        <p><strong>Atenção:</strong> você está prestes a remover os registros de integração com a página:</p>
                        <div class="text-center" style="font-size: 18px;">
                            <strong><?php echo $objFacebook->getNomePagina(); ?></strong>
                            </div>
                            
                        <p> Ao remover sua integração, todas as curtidas e comentários que foram realizados nesta página
                        serão perdidos.</p>

                    </div>
                    <div class="modal-footer">
                        <div class="col-xs-6 text-left">
                            <a type="button" class="btn btn-branco" data-dismiss="modal"><i class="fa fa-reply"></i> Voltar</a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a type="button" class="btn btn-branco" data-dismiss="modal" id="btnRemoverIntegracaoConfirma">Remover <i class="fa fa-chain-broken"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        
        
        <?php
            include_once("./fixo/scripts.php");
        ?>


        <script>
            $("#a_editar_meu_anuncio").addClass("active-menu");
            $("#a_integracao_com_facebook").addClass("active-menu");
            $(".nav-second-level").addClass("in");
        </script>
        
        <script src="../javascript/integracao_com_facebook.js"></script>
        <script src="../javascript/facebook.js"></script>
    </body>
</html>
