<?php
    session_start();
    include_once("../php/funcoes_painel.php");
    include_once("../php/funcoes_informacoes_empresa.php");
    $objEmpresa = busca();
    var_dump($objEmpresa);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
    </head>
    <body id="viewInformacoesEmpresa">
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>
            
            
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><i class="fa fa-bookmark-o"></i> &nbsp; Editar Informações da Empresa</h2>  
                            <h5 style="font-size: 16px;">Você pode alterar as informações primárias da sua empresa aqui.</h5>
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                    <hr />

                    <div class="row" style="display:none;">
                        <div class="col-md-12">
                            <div class="alert alert-warning mensagem-painel">
                                <h3><i class="fa fa-rocket fa-2x"></i><strong> &nbsp; Nenhum anúncio impulsionado</strong></h3>
                                Percebemos que você ainda não possui nenhum dos nossos planos de impulsionamento de anúncios no momento.<br>
                                Conheça nossos planos, <a href="#">clique aqui</a> e aumente as visitas em seu anúncio, ganhe novos fregueses, fortifique sua campanha de marketing agora e muito mais!
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Form Elements -->
                            <div class="panel panel-default">
                                <div class="panel-heading text-right">
                                    <button id="btnSalvar" class="btn btn-success"><i class="fa fa-save"></i> Salvar alterações</button>
                                </div>
                                <div class="panel-body">
                                    <form role="form" id="formEmpresa" method="POST">
                                        <div id="errosForm"></div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Razão social ou nome fantasia</label>
                                                    <input id="txtNomeEmpresa" name="txtNomeEmpresa" maxlength="50" type="text" class="char-count form-control" placeholder="Est informação não aparecerá para os visitantes" value="<?php echo $objEmpresa->getNomeEmpresa(); ?>" />
                                                </div>
                                                <div class="text-right hidden-xs" style="margin-top: -10px;">
                                                    <span class="text-muted"><span name="txtNomeEmpresa">50</span> caracteres restantes</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-6" id="selectSeguimentoAltera" style="display:none; margin-top: 10px;">
                                                <label>Seguimento</label>
                                                <select id="selectSeguimento" name="selectSeguimento" class="form-control">
                                                    <option>Selecione</option>
                                                    <option>Pizzaria</option>
                                                    <option>Lanchonete</option>
                                                    <option>Salgadaria/Pastelaria</option>
                                                    <option>Restaurante</option>
                                                    <option>Bar/Pub</option>
                                                    <option>Sorveteria/Açaizeiro</option>
                                                    <option>Doces/Bolos em geral</option>
                                                    <option>Loja de conveniência</option>
                                                    <option>Comida Japonesa</option>
                                                    <option>Padaria</option>
                                                    <option>Cafeteria</option>
                                                    <option>Supermercado/Mercearia</option>
                                                    <option>Outro...</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-xs-12 col-md-6" id="selectSeguimentoPadrao" style="margin-top: 10px;">
                                                <label>Seguimento</label><a href="#" id="mudaSeguimento" style="float:right;">mudar</a>
                                                <select disabled="true" id="seguimentoPadrao" class="form-control">
                                                    <option><?php echo $objEmpresa->getTipoNegocio(); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input id="txtEmailEmpresa" name="txtEmailEmpresa" type="text" class="form-control" placeholder="Clientes lhe enviarão mensagens neste endereço" value="<?php echo $objEmpresa->getEmail(); ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Site</label>
                                                    <input id="txtSiteEmpresa" name="txtSiteEmpresa" type="text" class="form-control" placeholder="Se possuir um..." value="<?php echo $objEmpresa->getSite(); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Cidade e estado</label><a href="#" style="float:right;">mudar</a>
                                                    <input id="txtCidade" name="txtCidade" disabled="true" type="text" class="form-control required" value="<?php echo $objEmpresa->getCidade(); ?> - <?php echo $objEmpresa->getEstado(); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="hiddenEmpresa" name="hiddenEmpresa" />
                                    </form>
                                </div>
                                <div class="panel-footer text-right">
                                </div>
                            </div>
                            <!-- End Form Elements -->
                        </div>
                    </div>
                    
                    
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        
        <!-- modal de fechar tutorial -->
        <div id="modalMudarSeguimento" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Deseja mudar o seguimento da sua empresa?</h4>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja alterar o seguimento da sua empresa? Ao alterá-lo, nossos motores
                        de busca começará a apresentar sua empresa apenas no novo seguimento que escolher.
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-xs-6 text-left">
                                <button type="button" class="btn btn-branco" data-dismiss="modal"><i class="fa fa-reply"></i> Voltar</button>
                            </div>
                            <div class="col-xs-6 text-right">
                                <button type="button" class="btn btn-branco" id="btnMudarSeguimentoConfirma" data-dismiss="modal">Continuar <i class="fa fa-arrow-right"></i></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <?php
            include_once("./fixo/scripts.php");
        ?>
        
        <script src="../javascript/informacoes_empresa.js"></script>
        <script src="../../assets/geral/js/contadorCaractere.js"></script>
    </body>
</html>
