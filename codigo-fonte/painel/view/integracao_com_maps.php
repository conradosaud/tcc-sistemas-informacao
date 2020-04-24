<?php
    session_start();
    include_once("../php/funcoes_painel.php");
    include_once("../php/funcoes_integracao_com_maps.php");
    //$objMaps = buscaMaps();
    $objEndereco = buscaEndereco();
    $objMaps = buscaMaps();
    //var_dump($objMaps);
    //var_dump($objEndereco);
    //var_dump($objMaps);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
        
        <style>
            #map {
             height: 400px;
             width: 100%;
            }
        </style>
    </head>
    <body id="viewIntegracaoComMaps">
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>
            
            
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><i class="fa fa-map"></i> &nbsp; Integração com Google Maps</h2>  
                            <h5>Utilizamos os serviços do Google Maps para localizarmos em quais endereços estão localizados suas empresas de acordo com seus registros em <a href="enderecos_e_contatos.php">Endereços e Contatos</a>. Neste painel você pode corrigir imperfeições ou desativar sua localização no mapa.</h5>
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                    <hr />
                    
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Form Elements -->
                            <div class="panel panel-default">
                                <div class="panel-heading text-left">
                                    <span>Use o botão <strong>Ativar</strong> para localizar sua empresa no mapa.</span>
                                </div>
                                <div class="panel-body">
                                    
                                    <?php
                                        if($objEndereco == null){
                                    ?>
                                        
                                        <p style="margin-bottom: 20px;">Você ainda não tem nenhum endereço (ou CEP) cadastrado neste anúncio. <a href="enderecos_e_contatos.php">Clique aqui</a> para criar um novo.</p>
                                    
                                    <?php
                                        }else{
                                    ?>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive" style="margin-top: 5px;">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="hidden-xs">Cep</th>
                                                            <th>Rua/avenida</th>
                                                            <th class="hidden-xs hidden-sm">Numero</th>
                                                            <th class="hidden-xs hidden-sm">Bairro</th>
                                                            <th>Ativar/Desativar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                            foreach($objEndereco as $i => $obj){
                                                                if($obj->getCep()){
                                                        ?>

                                                        <tr>
                                                            <td class="hidden-xs"><?php echo $obj->getCep(); ?></td>
                                                            <td><?php echo $obj->getRua(); ?></td>
                                                            <td class="hidden-xs hidden-sm"><?php echo $obj->getNumero(); ?></td>
                                                            <td class="hidden-xs hidden-sm"><?php echo $obj->getBairro(); ?></td>
                                                            
                                                            <?php
                                                                if(isset($objMaps[$i])){
                                                                    if($objMaps[$i]->getStatus()=="A"){
                                                                        
                                                            ?>

                                                                    <td><span class="carregando text-muted" style="display:none;"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Aguarde...</span><a class="btn btn-sm btn-block btn-danger btnDesativar" name="<?php echo $obj->getIdEndereco(); ?>">Desativar</a></td>
                                                            
                                                            <?php
                                                                    }else{
                                                            ?>
                                                    
                                                                    <td><span></span><span class="carregando text-muted" style="display:none;"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Aguarde...</span><a class="btn btn-sm btn-block btn-success btnAtivar" name="<?php echo $obj->getIdEndereco(); ?>">Ativar</a></td>
                                                                  
                                                            <?php
                                                                    }
                                                                }else{
                                                            ?>
                                                                
                                                                    <td><span></span><span class="carregando text-muted" style="display:none;"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Aguarde...</span><a class="btn btn-sm btn-block btn-success btnAtivar" name="<?php echo $obj->getIdEndereco(); ?>">Ativar</a></td>

                                                                <?php
                                                                }
                                                            ?>
                                                                    
                                                        </tr>

                                                        <?php
                                                            }}
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <?php
                                    }
                                    ?>
                                        
                                    <!-- nome, rua/av, numero, bairro, cidade, estado, cep -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="map"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="panel-footer text-right">
                                    <a href="horario_de_funcionamento.php" class="btn btn-primary">Prosseguir <i class="fa fa-arrow-right"></i></a>
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
            $("#a_integracao_com_maps").addClass("active-menu");
            $(".nav-second-level").addClass("in");
        </script>
        
        <script src="../javascript/integracao_com_maps.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKIna3T2Vanf1w1aJ75_84UHuOjmUD5EI&callback=initMap"></script>
    </body>
</html>
