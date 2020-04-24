<?php
    session_start();
    include_once("../php/funcoes_painel.php");
    include_once("../php/funcoes_galeria_de_fotos.php");
    $objGaleria = busca();
    //var_dump($objGaleria);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
    </head>
    <body id="viewGaleriaDeFotos">
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>
            
            
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><i class="fa fa-picture-o"></i> &nbsp; Editar Galeria de Fotos</h2>  
                            <h5 style="font-size: 16px;">É muito importante haver fotos do seu negócio, pois isso aproxima o visitante do seu comércio. Recomendamos que adicione fotos da faixada do local, assim como a apresentação do estabelecimento por dentro, sua cozinha, seus produtos, entre outros. Veja também as nossas <a href="#">dicas de marketing</a> e saiba quais fotos são recomendadas para ter em sua galeria!</h5>
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
                                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                            <span class="sr-only"><span class="spanPorcentagem">0</span>% Completo</span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="spanItensRestantes">Itens restantes:</span>
                                        <ul style="margin-left: 20px; padding: 0;">
                                            <li id="porcentagemImagem">
                                                Adicione <strong>duas</stron> fotos da sua empresa
                                            </li>
                                            <li id="porcentagemPrincipal">
                                                Escolha uma foto como principal
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Form Elements -->
                            <div class="panel panel-default">
                                <div class="panel-heading text-right">
                                    <button disabled="true" class="btn btn-success"><i class="fa fa-save"></i> Salvo automaticamente</button>
                                </div>
                                <div class="panel-body">
                                    
                                    <form role="form" enctype="multipart/form-data">
                                        <label class="btn btn-lg btn-warning btn-file" <?php echo (count($objGaleria)>=8?"disabled='true'":""); ?> style="text-shadow:1px 1px 5px black; margin-bottom: 10px;">
                                            <i class="fa fa-camera"></i> Adicionar fotos <input name="imgInput" type="file" id="btnAdicionarImagem" style="display: none;" multiple="true">
                                        </label>
                                        <br>
                                        <span class="text-muted"><strong>Limite:</strong> 8 imagens.</span> <?php echo (count($objGaleria)>=8?"<strong>Atenção:</strong> você atingiu seu limite de imagens.":""); ?><br>
                                        <span class="text-muted"><strong>Atenção:</strong> são aceitos apenas imagens no formato .jpg e .png. Tamanho recomendado 1000x664.</span>
                                    </form>
                                    
                                    <div class="row">
                                        <div class="col-md-12 text-center text-muted" id="divAguarde" style="display:none;">
                                            <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br>
                                            <span>Carregando imagens, aguarde...</span>
                                        </div>
                                    </div>
                                    
                                    <?php
                                         if(count($objGaleria) != 0){
                                    ?>
                                    
                                    <div class="row" style="margin-bottom: 25px;">
                                        <div class="col-md-12">
                                            <p clas="lead">Itens selecionados:</p>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="#" id="btnRemover" class="btn btn-danger"><i class="fa fa-trash"></i> Remover</a>
                                            <a href="#" id="btnTornarPrincipal" class="btn btn-default"><i class="fa fa-bullseye"></i> Tornar principal</a>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        
                                        <?php
                                            foreach ($objGaleria as $obj){
                                        ?>
                                        
                                        <div class="col-md-3 col-sm-4 col-xs-12 divImagem">
                                            <div class="panel panel-<?php echo ($obj->getPrincipal()?"primary":"default"); ?>">
                                                <div class="panel-heading">
                                                    <small><label><input type="checkbox" name="<?php echo $obj->getIdImagem(); ?>" /> Selecionar</label></small>
                                                </div>
                                                <div class="panel-body" style="padding: 0px;">
                                                    <img src="../img/<?php echo $_SESSION["IdEmpresa"]; ?>/<?php echo $obj->getNome(); ?>" style="width: 100%; height: 160px;" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <?php
                                                }
                                            }else{
                                        ?>
                                        
                                        <div class="col-md-12">
                                            <p>Você ainda não adicionou nenhuma imagem.</p>
                                        </div>
                                        
                                        <?php
                                            }
                                        ?>
                                        
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <a href="horario_de_funcionamento.php" class="btn btn-primary">Prosseguir <i class="fa fa-arrow-right"></i></a>
                                            </div>
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
        
        
        <!-- modal de fechar tutorial -->
        <div id="modalExcluirImagem" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Deseja excluir suas imagens?</h4>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir as imagens selecionadas? Lembre-se que imagens excluidas não
                        podem ser recuperadas novamente.
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-xs-6 text-left">
                                <button type="button" class="btn btn-branco" data-dismiss="modal"><i class="fa fa-reply"></i> Voltar</button>
                            </div>
                            <div class="col-xs-6 text-right">
                                <button type="button" class="btn btn-branco" id="btnRemoverConfirma" data-dismiss="modal">Excluir <i class="fa fa-trash"></i></i></button>
                            </div>
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
            $("#a_galeria_de_fotos").addClass("active-menu");
            $(".nav-second-level").addClass("in");
        </script>
        
        <script src="../javascript/galeria_de_fotos.js"></script>
    </body>
</html>
