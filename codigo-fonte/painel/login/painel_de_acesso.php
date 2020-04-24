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
                        <div class="col-md-12" style="padding: 30px;">
                            <span><a href="../../site/view/home.php"><i class="fa fa-arrow-left"></i> Voltar ao site</a></span>
                            <h3>Painel de Acesso</h3>
                            <span>Ainda não é cadastrado? <a href="painel_de_cadastro.php">Clique aqui!</a></span>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -10px; margin-bottom: 10px; padding: 10px;">
                        <div class="col-md-12" style="display: none;" id="alertDadosIncorretos">
                            <div class="alert alert-danger">
                                <strong>Erro de acesso: </strong>email ou senha incorretos.
                            </div>
                        </div>
                        <form id="formLogin" method="POST">
                            <div class="col-md-12">
                                <input id="txtEmailLogin" name="txtEmailLogin" type="email" class="form-control" placeholder="Email" style="height: 40px; font-size: 17px;"/>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;">
                                <input id="txtSenhaLogin" name="txtSenhaLogin" type="password" class="form-control" placeholder="Senha" style="height: 40px; font-size: 17px;"/>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;">
                                <a href="#" id="btnEsqueciMinhaSenha">Esqueci minha senha</a>
                            </div>
                            <input name="hiddenAcessarPainel" type="hidden" />
                        </form>
                        <div class="col-md-12 text-right" style="margin-top: 10px;">
                        <button id="btnAcessarPainel" class="btn" style="background-color: #C90000; color: white; padding: 10px; font-size:15px;">Acessar <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-md-offset-1" style="margin-top: -20px;">
                    <div class="hidden-lg hidden-md hidden-xl" style="margin-top: 50px;"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><i class="fa fa-graduation-cap fa-2x"></i><span style="font-size: 25px; padding-left: 15px;"> Guia de marketing <strong>gratuito!</strong></span></p>
                            <p style="margin-top: -20px;" class="text-justify"><a href="#">Clique aqui</a> e acesse nosso guia de marketing digital gratuito preparado especialmente para nossos clientes. <a href="#">Saiba mais</a>.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><i class="fa fa-facebook-square fa-2x"></i><span style="font-size: 25px; padding-left: 15px;"> Integre com o Facebook</span></p>
                            <p style="margin-top: -20px;" class="text-justify">Integre sua página do Facebook conosco e permita aos visitantes curtirem, comentar, compartilhar e recomendar o seu anúncio!</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p><i class="fa fa-level-up fa-2x"></i><span style="font-size: 25px; padding-left: 15px;"> Receba mais visitas</span></p>
                            <p style="margin-top: -20px;" class="text-justify">Seu anúncio receberá mais visitas se o mesmo estiver com as informações completas. Não se esqueça de preencher todos os formulários.</p>
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