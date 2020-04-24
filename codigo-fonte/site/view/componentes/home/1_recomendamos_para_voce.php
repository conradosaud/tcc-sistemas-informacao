
<?php 
    //var_dump($objAnuncioPreencher);
?>

<div class="row" style="margin-top: 40px;">
    <div class="col-12 text-center">
        <h1 class="text-color-secondary">Recomendamos para você:</h1>
    </div>
    <div class="col-12 text-left" style="padding: 0; margin-bottom: -40px; margin-top: 0px;">
        <p class="perspective">
            <a href="anunciados.php?Categorias=Todos" class="btn-creativebutton btn-8 btn-8c bg-color-primary" style="display:inline-block; color: white;">Ver todos</a>
            <span class=" hidden-xs-down text-muted"><small><i class="fa fa-angle-double-left"></i> Deslize para ver mais <i class="fa fa-angle-double-right"></i></small></span>
        </p>
    </div>
</div>

<div class="row" style="margin-top: 20px; position: relative;">
    
    <div class="col-12 text-left hidden-sm-up text-muted">
        <p><small><i class="fa fa-angle-double-left"></i> Deslize para ver mais <i class="fa fa-angle-double-right"></i></small></p>
    </div>
    
    <div class="menu-lateral-cards smoothTouch">
        
        <?php
        // lista completa apenas de anuncios impulsionados
            for($i = 0; $i < count($objAnuncio["objEmpresa"]); $i++){
        ?>
        
        <div class="col-lg-4 col-md-7 sm-12 col-12 bloco-card">
            <div class="card card-fix-height card-pointer">
                <div class="card-heading">
                    <div class="card-img">
                        <img src="http://www.estalando.com.br/painel/img/<?php echo $objAnuncio["objEmpresa"][$i]->getIdEmpresa(); ?>/<?php echo $objAnuncio["objImagem"][$i]->getNome(); ?>" class="img-fluid" style="width: 100%; height: 200px;"/>
                    </div>
                    <div class="card-title card-title-bg">
                        <p><?php echo $objAnuncio["objApresentacao"][$i]->getNomeExibicao(); ?></p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-detail">
                        <span class="card-detail1"><?php echo $objAnuncio["objEmpresa"][$i]->getTipoNegocio(); ?></span>
                        <!--<span class="card-detail2 badge badge-success">ABERTO AGORA</span>-->
                        <?php echo (isOpen($objAnuncio["objHorarios"][$i])?'<span class="card-detail2 badge bg-color-primary-btn">ABERTO AGORA</span>':'<span class="card-detail2 badge badge-warning">Abrirá daqui a pouco</span>'); ?>
                    </div>
                    <div class="card-desc">
                        <p><?php echo $objAnuncio["objApresentacao"][$i]->getDescricaoCurta(); ?></p>
                    </div>
                    <div class="text-center">
                        
                        <p class="card-button">
                            <small><i class="fa fa-angle-double-left"></i></small>Toque para ver <small><i class="fa fa-angle-double-right"></i></small>
                        </p>
                    </div>
                </div>
            </div>
            <input type="hidden" class="hiddenCardClick" href="./anuncio.php?Anuncio=<?php echo $objAnuncio["objEmpresa"][$i]->getIdEmpresa(); ?>"/>
        </div>
        
        <?php
            }
            
            // Completa a lista de recomendados com anuncios comuns caso os recomendados esteja abaixo de 3 anuncios
            if(count($objAnuncio["objEmpresa"]) <= 2){
                for($i = 0; $i < count($objAnuncioPreencher["objEmpresa"]); $i++){
                    ?>
        
        <div class="col-lg-4 col-md-7 sm-12 col-12 bloco-card">
            <div class="card card-fix-height card-pointer">
                <div class="card-heading">
                    <div class="card-img">
                        <img src="http://www.estalando.com.br/painel/img/<?php echo $objAnuncioPreencher["objEmpresa"][$i]->getIdEmpresa(); ?>/<?php echo $objAnuncioPreencher["objImagem"][$i]->getNome(); ?>" class="img-fluid" style="width: 100%; height: 200px;"/>
                    </div>
                    <div class="card-title card-title-bg">
                        <p><?php echo $objAnuncioPreencher["objApresentacao"][$i]->getNomeExibicao(); ?></p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-detail">
                        <span class="card-detail1"><?php echo $objAnuncioPreencher["objEmpresa"][$i]->getTipoNegocio(); ?></span>
                        <?php echo (isOpen($objAnuncioPreencher["objHorarios"][$i])?'<span class="card-defailt2 badge bg-color-primary-btn">ABERTO AGORA</span>':'<span class="card-detail2 badge badge-default">Fechado</span>'); ?>
                    </div>
                    <div class="card-desc">
                        <p><?php echo $objAnuncioPreencher["objApresentacao"][$i]->getDescricaoCurta(); ?></p>
                    </div>
                    <div class="text-center">
                        
                        <p class="card-button">
                            <small><i class="fa fa-angle-double-left"></i></small>Toque para ver <small><i class="fa fa-angle-double-right"></i></small>
                        </p>
                    </div>
                </div>
            </div>
            <input type="hidden" class="hiddenCardClick" href="./anuncio.php?Anuncio=<?php echo $objAnuncioPreencher["objEmpresa"][$i]->getIdEmpresa(); ?>"/>
        </div>
        
        
        <?php
                }
            }
        ?>
        
        <div class="col-lg-4 col-md-7 sm-12 col-12 bloco-card">
            <div class="card card-fix-height card-pointer"  style="background-color: #000000; color: #EC890B;">
                <div class="card-heading">
                    <div class="card-img">
                        <img src="../images/anuncieAqui.png" class="img-fluid"/>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-desc">
                        <div class="text-center">
                            <span><strong>Ainda não é cadastrado? <a href="#" style="text-decoration: underline; color: white;">Clique aqui!</a></strong></span>
                        </div>
                        
                        <div class="text-center">
                            <span>
                                Faça com que mais pessoas conheçam seu negócio e ganhe novos fregueses!
                            </span>
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="card-button">
                            <small style="color: white;"><i class="fa fa-angle-double-left"></i></small><span style="font-weight: bolder; color: #EC890B;"> Toque para <strong style="text-decoration: underline;">saber mais</strong></span> <small style="color: white;"><i class="fa fa-angle-double-right"></i></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <span class="overflow-angulo2"><i class="fa fa-angle-double-right fa-3x"></i></span>
    
</div>