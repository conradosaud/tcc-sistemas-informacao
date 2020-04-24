

<!-- botão flutuante -->
<div class="btnFlutuante visible-xs">
    <buttton class="btn btn-danger" id="btnTopo"><i class="fa fa-angle-up"></i></buttton>
</div>

<!-- navbar -->
<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Navegador Mobile</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="inicio.php">Estalando <small><small>Painel</small></small></a> 
    </div>
    <div style="color: white;
         padding: 15px 50px 5px 10px;
         float: left;
         font-size: 16px;"> 
        <strong><?php echo $_SESSION["NomeEmpresa"]; ?></strong>
        <span class="dropdown">
            <a style="color:white;" class="btn" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
            <ul class="dropdown-menu">
                <li><a href="./informacoes_empresa.php"><i class="fa fa-pencil"></i> Editar informações da empresa</a></li>
                <li><a href="./painel_de_empresas.php"><i class="fa fa-reply"></i> Voltar para o painel de empresas</a></li>
                <li><a href="inicio.php?tutorial=1"><i class="fa fa-magic"></i> Refazer tutorial de apresentação</a></li>
            </ul>
        </span>
    </div>
    <div class="btnSair">  <a href="../php/funcoes_login.php?Logout=true" class="btn btn-danger square-btn-adjust"> <i class="fa fa-power-off"></i> Sair</a> </div>
</nav>   

