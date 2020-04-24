
<div class="container">

    <div class="row" style="padding-top: 30px; margin-bottom: -10px;">
        <div class="col-6 text-left" >
            <button class="btn bg-color-primary-dark-btn" onclick="window.history.go(-1); return false;"><i class="fa fa-arrow-left"></i> Voltar</button>       
        </div>
        <div class="col-6">
            <div class="dropdown text-right">
                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cogs"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#"><i class="fa fa-chain-broken"></i> Reportar um erro</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-flag"></i> Denunciar este anúncio</a>
                </div>
            </div>        
        </div>
    </div>
    <br>


    <div class="btnLoginFacebook" style="display: none;">
        <p>Conecte-se com o Facebook para visualizar todas informações deste local, é fácil e rápido!</p>
        <div onlogin="login();" class="fb-login-button"  data-max-rows="1" data-size="medium" data-button-type="continue_with" data-show-faces="true" data-auto-logout-link="false" data-use-continue-as="true"></div>
        <!-- <fb:login-button scope="public_profile" class="btnLoginFacebook" onlogin="login();"></fb:login-button> -->
    </div>

    <div class="row" >
        <div class="col-md-12 text-center">
            <h1><?php echo $objAnuncio["objApresentacao"]->getNomeExibicao(); ?></h1>
            <p style="font-size: 18px;">
                <span><strong><?php echo $objAnuncio["objEmpresa"]->getTipoNegocio(); ?></strong></span>
                <span>em <?php echo $objAnuncio["objEmpresa"]->getCidade()." - ".$objAnuncio["objEmpresa"]->getEstado(); ?></span>
                <br>
            <div class="row">
                <div class="col-12 text-center btnAcessoRapido">
                    <div class="hidden-sm-up">
                        <a href="#" class="btn bg-color-primary-btn btn-circle-sm"><i class="fa fa-facebook-square"></i></a>
                        <?php if(validaHorarios($objAnuncio["objHorarios"])){ ?> <a href="#" class="btn bg-color-primary-btn btn-circle-sm"><i class="fa fa-clock-o"></i></a> <?php } ?>
                        <a href="#" class="btn bg-color-primary-btn btn-circle-sm"><i class="fa fa-phone-square"></i></a>
                        <?php if(validaMaps($objAnuncio["objMaps"])){ ?> <a href="#" class="btn bg-color-primary-btn btn-circle-sm"><i class="fa fa-map-marker"></i></a> <?php } ?>
                        <a href="#" class="btn bg-color-primary-btn btn-circle-sm"><i class="fa fa-comment"></i></a>
                    </div>
                    <div class="hidden-xs-down">
                        <a href="#" class="btn bg-color-primary-btn btn-circle"><i class="fa fa-facebook-square"></i></a>
                        <?php if(validaHorarios($objAnuncio["objHorarios"])){ ?> <a href="#" class="btn bg-color-primary-btn btn-circle"><i class="fa fa-clock-o"></i></a> <?php } ?>
                        <a href="#" class="btn bg-color-primary-btn btn-circle"><i class="fa fa-phone-square"></i></a>
                        <?php if(validaMaps($objAnuncio["objMaps"])){ ?><a href="#" class="btn bg-color-primary-btn btn-circle"><i class="fa fa-map-marker"></i></a> <?php } ?>
                        <a href="#" class="btn bg-color-primary-btn btn-circle"><i class="fa fa-comment"></i></a>
                    </div>
                </div>
            </div>
            </p>
        </div>
        <div class="col-md-4" style="display:none;">

            <div class="media-pequena text-center">
                <br>
                <strong> Gostou?</strong> Avalie este local
                <div class="fb-like" data-href="#" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>

            </div>

        </div>
    </div>

</div>

<div class="row bg-anuncio">
    <div class="col-12">
        <div id="touchScroller" style="cursor: pointer;">
            
            <?php
                include_once("./componentes/anuncio/slider.php");
            ?>
            
        </div>
    </div>
    <div class="col-12">
        <p class="text-center">
            <strong><a href="#"><?php echo $objAnuncio["objEmpresa"]->getSite(); ?></a></strong>
        </p>
        <p class="text-center text-desc">
            <?php echo $objAnuncio["objApresentacao"]->getDescricaoLonga(); ?>
        </p>
        <div class="col-12 hidden-xs-down">
            <table class="table table-borderless">
                <tr style="color: white;" class="text-center" >
                    <td><i class="fa fa-cutlery"></i><strong> Atende no local</strong></td>
                    <td><i class="fa fa-motorcycle"></i><strong> Entrega a domicilio</strong></td>
                    <td><i class="fa fa-car"></i><strong> Estacionamento</strong></td>

                </tr>
                <tr class="text-center">
                    <td>
                        <?php echo ($objAnuncio["objInfo"]->getAtendeLocal()?'<span class="badge bg-color-primary bagde-anuncio">Sim</span>':'<span class="badge badge-default bagde-anuncio">Não</span>'); ?>
                    </td>
                    <td>
                        <?php echo ($objAnuncio["objInfo"]->getEntregaDomicilio()?'<span class="badge bg-color-primary bagde-anuncio">Sim</span>':'<span class="badge badge-default bagde-anuncio">Não</span>'); ?>
                    </td>
                    <td>
                        <?php echo ($objAnuncio["objInfo"]->getEstacionamento()?'<span class="badge bg-color-primary bagde-anuncio">Sim</span>':'<span class="badge badge-default bagde-anuncio">Não</span>'); ?>
                    </td>
                </tr>

            </table>
        </div>
        <div class="col-12 hidden-sm-up">
            <table class="table table-borderless" style="color: white;">
                <tr>
                    <td><i class="fa fa-cutlery"></i><strong> Atende no local</strong></td>
                    <td>
                        <?php echo ($objAnuncio["objInfo"]->getAtendeLocal()?'<span class="badge badge-success bagde-anuncio">Sim</span>':'<span class="badge badge-danger bagde-anuncio">Não</span>'); ?>
                    </td>
                </tr>
                <tr>
                    <td><i class="fa fa-motorcycle"></i> <strong>Entrega a domicilio</strong></td>
                    <td>
                        <?php echo ($objAnuncio["objInfo"]->getEntregaDomicilio()?'<span class="badge badge-success bagde-anuncio">Sim</span>':'<span class="badge badge-danger bagde-anuncio">Não</span>'); ?>
                    </td>
                </tr>
                <tr>
                    <td><i class="fa fa-car"></i> <strong>Estacionamento</strong></td>
                    <td>
                        <?php echo ($objAnuncio["objInfo"]->getEstacionamento()?'<span class="badge badge-success bagde-anuncio">Sim</span>':'<span class="badge badge-danger bagde-anuncio">Não</span>'); ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="container">

    <div class="row">
        <div class="card-deck-overflow dragscroll">
            
            <div class="card-edit">
                <h3>Gostou?Avalie!</h3>
                <p>Avalie este anuncio clicando abaixo em <strong>Gostei</strong> para avaliá-lo como um bom negócio!</p>
                <div class="text-center">
                    <span class="fbCarregando"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span>
                    <div class="fb-like fbCarregado" data-href="<?php echo $urlFacebook; ?>" data-layout="button" data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>
                </div>
            </div>
            
            <div class="card-edit">
                <h3>Recomende a amigos</h3>
                <p>Gostaria de recomendar este anúncio para alguém? <strong>Compartilhe</strong> com quem você quiser!</p>
                <div class="text-center">
                    <span class="fbCarregando"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span>
                    <div class="fb-share-button fbCarregado" data-href="<?php echo $urlFacebook; ?>" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"></a></div>
                </div>
            </div>
            
            <div class="card-edit">
                <h3>No Messenger</h3>
                <p>Você também pode recomendar este anúncio enviando para a seus amigos no Messenger:</p>
                <div class="text-center">
                    <span class="fbCarregando"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span>
                    <div class="fbCarregado" style="display:none; margin-bottom: -9px;"><button id="btnEnviar" class="btn btn-info" style="transform: scale(0.8);" data-href="<?php echo $urlFacebook; ?>"><i class="fa fa-bolt"></i> Enviar</button></div>
                </div>
            </div>
            <div class="card-edit">
                <h3>Salve para ver depois</h3>
                <p>Gostou deste anúncio e gostaria de vê-lo depois? <strong>Salve-o</strong> para ver mais tarde no seu Facebook:</p>
                <div class="text-center">
                    <span class="fbCarregando"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></span>
                    <div class="fb-save fbCarregado" data-uri="<?php echo $urlFacebook; ?>" data-size="large"></div>
                </div>
            </div>
        </div>
    </div>

    <?php
        if(validaHorarios($objAnuncio["objHorarios"])){
    ?>
    
    <div id="divFuncionamento" style="margin-bottom: -20px; margin-top: 50px;">
        <div class="row">
            <div class="col-12">
                <h3><i class="fa fa-clock-o"></i> Funcionamento</h3>
                
                <?php
                    if(isOpen($objAnuncio["objHorarios"])){
                ?>
                
                <p>
                    <span class="badge badge-default bg-color-primary" style="font-size:15px;">Aberto agora</span>
                    
                        <?php 
                            for($i = 0; $i < count($objAnuncio["objEndereco"]); $i++){
                                if($objAnuncio["objEndereco"][$i]->getTelefone1() || $objAnuncio["objEndereco"][$i]->getCelular1()){
                                    ?>
                    
                                        &nbsp;&nbsp;
                                        <a href="#" class="vaParaEnderecos" style="color: #664B3A;"><i class="fa fa-phone"></i><u> Ligue agora</u></a>
                    
                                    <?php
                                    break;
                                }
                            } 
                        ?>
                    
                </p>
                
                <?php
                    }else{
                ?>
                
                    <p>
                        <span class="badge badge-default" style="font-size:15px;">Fechado</span>
                        
                        <?php 
                            for($i = 0; $i < count($objAnuncio["objEndereco"]); $i++){
                                if($objAnuncio["objEndereco"][$i]->getEmail()){
                                    ?>
                    
                                        &nbsp;&nbsp;
                                        <a href="#" class="vaParaEnderecos" style="color: #664B3A;"><i class="fa fa-envelope"></i><u> Deixe uma mensagem</u></a>
                    
                                    <?php
                                    break;
                                }
                            } 
                        ?>
                        
                    </p>
                    
                <?php
                    }
                ?>
                    
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr class="text-center">
                                <td>#</td>
                                <!-- corrigir -->
                                <td><strong>Segunda</strong>
                                <td><strong>Terça</strong>
                                <td><strong>Quarta</strong>
                                <td><strong>Quinta</strong>
                                <td><strong>Sexta</strong>
                                <td><strong>Sábado</strong>
                                <td><strong>Domingo</strong>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Das</strong></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getSegundaDas(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getTercaDas(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getQuartaDas(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getQuintaDas(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getSextaDas(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getSabadoDas(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getDomingoDas(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                            </tr>
                            <tr>
                                <td><strong>Às</strong></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getSegundaAs(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getTercaAs(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getQuartaAs(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getQuintaAs(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getSextaAs(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getSabadoAs(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                                <td><?php $dia = $objAnuncio["objHorarios"]->getDomingoAs(); if(strlen($dia)>1){echo ($dia=="99:99"?'<span class="badge badge-warning">24hs</span>':$dia);}else{echo '<span class="text-muted">--:--</span>';} ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>


        </div>
    </div>

    <?php
        }
    ?>

    <hr>

    <?php
        if(count($objAnuncio["objEndereco"]) == 1){
    ?>
    
    <div class="row">
        <div class="col-12">
           <div class="card-group">
               
                <?php 
                    if($objAnuncio["objEndereco"][0]->getCep()){
                ?>
               
                <div class="card card-default text-center">
                    <div class="card-block">
                        <h4><i class="fa fa-map-marker fa-2x"></i></h4>
                        <p class="card-text">
                            <span class='text-color-secondary' style="opacity: 0.8"><strong>R</strong>ua:</span> <?php echo $objAnuncio["objEndereco"][0]->getRua(); ?>
                            <br><span class='text-color-secondary' style="opacity: 0.8"><strong>B</strong>airro:</span> <?php echo $objAnuncio["objEndereco"][0]->getBairro(); ?>
                            <br><span class='text-color-secondary' style="opacity: 0.8"><strong>N</strong>úmero:</span> <?php echo $objAnuncio["objEndereco"][0]->getNumero(); ?>
                            <?php echo ($objAnuncio["objEndereco"][0]->getComplemento()?"<br><span class='text-color-secondary' style='opacity: 0.8'>".$objAnuncio["objEndereco"][0]->getComplemento()."</span>":NULL); ?>
                            <br><strong><?php $objAnuncio["objEmpresa"]->getCidade()." - ".$objAnuncio["objEmpresa"]->getEstado(); ?></strong>
                        </p>
                    </div>
                </div>
                
                <?php
                    }
                    if($objAnuncio["objEndereco"][0]->getTelefone1() || $objAnuncio["objEndereco"][0]->getCelular1()){
                ?>
                
                <div class="card card-default text-center">
                    <div class="card-block">
                        <h4><i class="fa fa-phone-square fa-2x"></i></h4>
                        <p class="card-text">
                            <?php echo ($objAnuncio["objEndereco"][0]->getCelular1()?'<strong><i class="fa fa-mobile-phone"></i> '.$objAnuncio["objEndereco"][0]->getCelular1().' '.($objAnuncio["objEndereco"][0]->getCboxCelular1()?'<i class="fa fa-whatsapp" style="color:#4BAE4F;"></i>':NULL).'</strong><br>':NULL) ?>
                            <?php echo ($objAnuncio["objEndereco"][0]->getCelular2()?'<i class="fa fa-mobile-phone"></i> '.$objAnuncio["objEndereco"][0]->getCelular2().' '.($objAnuncio["objEndereco"][0]->getCboxCelular2()?'<i class="fa fa-whatsapp" style="color:#4BAE4F;"></i>':NULL).'<br>':NULL) ?>
                            <?php echo ($objAnuncio["objEndereco"][0]->getTelefone1()?'<strong><i class="fa fa-phone"></i> '.$objAnuncio["objEndereco"][0]->getTelefone1().'</strong><br>':NULL) ?>
                            <?php echo ($objAnuncio["objEndereco"][0]->getTelefone2()?'<i class="fa fa-phone"></i> '.$objAnuncio["objEndereco"][0]->getTelefone2().'<br>':NULL) ?>
                        </p>
                    </div>
                </div>
               
               <?php
                    }
                    if($objAnuncio["objEndereco"][0]->getEmail() || $objAnuncio["objEmpresa"]->getSite()){
               ?>
               
                <div class="card card-default text-center">
                    <div class="card-block">
                        <h4><i class="fa fa-globe fa-2x"></i></h4>
                        <p class="card-text">
                            <?php echo ($objAnuncio["objEndereco"][0]->getEmail()?'<i class="fa fa-envelope"></i> '.$objAnuncio["objEndereco"][0]->getEmail().'<br>':NULL); ?>
                            <?php echo ($objAnuncio["objEmpresa"]->getSite()?'<i class="fa fa-internet-explorer"></i> <a class="link-color-secondary" href="'.$objAnuncio["objEmpresa"]->getSite().'" target="_blank">'.$objAnuncio["objEmpresa"]->getSite().'</a><br>':NULL); ?>
                            <i class="fa fa-facebook-square"></i> <a class="link-color-secondary" href="#">/conradosaudprogramador</a><br>
                            <i class="fa fa-instagram"></i> <a class="link-color-secondary" href="#">@conradosaud</a><br>
                            <i class="fa fa-twitter-square"></i> <a class="link-color-secondary" href="#">@conradosaud</a><br>
                        </p>
                    </div>
                </div>
               
               <?php
                    }
               ?>
               
            </div>
        </div>
    </div>
    
    <?php
        }else{
    ?>
    
    <div class="row">
        <div class="col-12">
            
            <?php 
                foreach($objAnuncio["objEndereco"] as $key => $obj){
            ?>
            
            <p class="multi-endereco" style="background-color: #555;" data-end="<?php echo $key; ?>"><a href="#" class="multi-endereco-link"><strong>Local <?php echo $key+1; ?></strong> - <?php if($obj->getRua()){echo $obj->getRua();}elseif($obj->getEmail()){echo $obj->getEmail();}elseif($obj->getCelular1()){echo $obj->getCelular1();}elseif($obj->getTelefone1()){echo $obj->getTelefone1();} ?></a></p>
            <div class="card-group" data-end="<?php echo $key; ?>" <?php echo ($key >= 1?'style="display:none;"':NULL) ?> >
                
                <?php 
                    if($objAnuncio["objEndereco"][$key]->getCep()){
                ?>
               
                <div class="card card-default text-center">
                    <div class="card-block">
                        <h4><i class="fa fa-map-marker fa-2x"></i></h4>
                        <p class="card-text">
                            <span class='text-color-secondary' style="opacity: 0.8"><strong>R</strong>ua:</span> <?php echo $objAnuncio["objEndereco"][$key]->getRua(); ?>
                            <br><span class='text-color-secondary' style="opacity: 0.8"><strong>B</strong>airro:</span> <?php echo $objAnuncio["objEndereco"][$key]->getBairro(); ?>
                            <br><span class='text-color-secondary' style="opacity: 0.8"><strong>N</strong>úmero:</span> <?php echo $objAnuncio["objEndereco"][$key]->getNumero(); ?>
                            <?php echo ($objAnuncio["objEndereco"][$key]->getComplemento()?"<br><span class='text-color-secondary' style='opacity: 0.7'>".$objAnuncio["objEndereco"][$key]->getComplemento()."</span>":NULL); ?>
                            <br><strong><?php echo $objAnuncio["objEmpresa"]->getCidade()." - ".$objAnuncio["objEmpresa"]->getEstado(); ?></strong>
                        </p>
                    </div>
                </div>
                
                <?php
                    }
                    if($objAnuncio["objEndereco"][$key]->getTelefone1() || $objAnuncio["objEndereco"][$key]->getCelular1()){
                ?>
                
                <div class="card card-default text-center">
                    <div class="card-block">
                        <h4><i class="fa fa-phone-square fa-2x"></i></h4>
                        <p class="card-text">
                            <?php echo ($objAnuncio["objEndereco"][$key]->getCelular1()?'<strong><i class="fa fa-mobile-phone"></i> '.$objAnuncio["objEndereco"][$key]->getCelular1().' '.($objAnuncio["objEndereco"][$key]->getCboxCelular1()?'<i class="fa fa-whatsapp" style="color:#4BAE4F;"></i>':NULL).'</strong><br>':NULL) ?>
                            <?php echo ($objAnuncio["objEndereco"][$key]->getCelular2()?'<i class="fa fa-mobile-phone"></i> '.$objAnuncio["objEndereco"][$key]->getCelular2().' '.($objAnuncio["objEndereco"][$key]->getCboxCelular2()?'<i class="fa fa-whatsapp"></i>':NULL).'<br>':NULL) ?>
                            <?php echo ($objAnuncio["objEndereco"][$key]->getTelefone1()?'<strong><i class="fa fa-phone"></i> '.$objAnuncio["objEndereco"][$key]->getTelefone1().'</strong><br>':NULL) ?>
                            <?php echo ($objAnuncio["objEndereco"][$key]->getTelefone2()?'<i class="fa fa-phone"></i> '.$objAnuncio["objEndereco"][$key]->getTelefone2().'<br>':NULL) ?>
                        </p>
                    </div>
                </div>
               
               <?php
                    }
                    if($objAnuncio["objEndereco"][$key]->getEmail() || $objAnuncio["objEmpresa"]->getSite()){
               ?>
               
                <div class="card card-default text-center">
                    <div class="card-block">
                        <h4><i class="fa fa-globe fa-2x"></i></h4>
                        <p class="card-text">
                            <?php echo ($objAnuncio["objEndereco"][$key]->getEmail()?'<i class="fa fa-envelope"></i> '.$objAnuncio["objEndereco"][$key]->getEmail().'<br>':NULL); ?>
                            <?php echo ($objAnuncio["objEmpresa"]->getSite()?'<i class="fa fa-internet-explorer"></i> <a class="link-color-secondary" href="'.$objAnuncio["objEmpresa"]->getSite().'" target="_blank">'.$objAnuncio["objEmpresa"]->getSite().'</a><br>':NULL); ?>
                            <i class="fa fa-facebook-square"></i> <a href="#" class="link-color-secondary">/conradosaudprogramador</a><br>
                            <i class="fa fa-instagram"></i> <a href="#" class="link-color-secondary">@conradosaud</a><br>
                            <i class="fa fa-twitter-square"></i> <a href="#" class="link-color-secondary">@conradosaud</a><br>
                        </p>
                    </div>
                </div>
               
               <?php
                    }
               ?>
                
            </div>
            
            <?php
                }
            ?>
            
        </div>
    </div>
    
    <?php
        }
    ?>
    
    <?php
        if(validaMaps($objAnuncio["objMaps"])){
    ?>
    
    <?php
        foreach ($objAnuncio["objMaps"] as $obj){
    ?>
    
        <input type="hidden" class="hiddenMap" value="<?php echo $obj->getLatitude().'|'.$obj->getLongitude() ?>"/>
    
    <?php
        }
    ?>
    
    <script type="text/javascript" src="../javascript/maps.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKIna3T2Vanf1w1aJ75_84UHuOjmUD5EI&callback=initMap"></script>
    
    <hr>
    
    <style>
        #map{
            width: 100%;
            height: 450px;
        }
    </style>
    
    <div class="row">
        <div class="col-12 text-center">
            <div id="map"></div>
        </div>
    </div>

    <?php
        }
    ?>

    <!-- 
    https://developers.google.com/maps/documentation/embed/guide?hl=pt-br
    http://pt.mygeoposition.com/
    http://maps.google.com/maps/api/geocode/json?address=-20.3162556,-48.3064025&sensor=false
    http://maps.google.com/maps/api/geocode/json?address=rua+02+139+centro+-+sp&sensor=false
    -->

    <!-- INSERE CARDAPIO -->

    <hr>


    <div class="row">
        <div class="col-md-12">
            <h3><i class="fa fa-comments-o" id="divComentariosFb"></i> Comentários</h3>

            <?php
                //if($objAnuncio["objFacebook"]->getIdFacebook()){
            ?>

            <div class="fbCarregando text-center">
                <i class="fa fa-spinner fa-2x fa-spin fa-fw"></i>
                <br>
                Aguarde enquanto os comentários são carregados...
            </div>

            <div class="fbCarregado">
                <span class="text-muted">Deixe seu comentário também, diga o que você achou deste local!</span>
                <br>
                <div id="divFacebook" class="fb-comments"
                     data-width="100%"
                     data-numposts="5"
                     data-href="<?php echo $objAnuncio["objFacebook"]->getLinkPagina(); ?>">
                </div>
                <!-- config: https://developers.facebook.com/docs/plugins/comments/ -->
            </div>

            <?php
                //}else{
            ?>

            <!--
            <span class="text-muted">
                Esta empresa ainda não vinculou sua página do Facebook.
            </span>
            -->

            <?php
                //}
            ?>

        </div>
    </div>


    <!-- /.col-md-9 -->
</div>