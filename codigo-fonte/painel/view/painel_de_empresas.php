<?php 
    session_start();
    
    if(!isset($_SESSION["IdCliente"])){
        echo "<script>window.location.href='../login/painel_de_acesso.php';</script>";
        exit();
    }
    
    include_once("../php/funcoes_painel_de_empresas.php");
    $objEmpresas = getEmpresasAnuncios();
    $objCliente = getCliente();

?>
<!DOCTYPE html>
<html>  
    <head>
        <?php
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
        <!-- <link href="../login/css/painel_de_acesso.css" rel="stylesheet" /> -->
        <link href="../css/painel_de_empresas.css" rel="stylesheet" />
    </head>
    
    <body id="viewPainelDeEmpresas">

        <div id="tutorial" style="display:none;"></div>
        <input type="hidden" id="hiddenEmpresasJaCadastradas" value="<?php echo (count($objEmpresas) == 0?"":"true"); ?>" />
        
        <div class="container">
            
            <div class="row" style="margin-bottom: 15px;" id="textoLogo">
                <div class="col-sm-12 text-center">
                    <h1 style="color: white; text-shadow:1px 1px 5px black;"><strong>Estalando</strong><small style="color: inherit; text-shadow: 1px 1px 3px black;">.com.br</small></h1>
                    <h2 style="color: white; text-shadow:1px 1px 5px black;">Mais do que um site de anúncios, uma plataforma de marketing!</h2>
                </div>
            </div>  
            
            <div class="row" style="display:block;" id="divPainel">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default" style="border-color:#202020; box-shadow: 1px 3px 5px black;">
                        <div class="panel-heading" style="background-color: #202020; color: white;">
                            <div class="row">
                                <div class="col-sm-6" style="display:inline;">
                                    <p class="lead" style="margin-bottom: 0px; display:inline-block;">
                                        Olá, <?php echo $_SESSION["NomeCliente"]; ?> 
                                    </p>
                                    <span class="dropdown">
                                        <a style="color:white;" class="btn" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" id="btnEditarInformacoes"><i class="fa fa-user"></i> Editar suas informações</a></li>
                                            <li><a href="#" id="btnAlterarSenha"><i class="fa fa-asterisk"></i> Alterar senha</a></li>
                                        </ul>
                                    </span>
                                </div>
                                <div class="col-sm-6 text-right" style="display:inline-block;">
                                    <a href="#" class="btn btnSair" style="color: white; background-color: #C90000; margin-top:15px; padding: 5px 10px;"><i class="fa fa-power-off"></i> Sair</a>
                                </div>
                            </div>
                            
                        </div>
                        <div class="panel-body">
                            
                            <?php
                                if(count($objEmpresas) == 0){
                            ?>
                            
                                <div id="divEmpresasNaoCadastradas">
                                    <p class="lead">Você ainda não tem nenhuma empresa cadastrada.</p>
                                    <p>Cadastre sua primeira empresa clicando no botão abaixo.</p>
                                </div>
                            
                            <?php
                                }else{
                            ?>
                            
                            <div id="divEmpresasJaCadastradas">
                            
                                <p class="lead">Selecione uma empresa para acessar o painel:</p>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Painel</th>
                                                <th>Razão Social / Nome Fantasia</th>
                                                <th>Cidade</th>
                                                <th>Status</th>
                                                <th>Operações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                for($i = 0; $i < count($objEmpresas); $i++){
                                                    // verifica se objEmpresas é um objecto unico para não dar erro essa bosta
                                                    $obj = (count($objEmpresas)==1?$objEmpresas:$objEmpresas[$i]);
                                            ?>

                                            <tr>
                                                <td><a href="../php/funcoes_painel.php?IdEmpresa=<?php echo $obj->getIdEmpresa(); ?>" class="btn btn-block" style="color: white; background-color: #C90000;">Acessar painel <i class="fa fa-external-link-square"></i></a></td>
                                                <td><?php echo $obj->getNomeEmpresa(); ?></td>
                                                <td><?php echo $obj->getCidade().($obj->getEstado()=="Outro..."?"":" - ".$obj->getEstado()); ?></td>
                                                <td><strong><?php echo ($obj->getAnunciando()?'<span style="color:#3C763D;">Ativo</span>':'<span style="color:#C07473;">Desativado</span>'); ?></strong></td>
                                                <td class="text-center"><button name="<?php echo $obj->getIdEmpresa(); ?>" type="button" rel-nome="<?php echo $obj->getNomeEmpresa(); ?>" class="btn btn-default btnExcluir">Excluir <i class="fa fa-trash"></i></button></td>
                                            </tr>

                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            
                            </div>
                            
                            <?php
                                }
                            ?>

                            <hr>

                            <a id="btnCadastrarNovo" href="#" class="btn btn-default" style="box-shadow: 1px 1px 5px black;"><i class="fa fa-plus" style="color: #C90000;"></i> Cadastrar novo</a>

                            <div class="row" id="divCadastrarNovo" style="margin-top: 15px; display: none;">
                                <div class="col-md-12">
                                    <!-- Form Elements -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading text-left">
                                            <a id="btnCancelarVoltar" href="#" class="btn btn-danger"><i class="fa fa-reply"></i> Cancelar e voltar</a>
                                        </div>
                                        <div class="panel-body">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h2><i class="fa fa-bookmark-o"></i> &nbsp; Cadastrar nova empresa</h2>  
                                                    <h5 style="font-size: 16px;">Insira abaixo os dados correspondentes a sua empresa ou o seu negócio. Você não precisa ser uma pessoa jurídica para cadastrá-la.</h5>
                                                </div>
                                            </div> 

                                            <hr>

                                            <div id="alertAvisoCadastro" class="alert alert-warning" style="display: none;">
                                                <strong>Atenção:</strong> cadastre uma nova empresa somente se suas outras empresas forem de seguimentos e/ou cidades diferentes. Anúncios duplicados podem ser excluídos sem aviso prévio.
                                            </div>
                                            
                                            <form role="form">
                                                <div class="row" style="display: none;" id="alertCadastroEmpresa">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-danger">
                                                            <strong>Erro ao cadastrar: </strong>uma ou mais informações estão inválidas:
                                                            <div id="alertaCadastoEmpresa-erros"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Razão social ou nome fantasia</label>
                                                            <input id="txtNomeEmpresa" name="txtNomeEmpresa" type="text" class="char-count form-control" placeholder="Ex: Salgadaria Rei Coxinha LTDA" />
                                                        </div>
                                                        <div class="text-right hidden-xs hidden-sm" style="margin-top: -10px;">
                                                            <span class="text-muted"><span name="txtNomeEmpresa">50</span> caracteres restantes</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
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
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Email <small class="text-muted">(opcional)</small></label>
                                                            <input id="txtEmailEmpresa" name="txtEmailEmpresa" type="text" class="form-control" placeholder="Clientes lhe enviarão mensagens neste endereço" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Site <small class="text-muted">(opcional)</small></label>
                                                            <input id="txtSiteEmpresa" name="txtSiteEmpresa" type="text" class="form-control" placeholder="Se possuir um..." />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Cidade</label>
                                                            <select id="selectCidade" name="selectCidade" class="form-control">
                                                                <option>Selecione</option>
                                                                <option>Franca - SP</option>
                                                                <option>Outro...</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="panel-footer text-left">
                                            <div class="row">
                                                <div class="col-sm-12 text-right">
                                                    <button id="btnSalvarCadastrar" class="btn btn-success"><i class="fa fa-save"></i> Salvar e cadastrar</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Form Elements -->
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer" style="background-color: #202020; color: white;">
                        </div>
                    </div>
                    <!-- End Form Elements -->
                </div>

            </div>
            
        </div>
        
        
        <!-- modal de exclusão -->
        <div id="modalExcluir" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Deseja excluir esta empresa?</h4>
                    </div>
                    <div class="modal-body">
                        <p><strong>Atenção:</strong> você está prestes a excluir os registros da empresa:</p>
                        <div class="text-center" style="font-size: 18px;">
                            <strong id="pNomeEmpresaExcluir"></strong>
                            </div>
                            
                        <p> Uma vez excluido, todos os registros e informações não poderão ser recuperados novamente.</p>
                        
                        <p>Para excluir digite abaixo sua senha de acesso ao painel e confirme abaixo.</p>
                        <div class="row" id="alertSenhaExcluir" style="display:none;">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <strong>Senha incorreta:</strong> verifique e tente novamente.
                                </div>
                            </div>
                        </div>
                        <input class="form-control" id="txtSenhaExcluir" name="txtSenhaExcluir" type="password" placeholder="Digite sua senha"/>
                        <input type="hidden" name="hiddenEmpresaExcluir" id="hiddenEmpresaExcluir" />
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-6 col-xs-6 text-left">
                                <button type="button" class="btn btn-branco" data-dismiss="modal"><i class="fa fa-reply"></i> Voltar</button>
                            </div>
                            <div class="col-md-6 col-xs-6 text-right">
                                <button type="button" class="btn btn-branco" data-dismiss="modal" name="btnExcluirConfirma">Excluir <i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- modal de editar informações do perfil -->
        <div id="modalEditarInfo" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Editar informações de perfil</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="formCliente" method="POST">
                            <div id="errosFormEditarInfo"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        As informações editadas neste painel poderão ser vistas apenas na próxima
                                        vez que você acessar o painel do usuário. Caso prefira, <a href="#" class="btnSair">reconecte-se</a>
                                        para ver agora!
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Nome completo</label>
                                        <input id="txtNomeCompleto" name="txtNomeCompleto" type="text" class="form-control" placeholder="Seu nome completo" value="<?php echo $objCliente->getNome(); ?>" />
                                    </div>
                                    <div class="text-right hidden-xs hidden-sm" style="margin-top: -10px;">
                                        <span class="text-muted">30 caracteres restantes</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Email de acesso</label>
                                        <input id="txtEmailAcesso" name="txtEmailAcesso" type="text" class="form-control required" placeholder="Utilizado para acessar o painel" value="<?php echo $objCliente->getEmail(); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Telefone ou celular</label>
                                        <input id="txtTelefoneContato" name="txtTelefoneContato" type="text" class="form-control required" placeholder="Utilizado para acessar o painel" value="<?php echo $objCliente->getTelefone1(); ?>" />
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="hiddenCliente" name="hiddenCliente" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                <button type="button" class="btn btn-branco" data-dismiss="modal"><i class="fa fa-reply"></i> Voltar</button>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <button type="button" class="btn btn-branco" id="btnSalvarInfo" name="btnSalvarInfo">Salvar <i class="fa fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- modal de alterar senha -->
        <div id="modalAlterarSenha" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Alterar senha de acesso</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="formSenha" method="POST">
                            <div id="errosFormAlterarSenha"></div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Senha atual</label>
                                        <input id="txtSenhaAtual" name="txtSenhaAtual" type="password" class="form-control" placeholder="Digite sua senha atual" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Nova senha</label>
                                        <input id="txtSenhaNova" name="txtSenhaNova" type="password" class="form-control required" placeholder="Digite sua nova senha" value="" />
                                    </div>
                                    <div class="text-right hidden-xs hidden-sm" style="margin-top: -10px;">
                                        <span class="text-muted">30 caracteres restantes</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Confirme sua nova senha</label>
                                        <input id="txtSenhaNovaConfirma" name="txtSenhaNovaConfirma" type="password" class="form-control required" placeholder="Digite sua nova senha" value="" />
                                    </div>
                                    <div class="text-right hidden-xs hidden-sm" style="margin-top: -10px;">
                                        <span class="text-muted">30 caracteres restantes</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="hiddenSenha" name="hiddenSenha" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                <button type="button" class="btn btn-branco" data-dismiss="modal"><i class="fa fa-reply"></i> Voltar</button>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <button type="button" class="btn btn-branco" id="btnSalvarAlterarSenha">Salvar <i class="fa fa-save"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- modal de fechar tutorial -->
        <div id="modalSairTutorial" class="modal fade" role="dialog" style="z-index:9999; position: absolute;">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close close-tutorial" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Deseja sair do tutorial?</h4>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja fechar o tutorial? É extremamente <strong>recomendado</strong>
                        que confira o passo a passo que preparamos para você. É rápido!
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-xs-6 text-left">
                                <button type="button" class="btn btn-branco"><i class="fa fa-close"></i> Sair</button>
                            </div>
                            <div class="col-xs-6 text-right">
                                <button type="button" class="btn btn-branco" name="btnExcluirConfirma" data-dismiss="modal">Continuar <i class="fa fa-arrow-right"></i></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
<style>
    body:before {
        content: "";
        display: block;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: -10;
        background: url(../img/bg-empresa.jpg) no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
        
        
        
        <?php
            include_once("./fixo/scripts.php");
        ?>

        <script src="../javascript/painel_de_empresas.js"></script>
    </body>
</html>
