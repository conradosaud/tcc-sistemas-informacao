
<div class="row" style="margin-top: 40px;">
    <div class="col-md-12 text-center">
        <h2 class="text-color-secondary">Veja mais opções:</h2>
    </div>
    <div class="col-12 text-left" style="padding: 0; margin-bottom: -40px; margin-top: 0px;">
        <p class="perspective">
            <a href="anunciados.php?Categorias=Todos" class="btn-creativebutton btn-8 btn-8c bg-color-primary" style="display:inline-block; color: white;">Ver todos</a>
            <span class="hidden-xs-down text-muted"><small><i class="fa fa-angle-double-left"></i> Deslize para ver mais <i class="fa fa-angle-double-right"></i></small></span>
        </p>
    </div>
</div>
<div class="row" style="margin-top: 20px;">
    
    <div class="col-12 text-left hidden-sm-up">
        <p class="text-muted"><small><i class="fa fa-angle-double-left"></i> Deslize para ver mais <i class="fa fa-angle-double-right"></i></small></p>
    </div>
    
    <div class="menu-lateral-cards smoothTouch">

        <?php
            for($i = 0; $i < count($objAnuncioGeral["objEmpresa"]); $i++){
        ?>
        
        <div class="mini-card">
            <img src="http://www.estalando.com.br/painel/img/<?php echo $objAnuncioGeral["objEmpresa"][$i]->getIdEmpresa(); ?>/<?php echo $objAnuncioGeral["objImagem"][$i]->getNome(); ?>" class="img-fluid" style="width: 150px; height: 100px;"/>
            <p style="font-size: 11px; font-weight: bold" class="text-center"><?php echo $objAnuncioGeral["objApresentacao"][$i]->getNomeExibicao(); ?></p>
            <div class="text-center mini-card-button">
                <span>Toque para ver</span>
            </div>
            <input type="hidden" class="hiddenCardClick" href="./anuncio.php?Anuncio=<?php echo $objAnuncioGeral["objEmpresa"][$i]->getIdEmpresa(); ?>"/>
        </div>
        
        <?php
            }
        ?>
        
    </div>
</div>