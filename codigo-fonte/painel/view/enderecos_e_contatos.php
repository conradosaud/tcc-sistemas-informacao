<?php
    session_start();
    include_once("../php/funcoes_painel.php");
    include_once("../php/funcoes_enderecos_e_contatos.php");
    $objEndereco = busca();
    $objEmpresa = buscaEmpresa();
    //var_dump($objEmpresa);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
    </head>
    <body id="viewEnderecosEContatos">
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
                            <div id="etapa10" style="background-color: white;">
                                <h2><i class="fa fa-map-marker"></i> &nbsp; Editar Endereços e Contatos</h2>  
                                <h5 style="font-size: 16px;">
                                    Insira o endereço onde seu estabelecimento se encontra, juntamente dos números telefonicos e email para contato.
                                    <br><br>
                                    Não se esqueça de ativar sua localização no mapa, <a href="integracao_com_maps.php">clique aqui</a> e ative agora!
                                </h5>
                            </div>
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                    <hr />
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Complete as informações do formulário <strong>(<span class="spanPorcentagem">0</span>% preenchido)</strong>
                                </div>

                                <div class="panel-body">
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                            <span class="sr-only"><span class="spanPorcentagem">0</span>% Completo</span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="spanItensRestantes">Itens restantes:</span>
                                        <ul style="margin-left: 20px; padding: 0;">
                                            <li id="porcentagemEndereco" >
                                                Cadastre ao menos um endereço
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Seus endereços</h3>
                        </div>
                        <?php 
                            if(count($objEndereco) == 0){
                        ?>
                        
                        <div class="col-sm-12" style="margin-bottom: 20px;">
                            <p>Você ainda não tem nenhum endereço cadastrado, cadastre agora:</p>
                        </div>
                        
                        <?php
                            }else{
                        ?>
                        
                        <div class="col-sm-12" style="margin-bottom: 20px;">
                            <span><?php echo count($objEndereco); ?> Empresas cadastradas</span><br>
                            <a href="#" class="btn btn-sm btn-warning btnCadastrarNovo"><i class="fa fa-plus"></i> Cadastrar Novo</a>
                        </div>
                        
                        <?php 
                            }
                            if(count($objEndereco) > 1){
                        ?>
                        
                        <div class="col-sm-12">
                            <p>Clique para ver: </p>
                        </div>
                        
                        <?php
                            }
                        ?>
                        
                    </div>

                    <?php
                        foreach($objEndereco as $obj){
                    ?>
                    
                    <div class="row formExistente">
                        <div class="col-md-12">
                            <div class="panel panel-default"> 
                                
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12 text-left">
                                            <a href="#" class="btnToggleEndereco" style="font-size: 18px;"><?php if($obj->getRua()){echo $obj->getRua();}elseif($obj->getEmail()){echo $obj->getEmail();}elseif($obj->getCelular1()){echo $obj->getCelular1();}elseif($obj->getTelefone1()){echo $obj->getTelefone1();}; ?></a>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12 text-right">
                                            <div class="visible-xs visible-sm"><span style="margin-top: 30px;">&nbsp;</span></div>
                                            <button href="#" <?php echo (count($objEndereco)>1?"style='display:none'":""); ?> class="btn btn-success btnSalvar btnFormExistente"><i class="fa fa-save"></i> Salvar alterações</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel-body" <?php echo (count($objEndereco)>1?"style='display:none'":""); ?>>
                                    <form role="form" method="POST" id="form-<?php echo $obj->getIdEndereco(); ?>">
                                        <div class="errosForm"></div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <h3>Contato eletrônico</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input id="txtEmail" name="txtEmail" type="text" class="form-control" autocomplete="off" placeholder="Ex: contato@conradosaud.com.br" value="<?php echo $obj->getEmail(); ?>"/>
                                                    <span class="text-muted">
                                                        Os clientes podem lhe enviar mensagens por este endereço.
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Site</label>
                                                    <a href="#" style="float:right;">mudar</a>
                                                    <input id="txtSite" disabled="true" name="txtSite" type="text" class="form-control" placeholder="Nenhum..." />
                                                    <span class="text-muted">
                                                        Ainda não tem um site? <a href="#">Clique aqui!</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row" style="margin-bottom: 10px; margin-top:15px;">
                                            <div class="col-xs-12">
                                                <h3>Endereço</h3>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Informe seu CEP</label>
                                                    <input id="txtCep" name="txtCep" type="text" class="cep form-control" autocomplete="on" placeholder="Ex: Dr. Altino Arantes" value="<?php echo $obj->getCep(); ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Cidade e estado</label><a href="#" style="float:right;">mudar</a>
                                                    <input id="txtCidade" name="txtCidade" disabled="true" type="text" class="form-control" autocomplete="off" value="Franca - SP" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Rua ou avenida</label>
                                                    <input id="txtRua" name="txtRua" type="text" class="form-control" maxlength="50" placeholder="Ex: Parque Universitário" value="<?php echo $obj->getRua(); ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Número</label>
                                                    <input id="txtNumero" name="txtNumero" type="text" class="form-control" maxlength="6" autocomplete="on" placeholder="Ex: 1230" value="<?php echo $obj->getNumero(); ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Bairro</label>
                                                    <input id="txtBairro" name="txtBairro" type="text" class="form-control" maxlength="50" autocomplete="on" placeholder="Ex: Parque Universitário" value="<?php echo $obj->getBairro(); ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Complemento</label>
                                                    <input id="txtComplemento" name="txtComplemento" type="text" class="form-control" maxlength="50" autocomplete="on" placeholder="Ex: Parque Universitário" value="<?php echo $obj->getComplemento(); ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px; margin-top:15px;">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <h3>Telefones</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Telefone Fixo Principal</label>
                                                    <input id="txtTelefone1" name="txtTelefone1" type="text" class="telefone form-control" placeholder="" value="<?php echo $obj->getTelefone1(); ?>"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Celular Principal</label>
                                                    <input id="txtCelular1" name="txtCelular1" type="text" class="celular form-control" placeholder="" value="<?php echo $obj->getCelular1(); ?>" />
                                                    <label class="checkbox-inline">
                                                        <input id="cboxCelular1" name="cboxCelular1" type="checkbox" <?php echo ($obj->getCboxCelular1()?"checked":""); ?>/> Atendemos pelo Whats App <i style="color: green;" class="fa fa-whatsapp"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Telefone Fixo Secundário</label>
                                                    <input id="txtTelefone2" name="txtTelefone2" type="text" class="telefone form-control" placeholder="" <?php echo $obj->getTelefone2(); ?>/>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Celular Secundário</label>
                                                    <input id="txtCelular2" name="txtCelular2" type="text" class="celular form-control" placeholder="" <?php echo $obj->getCelular2(); ?>/>
                                                    <label class="checkbox-inline">
                                                        <input id="cboxCelular2" name="cboxCelular2" type="checkbox" <?php echo ($obj->getCboxCelular2()?"checked":""); ?> /> Atendemos pelo Whats App <i style="color: green;" class="fa fa-whatsapp"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="hiddenEndereco" />
                                    </form>
                                </div>
                                <div class="panel-footer" <?php echo (count($objEndereco)>1?"style='display:none'":""); ?>>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 text-left">
                                            <a href="#" class="btn btn-danger btnExcluirEndereco" rel-endereco="<?php echo $obj->getCep(); ?> (<?php echo $obj->getRua(); ?>)" rel-id="<?php echo $obj->getIdEndereco(); ?>"><i class="fa fa-trash"></i> Excluir</a>
                                        </div>
                                        <div class="col-sm-6 col-md-6 text-right hidden-xs">
                                            <button href="#" class="btn btn-primary btnSalvarProsseguir">Salvar e prosseguir <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Form Elements -->
                        </div>
                    </div>
                    
                    <?php
                        }
                    ?>
                    
                    <div class="row" style="display: <?php echo (count($objEndereco)==0?"block":"none"); ?>;" id="rowFormVazio">
                        <div class="col-md-12" id="etapa11">
                            <div class="panel panel-default">
                                
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-6 text-left">
                                            <a href="#" id="btnCancelar" <?php echo (count($objEndereco)==0?"style='display:none'":""); ?> class="btn btn-danger"><i class="fa fa-reply"></i> Voltar</a>
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <button href="#" class="btn btn-success btnSalvar"><i class="fa fa-save"></i> Salvar novo</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel-body">
                                    <form role="form" method="POST" id="formVazio">
                                        <div class="errosForm"></div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <h3>Contato eletrônico</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input id="txtEmail" name="txtEmail" type="text" class="form-control" autocomplete="off" value="<?php echo $objEmpresa->getEmail(); ?>"/>
                                                    <span class="text-muted">
                                                        Os clientes podem lhe enviar mensagens por este endereço.
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Site</label>
                                                    <a href="informacoes_empresa.php" style="float:right;">mudar</a>
                                                    <input id="txtSite" disabled="true" name="txtSite" type="text" class="form-control" value="<?php echo $objEmpresa->getSite(); ?>" />
                                                    <span class="text-muted">
                                                        Ainda não tem um site? <a href="#">Clique aqui!</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row" style="margin-bottom: 10px; margin-top:15px;">
                                            <div class="col-xs-12">
                                                <h3>Endereço</h3>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Informe seu CEP</label>
                                                    <input id="txtCep" name="txtCep" type="text" class="cep form-control" autocomplete="on" placeholder="Ex: Dr. Altino Arantes" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Cidade e estado</label><a href="#" style="float:right;">mudar</a>
                                                    <input id="txtCidade" name="txtCidade" disabled="true" type="text" class="form-control" autocomplete="off" value="<?php echo $objEmpresa->getCidade()." - ".$objEmpresa->getEstado(); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Rua ou avenida</label>
                                                    <input id="txtRua" name="txtRua" type="text" class="char-count form-control" maxlength="50" placeholder="Ex: Parque Universitário"/>
                                                </div>
                                                <div class="text-right hidden-xs" style="margin-top: -10px;">
                                                    <span class="text-muted"><span name="txtRua">50</span> caracteres restantes</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Número</label>
                                                    <input id="txtNumero" name="txtNumero" type="text" class="form-control" maxlength="6" autocomplete="on" placeholder="Ex: 1230" />
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Bairro</label>
                                                    <input id="txtBairro" name="txtBairro" type="text" class="char-count form-control" maxlength="50" autocomplete="on" placeholder="Ex: Parque Universitário" />
                                                </div>
                                                <div class="text-right hidden-xs" style="margin-top: -10px;">
                                                    <span class="text-muted"><span name="txtBairro">50</span> caracteres restantes</span>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Complemento</label>
                                                    <input id="txtComplemento" name="txtComplemento" type="text" class="char-count form-control" maxlength="50" autocomplete="on" placeholder="Ex: Parque Universitário" />
                                                </div>
                                                <div class="text-right hidden-xs" style="margin-top: -10px;">
                                                    <span class="text-muted"><span name="txtComplemento">50</span> caracteres restantes</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px; margin-top:15px;">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <h3>Telefones</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Telefone Fixo Principal</label>
                                                    <input id="txtTelefone1" name="txtTelefone1" type="text" class="telefone form-control" placeholder="" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Celular Principal</label>
                                                    <input id="txtCelular1" name="txtCelular1" type="text" class="celular form-control" placeholder="" />
                                                    <label class="checkbox-inline">
                                                        <input id="cboxCelular1" name="cboxCelular1" type="checkbox" checked/> Atendemos pelo Whats App <i style="color: green;" class="fa fa-whatsapp"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Telefone Fixo Secundário</label>
                                                    <input id="txtTelefone2" name="txtTelefone2" type="text" class="telefone form-control" placeholder=""/>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Celular Secundário</label>
                                                    <input id="txtCelular2" name="txtCelular2" type="text" class="celular form-control" placeholder=""/>
                                                    <label class="checkbox-inline">
                                                        <input id="cboxCelular2" name="cboxCelular2" type="checkbox"  /> Atendemos pelo Whats App <i style="color: green;" class="fa fa-whatsapp"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="hiddenEndereco" name="hiddenEndereco" />
                                    </form>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-xs-12 text-right">
                                            <button href="#" class="btn btn-primary btnSalvarProsseguir">Salvar e prosseguir <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
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
        
        
        
        <!-- modal de exclusão -->
        <div id="modalExcluir" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Deseja excluir as informações deste endereço?</h4>
                    </div>
                    <div class="modal-body">
                        <p><strong>Atenção:</strong> você está prestes a excluir informações de endereço e contato.
                        <p> Uma vez excluido, todos os registros e informações não poderão ser recuperados novamente. Suas
                        informações de integração com o Google Maps também serão apagadas.</p>
                        
                        <p>Para excluir, digite sua senha de acesso ao painel e confirme abaixo.</p>
                        <div class="row" id="alertSenhaExcluir" style="display:none;">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <strong>Senha incorreta:</strong> verifique e tente novamente.
                                </div>
                            </div>
                        </div>
                        <input class="form-control" id="txtSenhaExcluir" name="txtSenhaExcluir" type="password" placeholder="Digite sua senha"/>
                        <input type="hidden" id="hiddenEndereco" />
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-6 col-sm-6 text-left">
                            <button type="button" class="btn btn-branco" data-dismiss="modal"><i class="fa fa-reply"></i> Voltar</button>
                        </div>
                        <div class="col-md-6 col-sm-6 text-right">
                            <button type="button" class="btn btn-branco" id="btnExcluirConfirma">Excluir <i class="fa fa-check"></i></button>
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
            $("#a_enderecos_e_contatos").addClass("active-menu");
            $(".nav-second-level").addClass("in");
        </script>
        
        <script src="../javascript/enderecos_e_contatos.js"></script>
        <script src="../javascript/tutorial_painel.js"></script>
    </body>
</html>
