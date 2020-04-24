<!--
<div class="hidden-lg-up">
    <a href="#" class="btn-float">
        <i class="fa fa-search my-float"></i>
    </a>
    <ul id="ul-float" class="ul-float">
        <li>
            <input type="text" class="form-control" id="input-float" placeholder="Posso ajudar?">
        </li>
    </ul>
</div>
-->

<!-- botão flutuante -->
<div class="row hidden-lg-up btnFlutuante">
    <div class="col-9 txtBtnFlutuante">
        <input type="text" class="form-control" id="txtPesquisarFlutuante" maxlength="20" placeholder="Como posso ajudar?">
    </div>
    <div class="col-3">
        <button class="btn btn-danger btnPesquisar" id="btnPesquisarFlutuante"><i class="fa fa-search"></i></button>
    </div>
</div>

<nav class="container-fluid dark-primary-color hidden-xs-down">
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-2">
            <p class="logo">
                <img src="http://placehold.it/150x100" class="img-fluid hidden-sm-down">
                <img src="http://placehold.it/100x100" class="img-fluid hidden-md-up">
            </p>
        </div>
        <div class="col-lg-4 hidden-md-down">
            <div class="input-group">
                <input type="text" class="form-control" id="txtPesquisar" maxlength="20" placeholder="Como posso ajudar?">
                <span class="input-group-btn">
                    <button class="btn btn-secondary btnPesquisar" type="button" style="cursor:pointer;"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-2 hidden-xs-down text-center cl-effect-8" style="white-space: nowrap;  margin-top: -15px;">
            <a href="../../painel/login/painel_de_cadastro.php" class="light-primary-color">Anuncie grátis!</a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-8 hidden-xs-down text-right cl-effect-3">
            <a href="../../painel/login/painel_de_acesso.php" class="light-primary-color">Acessar painel</a>
            <a href="#" class="light-primary-color">Contato</a>
        </div>
    </div>
</nav>

<nav class="container-fluid dark-primary-color hidden-sm-up">
    <div class="row">
        <div>
            <p style="padding: 0px 0px 0px 20px; margin: 0px;">
                <img src="http://placehold.it/100x50" class="img-fluid">
            </p>
        </div>
        <div class="cl-effect-8 btn-toggle" style="position: absolute; right: 20px; top: 0;">
            <a href="#" class="light-primary-color"><i class="fa fa-list"></i></a>
        </div>
        <div class="navbar-toggle-block-edit" style="display: none;">
            <a href="#" class="light-primary-color"><strong>Anuncie grátis!</strong></a><br>
            <a href="#" class="light-primary-color">Acessar painel</a><br>
            <a href="#" class="light-primary-color">Contato</a><br>
        </div>
    </div>
</nav>