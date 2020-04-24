<html>
    <head>
        <?php
            include_once("../view/fixo/meta.php");
            include_once("../view/fixo/header.php");
        ?>
        
        <link href="login.css" rel="stylesheet"/>
        
    </head>
    <body id="viewLogin">

        <div class="container">
            <div class="row text-center">
                <div class="col-sm-12">
                    <h1 style="color: white; text-shadow:1px 1px 5px black;"><strong>Estalando</strong><small style="color: inherit; text-shadow: 1px 1px 3px black;">.com.br</small></h1>
                </div>
                <div class="col-sm-12" style="margin-top: -10px;">
                    <h2 style="color: white; text-shadow:1px 1px 5px black;">Mais que um site de anúncios, uma plataforma de <strong>marketing</strong>!</h2>
                </div>
            </div>
            <div class="row" style="margin-top: 50px;">
                
                <div class="col-md-5">
                    <div class="row">
                       <div class="col-md-12" style="padding: 0px 30px 30px 30px; margin-top: -20px;">
                            <span><a href="../../site/view/home.php"><i class="fa fa-arrow-left"></i> Voltar ao site</a></span>
                            <h3>Cadastre-se agora, é rapido!</h3>
                            <span>Já é cadastrado? <a href="painel_de_acesso.php">Clique aqui!</a></span>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -10px; margin-bottom: 10px; padding: 10px;">
                        <div class="col-md-12" id="alertCamposInvalidos" style="display: none;">
                            <div class="alert alert-danger">
                                <strong>Erro ao cadastrar-se: </strong> um ou mais campos estão invalidos:
                                <div id="errosCamposInvalidos"></div>
                            </div>
                        </div>
                        <form id="formCadastro" method="POST">
                            <div class="col-md-12">
                                <input id="txtNomeCad" name="txtNomeCad" type="text" class="form-control" placeholder="Nome completo" style="height: 40px; font-size: 17px;"/>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;">
                                <input id="txtTelefoneCad" maxlength="20" name="txtTelefoneCad" type="text" class="form-control" placeholder="Telefone ou celular" style="height: 40px; font-size: 17px;"/>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;">
                                <input id="txtEmailCad" name="txtEmailCad" type="text" class="form-control" placeholder="Email" style="height: 40px; font-size: 17px;"/>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;">
                                <input id="txtSenhaCad" name="txtSenhaCad" type="password" class="form-control" placeholder="Senha" style="height: 40px; font-size: 17px;"/>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;">
                                <input id="txtSenhaConfirmaCad" name="txtSenhaConfirma" type="password" class="form-control" placeholder="Confirme sua senha" style="height: 40px; font-size: 17px;"/>
                            </div>
                            <input name="hiddenCadastroCliente" type="hidden" />
                        </form>
                        <div class="col-md-12 text-center" style="margin-top: 20px;">
                        <button id="btnCadastrar" class="btn" style="background-color: #C90000; color: white; padding: 10px; font-size:15px;">Finalizar cadastro <i class="fa fa-check"></i></button>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-md-offset-1" style="margin-top: -20px;">
                    <div class="hidden-lg hidden-md hidden-xl" style="margin-top: 50px;"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><i class="fa fa-smile-o fa-2x"></i><span style="font-size: 25px; padding-left: 15px;"> Totalmente <strong>Gratuito!</strong></span></p>
                            <p style="margin-top: -20px;" class="text-justify">Anuncie gratuitamente, aumente sua visibilidade na internet e ganhe novos fregueses. Cadastre-se agora, é rapido!</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><i class="fa fa-facebook-square fa-2x"></i><span style="font-size: 25px; padding-left: 15px;"> Integre com o Facebook</span></p>
                            <p style="margin-top: -20px;" class="text-justify">Temos diversas formas de integração, inclusive com o Facebook. Aumente suas curtidas, receba comentários e seja recomendado por todos.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><i class="fa fa-eye fa-2x"></i><span style="font-size: 25px; padding-left: 15px;"> Veja seus resultados</span></p>
                            <p style="margin-top: -20px;" class="text-justify">Tenha acesso a relatórios com todas as pessoas que visualizaram, visitaram, curtiram, comentaram, compartilharam e muito mais!</p>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row" style="padding-top: 70px;">
                <footer class="text-center">
                    
                </footer>
            </div>
        </div>


        <?php
            include_once("../view/fixo/scripts.php");
        ?>
        <script src="login.js"></script>
        
    </body>
</html>