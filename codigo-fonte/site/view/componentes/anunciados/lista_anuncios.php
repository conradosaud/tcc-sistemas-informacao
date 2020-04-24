<?php
    $nItens = (count($objAnuncios["objEmpresa"]) + count($objAnunciosImpulsionados["objEmpresa"]));
?>

<!-- Lista de itens -->
<div class="col-12 col-lg-9 col-xl-9">
    <div class="row">
        <div class="col-12 col-md-3">
            <?php if($nItens >= 1){ ?>
            <p><?php echo $nItens ?> resultado<?php echo ($nItens==1?null:"s"); ?></p>
            <?php }else{ echo "Sem resultados."; }?>
            <input type="hidden" id="hiddenQntItensTotal" value="<?php echo $nItens; ?>">
        </div>
        <div class="col-12 col-md-9 text-right filtro-rapido hidden-xs-down" style="font-size: 1.2em; margin-top: -5px;">
            <span class="badge bg-color-primary-btn"><i class="fa fa-star"></i> Recomendados</span>
            <span class="badge bg-color-primary-btn"><i class="fa fa-certificate"></i> Promoções</span>
            <span class="badge bg-color-primary-dark-btn"><i class="fa fa-plus"></i> Avaliados</span>
            <span class="badge bg-color-primary-dark-btn"><i class="fa fa-plus"></i> Curtidos</span>
            <span class="badge bg-color-primary-dark-btn"><i class="fa fa-plus"></i> Comentados</span>
        </div>
        <div class="col-12 col-md-9 text-left filtro-rapido hidden-sm-up" style="font-size: 0.9em; margin-top: -5px;">
            <span class="badge bg-color-primary-btn"><i class="fa fa-star"></i> Recomendados</span>
            <span class="badge bg-color-primary-btn"><i class="fa fa-certificate"></i> Promoções</span>
            <span class="badge bg-color-primary-dark-btn"><i class="fa fa-plus"></i> Avaliados</span>
        </div>
    </div>

    <?php
        if($nItens <= 0){
    ?>
    
    <div style="background-color: #FFF; padding: 30px; border: 1px solid gray; box-shadow: 1px 1px 3px gray;">
        <div class="col-12">
            <p class="lead">Nenhum resultado foi encontrado para sua pesquisa.<br><a href="anunciados.php?filtro=on&C=%Todos&A=%Recomendados&F=%Todos" class="lead link-default"><strong>Clique aqui</strong></a> e veja nossas recomendações!</p>
        </div>
    </div>
    
    <?php
        }else{
            if(count($objAnunciosImpulsionados["objEmpresa"]) >= 1){
                for($i = 0; $i < count($objAnunciosImpulsionados["objEmpresa"]); $i++){
                ?>
    
    <!-- anuncios impulsionados -->
    <div class="row menu-item transicao-anuncio-x" style="box-shadow:0px 0px 10px #ffb600; background-color: #fffdef; padding-top: 20px; padding-bottom: 20px;" data-id="<?php echo $objAnunciosImpulsionados["objEmpresa"][$i]->getIdEmpresa(); ?>" data-effect="st-effect-11">
        <div style="position: relative">
            <div class="ribbon custom">
                <div class="theribbon">RECOMENDAMOS</div>
                <div class="ribbon-background"></div>
            </div>
        </div>
        <div class="col-5 col-lg-3">
            <img src="http://www.estalando.com.br/painel/img/<?php echo $objAnunciosImpulsionados["objEmpresa"][$i]->getIdEmpresa(); ?>/<?php echo $objAnunciosImpulsionados["objImagem"][$i]->getNome(); ?>" class="img-fluid rounded-circle" style="width: 100%; height: 100%;"/>
        </div>
        <div class="col-6 col-lg-8">
            <div class="row item-title">
                <div class="col-12">
                    <h1 style="text-shadow: 0px 0px 5px #white; font-weight: bold"><?php echo $objAnunciosImpulsionados["objApresentacao"][$i]->getNomeExibicao(); ?></h1>
                </div>
            </div>
            <div class="item-type">
                <div class="row text-left">
                    <div class="col-12">
                        <h2><?php echo $objAnunciosImpulsionados["objEmpresa"][$i]->getTipoNegocio(); ?></h2>
                    </div>
                </div>
            </div>
            <div class="item-desc">
                <div class="row text-left">
                    <div class="col-12">
                        <p><?php echo $objAnunciosImpulsionados["objApresentacao"][$i]->getDescricaoCurta(); ?></p>
                    </div>
                </div>
            </div>
            <div class="item-detail">
                <div class="row text-left">
                    <div class="col-12">
                        <?php echo (isOpen($objAnunciosImpulsionados["objHorarios"][$i])?'<h2 class="badge bg-color-primary-btn" style="box-shadow: 0px 0px 20px white;">ABERTO AGORA</h2>':'<small><h2 class="badge badge-warning" style="padding: 10px 8px;">Abrirá daqui a pouco</h2></small>'); ?>
                        <!-- <h2 class="badge badge-default">Fechado</h2> -->
                        <span style="font-size: 13px; margin-left: 30px; font-weight: bold; opacity: 1;" class="hidden-xs-down"><i class="fa fa-angle-double-left"></i>Toque para ver<i class="fa fa-angle-double-right"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-1 item-icon">
            <div class="row text-center">
                <?php echo ($objAnunciosImpulsionados["objInfo"][$i]->getEntregaDomicilio()?'<div class="col-12" style="color:#FF9800;"><i class="fa fa-motorcycle"></i></div>':null); ?>
                <?php echo ($objAnunciosImpulsionados["objInfo"][$i]->getAtendeLocal()?'<div class="col-12" style="color:#FF9800;"><i class="fa fa-cutlery"></i></div>':null); ?>
                <?php echo ($objAnunciosImpulsionados["objInfo"][$i]->getEstacionamento()?'<div class="col-12" style="color:#FF9800;"><i class="fa fa-car"></i></div>':null); ?>
            </div>
        </div>
    </div>
    
                <?php
                }
                
                echo "<hr>";
                
            }
            for($i = 0; $i < count($objAnuncios["objEmpresa"]); $i++){
    ?>
    <!-- anuncios normais -->
    <div class="row menu-item transicao-anuncio-x" data-id="<?php echo $objAnuncios["objEmpresa"][$i]->getIdEmpresa(); ?>" data-effect="st-effect-11">
        <div class="col-5 col-lg-3">
            <img src="http://www.estalando.com.br/painel/img/<?php echo $objAnuncios["objEmpresa"][$i]->getIdEmpresa(); ?>/<?php echo $objAnuncios["objImagem"][$i]->getNome(); ?>" class="img-fluid rounded-circle" style="width: 100%; height: 100%"/>
        </div>
        <div class="col-6 col-lg-8">
            <div class="row item-title">
                <div class="col-12">
                    <h1><?php echo $objAnuncios["objApresentacao"][$i]->getNomeExibicao(); ?></h1>
                </div>
            </div>
            <div class="item-type">
                <div class="row text-left">
                    <div class="col-12">
                        <h2><?php echo $objAnuncios["objEmpresa"][$i]->getTipoNegocio(); ?></h2>
                    </div>
                </div>
            </div>
            <div class="item-desc">
                <div class="row text-left">
                    <div class="col-12">
                        <p><?php echo $objAnuncios["objApresentacao"][$i]->getDescricaoCurta(); ?></p>
                    </div>
                </div>
            </div>
            <div class="item-detail">
                <div class="row text-left">
                    <div class="col-12">
                        <?php echo (isOpen($objAnuncios["objHorarios"][$i])?'<h2 class="badge bg-color-primary-btn">ABERTO AGORA</h2>':'<h2 class="badge badge-default">Fechado</h2>'); ?>
                        <!-- <h2 class="badge badge-default">Fechado</h2> -->
                        <span style="font-size: 13px; margin-left: 30px; font-weight: bold; opacity: 0.5;" class="text-muted hidden-xs-down"><i class="fa fa-angle-double-left"></i>Toque para ver<i class="fa fa-angle-double-right"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-1 item-icon">
            <div class="row text-center">
                <?php echo ($objAnuncios["objInfo"][$i]->getEntregaDomicilio()?'<div class="col-12" style="color:#FF9800;"><i class="fa fa-motorcycle"></i></div>':null); ?>
                <?php echo ($objAnuncios["objInfo"][$i]->getAtendeLocal()?'<div class="col-12" style="color:#FF9800;"><i class="fa fa-cutlery"></i></div>':null); ?>
                <?php echo ($objAnuncios["objInfo"][$i]->getEstacionamento()?'<div class="col-12" style="color:#FF9800;"><i class="fa fa-car"></i></div>':null); ?>
            </div>
        </div>
    </div>
    
    <?php
            }
        }
    ?>

    <?php
        if($nItens > 6){
    ?>
    
    <div class="row" style="margin-top: 30px;">
        <div class="col-12 text-center">
            <button class="btn bg-color-primary-btn" id="btnCarregarMais" style="width: 70%;">Carregar mais <i class="fa fa-arrow-down"></i></button>
        </div>
    </div>
    
    <?php
        }else{
            ?>
    
    <div class="row" style="margin-top: 30px;">
        <div class="col-12 text-left">
            Poucos resultados em sua busca?<br><button class="btn btn-sm bg-color-primary-btn" id="btnRecomendarAlgo" onclick="window.location.href='anunciados.php?filtro=on&C=%Todos&A=%Recomendados&F=%Todos'"><i class="fa fa-star"></i> Recomende algo bom para mim</button>
        </div>
    </div>
    
            <?php
        }
    ?>
    
</div>