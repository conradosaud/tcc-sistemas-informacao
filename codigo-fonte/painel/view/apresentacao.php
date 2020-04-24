<?php
    session_start();
    include_once("../php/funcoes_painel.php");
    include_once("../php/funcoes_apresentacao.php");
    $objApresentacao = busca();
    //var_dump($objApresentacao);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
    </head>
    <body id="viewApresentacao">
        <div class="tutorial" style="display:none"></div>
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>
            
            
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="etapa8" style="background-color:white">
                            <h2><i class="fa fa-star"></i> &nbsp; Editar Apresentação</h2>  
                            <h5 style="font-size: 16px;">A apresentação do seu anúncio é muito importante. É através dela que o visitante terá seu primeiro contato com seu negócio. Desenvolva algo chamativo e confira também as nossas <a href="#">dicas de marketing</a> e aumentar mais seus números!</h5>
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
                                            <li id="porcentagemNomeExibicao" >
                                                Insira o <strong>Nome de Exibição</strong> do seu negócio
                                            </li>
                                            <li id="porcentagemDescricaoCurta" >
                                                Insira uma <strong>Descrição Curta</strong> do seu negócio
                                            </li>
                                            <li id="porcentagemDescricaoLonga" >
                                                Insira uma <strong>Descrição Longa</strong> do seu negócio
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-md-12" id="etapa9">
                            <!-- Form Elements -->
                            <div class="panel panel-default">
                                <div class="panel-heading text-right">
                                    <button id="btnSalvar" class="btn btn-success"><i class="fa fa-save"></i> Salvar alterações</button>
                                </div>
                                <div class="panel-body">
                                    <form role="form" id="formApresentacao" method="POST">
                                        <div id="errosForm"></div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Nome de exibição</label>
                                                    <input id="txtNomeExibicao" name="txtNomeExibicao" type="text" class="char-count form-control" maxlength="50" placeholder="Ex: Salgadaria Rei Coxinha" value="<?php echo $objApresentacao->getNomeExibicao(); ?>" />
                                                </div>
                                                <div class="text-right hidden-xs" style="margin-top: -10px;">
                                                    <span class="text-muted"><span name="txtNomeExibicao">50</span> caracteres restantes</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Descrição curta</label>
                                                    <input id="txtDescricaoCurta" name="txtDescricaoCurta" maxlength="100" type="text" class="char-count form-control required" placeholder="Aparecerá nas pesquisas dos visitantes" value="<?php echo $objApresentacao->getDescricaoCurta(); ?>" />
                                                </div>
                                                <div class="text-right hidden-xs" style="margin-top: -10px;">
                                                    <span class="text-muted"><span name="txtDescricaoCurta">100</span> caracteres restantes</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Descrição longa</label>
                                                    <textarea id="txtDescricaoLonga" name="txtDescricaoLonga" maxlength="300" class="char-count form-control" rows="3" placeholder="Aparecerá dentro do seu anúncio. Diga mais sobre as qualidades, o diferencial do seu negócio e outras informações relevantes..." ><?php echo $objApresentacao->getDescricaoLonga(); ?></textarea>
                                                </div>  
                                                <div class="text-right hidden-xs" style="margin-top: -10px;">
                                                    <span class="text-muted"><span name="txtDescricaoLonga">300</span> caracteres restantes</span>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="hiddenApresentacao" name="hiddenApresentacao" />
                                    </form>
                                </div>
                                <div class="panel-footer text-right">
                                    <button id="btnSalvarProsseguir" class="btn btn-primary">Salvar alterações e prosseguir <i class="fa fa-arrow-right"></i></button>
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
        
        <?php
            include_once("./fixo/scripts.php");
        ?>
        
        <script>
            $("#a_editar_meu_anuncio").addClass("active-menu");
            $("#a_apresentacao").addClass("active-menu");
            $(".nav-second-level").addClass("in");
        </script>
        
        <script src="../javascript/apresentacao.js"></script>
        <script src="../javascript/tutorial_painel.js"></script>
        <script src="../../assets/geral/js/contadorCaractere.js"></script>
    </body>
</html>
