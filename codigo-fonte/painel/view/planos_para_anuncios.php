<?php
    session_start();
    include_once("../php/funcoes_painel.php");
    include_once("../php/funcoes_planos_para_anuncios.php");
    
    date_default_timezone_set('America/Sao_Paulo');
    $mesAtual = date("m");
    //$mesAtual = 12;
    $anoAtual = date("Y");
    $diasMesAtual = cal_days_in_month(CAL_GREGORIAN,$mesAtual,$anoAtual);

    //echo date('w', strtotime('2017-09-1'));

?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
        
        <link href="../css/style-calendario.css" rel="stylesheet"/>
    </head>
    <body id="">
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>
            
            
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><i class="fa fa-rocket"></i> &nbsp; Planos Para Anúncios</h2>  
                            <h5>Utilize nossos planos especiais para melhorar o número de visitas no seu anúncio, aumentar seu marketing, ganhar novos fregueses e ser encontrado por todos! <a href="#">Clique aqui</a> para saber mais.</h5>
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                    <hr />
                    
                    <div id="divInserirCupom" style="display: block;">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                <h5><i class="fa fa-flag-checkered fa-3x"></i><strong> &nbsp; Está quase pronto!</strong></h5>
                             <p style="font-size: 16px;">Esta página está em desenvolvimento no momento. Em breve traremos novidades! </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <p>Se você possuir um <strong>cupom promocional</strong>, você pode inserí-lo abaixo:</p>
                        </div>
                        <div class="col-md-6">
                            <div class="form-grup">
                                <label>Cupom promocional</label>
                                <input type="text" class="form-control" id="txtCupom" placeholder="Insira aqui o código do seu cupom">
                            </div>
                            <button class="btn btn-primary" id="btnEnviarCupom" style="margin-top: 10px;"><i class="fa fa-ticket"></i> Enviar cupom</button>
                        </div>
                    </div>
                    
                    <div class="row" id="alertCupom" style="display: none; margin-top: 20px;">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <span id="msgCupom"></span>
                            </div>
                        </div>
                    </div>
                        
                    </div>
                    
                    <div id="selecionarData" style="display:none">

                        <div class="col-md-12">
                            <h3>Informações do plano</h3>
                            <ul class="list-unstyled">
                                <li>Tipo de plano: <strong><span class="spanTipoPlano">?</span></strong></li>
                                <li>Plano escolhido: <strong><span class="spanPlanoEscolhido">?</span></strong></li>
                                <li>Tipo de dia: <strong><span class="spanTipo">?</span></strong></li>
                                <li style="display: none;" class="layoutDiasSemanal">Quantidade de dias semanal: <strong><span class="spanDiasSemanal">?</span></strong></li>
                                <li style="display: none;" class="layoutDiasFds">Quantidade de dias final de semana: <strong><span class="spanDiasFs">?</span></strong></li>
                                <li style="display: none;" class="layoutDiasEspecial">Quantidade de dias: <strong><span class="spanDiasEspecial">?</span></strong></li>
                                <li>Valor plano: <strong><small>R$ </small></strong><strong><span class="spanValorPlano">?</span></strong></li>
                                <li style="display: none;" class="layoutDesconto">Desconto <span class="spanTipoAssinatura">?</span>: <strong><small></small></strong><strong><span class="spanDesconto">?</span></strong></li>
                                <li>Valor total: <strong><small>R$ </small></strong><strong><span class="spanTotal">?</span></strong></li>
                            </ul>
                        </div>
                        
                        <div class="col-md-12">
                            <h3>Opções do plano</h3>
                            <span>Selecione abaixo quais são os dias que você irá escolher para a vinculação do plano.
                            A duração do plano é de 24 horas a partir do dia escolhido. Você pode escolher um prazo máximo de 2 meses.
                            Após confirmar todos os dias restante, clique no botão <span class="text-muted">Salvar e prosseguir <i class="fa fa-arrow-right"></i></span>.</span>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="text-center" style="margin-bottom: 15px;">
                                <p id="pSemanaEsgotado" class="lead" style="margin-bottom: 0px; display: none;">
                                    Todos os dias semanais foram escolhidos.
                                </p>
                                <p id="pFsEsgotado" class="lead" style="margin-bottom: 0px; display: none;">
                                    Todos os dias de fim de semana foram escolhidos.
                                </p>
                                <p id="pEspecialEsgotado" class="lead" style="margin-bottom: 0px; display: none;">
                                    Todos os dias foram escolhidos.
                                </p>
                                <p class="layoutDiasSemanal" class="lead" style="margin-bottom: 0px; display: none;">
                                    Você ainda pode escolher <strong id="spanDiasRestanteSemanal">?</strong> dia<span class="spanDiasPlural">s</span> de segunda à sexta.
                                </p>
                                <p class="layoutDiasFds" class="lead" style="margin-bottom: 0px; display: none;">
                                    Você ainda pode escolher <strong id="spanDiasRestanteFs">?</strong> dia<span class="spanDiasPlural">s</span> de sábado à domingo.
                                </p>
                                <p class="layoutDiasEspecial" class="lead" style="margin-bottom: 0px; display: none;">
                                    Você ainda pode escolher <strong id="spanDiasRestanteEspecial">?</strong> dia<span class="spanDiasPlural">s</span> de segunda à domingo.
                                </p>
                                <small style="color:darkred;">Marque/desmarque os dias escolhidos clicando no calendário abaixo.</small>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-6 col-12">
                            <div class="text-center">
                                <p class="lead"><strong><?php echo nomeMes($mesAtual); ?></strong></p>
                            </div>
                            <table class="table table-bordered text-center calendario">
                                <thead>
                                    <tr>
                                        <td><strong>Seg</strong></td>
                                        <td><strong>Ter</strong></td>
                                        <td><strong>Qua</strong></td>
                                        <td><strong>Qui</strong></td>
                                        <td><strong>Sex</strong></td>
                                        <td><strong>Sab</strong></td>
                                        <td><strong>Dom</strong></td>
                                    </tr>
                                </thead>
                                <tbody
                                    
                                    <tr>
                                        
                                    <?php
                                    
                                        $aux = date('w', strtotime($anoAtual.'-'.$mesAtual.'-1'));
                                        
                                        if($aux != 1){
                                            if($aux == 0){
                                                $aux = 7;
                                            }
                                            $aux--;
                                            for($i = 0; $i<$aux; $i++){
                                                $mesPassado = cal_days_in_month(CAL_GREGORIAN,($mesAtual-1==0?12:$mesAtual-1),($mesAtual-1==0?$anoAtual-1:$anoAtual));
                                                $mesPassado++;
                                                $mesPassado = $mesPassado - $aux;
                                                ?>
                                                    <td class="calendario-muted calendario-muted2" data="<?php echo $anoAtual."-".$mesAtual."-".$i; ?>">
                                                <?php echo $mesPassado+$i; ?></td> <?php
                                                
                                            }
                                        }
                                        
                                        if(date('w', strtotime($anoAtual.'-'.$mesAtual.'-1')) == 1){
                                            $aux = 1;
                                        }else{
                                            $aux++;
                                        }
                                        
                                        $diaAtual = date('d');
                                        for($i = 0; $i<$diasMesAtual; $i++){
                                            $class = ($i+1 <= $diaAtual?'class="calendario-muted"':'');
                                            
                                            ?>
                                                <td <?php echo $class; ?>  data="<?php echo $anoAtual."-".$mesAtual."-".$i ?>"><?php echo $i+1; ?></td>
                                            <?php
                                            
                                            if($aux < 7){
                                                $aux++;
                                            }else{
                                                $aux = 1;
                                                ?>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                        
                                        $aux--;
                                        if($aux != 0){
                                            for($i = 0; 7-$aux; $i++){
                                                ?> <td class="calendario-muted calendario-muted2" data="<?php echo $anoAtual."-".$mesAtual."-".$i ?>"><?php echo $i+1; ?></td> <?php
                                                if($aux < 7){
                                                $aux++;
                                                }else{
                                                    $aux = 1;
                                                    ?> </tr> <?php
                                                }
                                            }
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="col-md-6 col-lg-6 col-12">
                            <div class="text-center">
                                <p class="lead"><strong><?php echo nomeMes(($mesAtual+1==13?1:$mesAtual+1)); ?></strong></p>
                            </div>
                            <table class="table table-bordered text-center calendario">
                                <thead>
                                    <tr>
                                        <td><strong>Seg</strong></td>
                                        <td><strong>Ter</strong></td>
                                        <td><strong>Qua</strong></td>
                                        <td><strong>Qui</strong></td>
                                        <td><strong>Sex</strong></td>
                                        <td><strong>Sab</strong></td>
                                        <td><strong>Dom</strong></td>
                                    </tr>
                                </thead>
                                <tbody
                                    
                                    <tr>
                                        
                                    <?php
                                    
                                        $anoAtual = ($mesAtual+1==13?$anoAtual+1:$anoAtual);
                                        $mesAtual = ($mesAtual+1==13?1:$mesAtual+1);
                                        $diasMesAtual = cal_days_in_month(CAL_GREGORIAN,$mesAtual,$anoAtual);
                                        
                                        $aux = date('w', strtotime($anoAtual.'-'.$mesAtual.'-1'));
                                        
                                        if($aux != 1){
                                            if($aux == 0){
                                                $aux = 7;
                                            }
                                            $aux--;
                                            for($i = 0; $i<$aux; $i++){
                                                $mesPassado = cal_days_in_month(CAL_GREGORIAN,($mesAtual-1==0?12:$mesAtual-1),($mesAtual-1==0?$anoAtual-1:$anoAtual));
                                                $mesPassado++;
                                                $mesPassado = $mesPassado - $aux;
                                                ?>
                                                    <td class="calendario-muted calendario-muted2" data="<?php echo $anoAtual."-".$mesAtual."-".$i ?>">
                                                <?php echo $mesPassado+$i; ?></td> <?php
                                                
                                            }
                                        }
                                        
                                        if(date('w', strtotime($anoAtual.'-'.$mesAtual.'-1')) == 1){
                                            $aux = 1;
                                        }else{
                                            $aux++;
                                        }
                                        
                                        $diaAtual = date('d');
                                        for($i = 0; $i<$diasMesAtual; $i++){
                                            ?>
                                                <td data="<?php echo $anoAtual."-".$mesAtual."-".$i ?>"><?php echo $i+1; ?></td>
                                            <?php
                                            
                                            if($aux < 7){
                                                $aux++;
                                            }else{
                                                $aux = 1;
                                                ?>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                        
                                        $aux--;
                                        if($aux != 0){
                                            for($i = 0; 7-$aux; $i++){
                                                ?> <td class="calendario-muted calendario-muted2" data="<?php echo $anoAtual."-".$mesAtual."-".$i ?>"><?php echo $i+1; ?></td> <?php
                                                if($aux < 7){
                                                $aux++;
                                                }else{
                                                    $aux = 1;
                                                    ?> </tr> <?php
                                                }
                                            }
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                        
                        
                        <div class="col-md-12 text-center" style="margin-top: 20px;">
                            <button class="btn btn-warning btnSalvarCalendario">Salvar e prosseguir <i class="fa fa-arrow-right"></i></button>
                        </div>
                        
                        
                        
                    </div>
                    
                    <div id="divSucessoContratacao" style="display: none;">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <h5><i class="fa fa-check-square-o fa-3x"></i><strong> &nbsp; Contratação de plano realizado com sucesso!</strong></h5>
                                    <p style="font-size: 16px;">O plano contratado entrará em vigor a partir das 00:00 (meia-noite) da data selecionada até as 23:59 do mesmo dia.</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                Acompanhe o andamento do seu anúncio no <a href="relatorios_e_informacoes.php">painel de relatórios</a>.<br>
                                Dúvidas ou mais informações <a href="entrar_em_contato.php">entre em contato</a> conosco.
                            </div>
                        </div> 
                        
                    </div>
                    
                    <div id="divErroContratacao" style="display: none;">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <h5><i class="fa fa-close fa-3x"></i><strong> &nbsp; Erro ao realizar contratação do plano</strong></h5>
                                    <p style="font-size: 16px;">Ocorreu um problema ao contratar o plano escolhido.<br>Por favor, tente novamente mais tarde. Se o problema persistir entre em contato com nossa equipe de suporte.</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                Dúvidas ou mais informações <a href="entrar_em_contato.php">entre em contato</a> conosco.
                            </div>
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
            $("#a_planos_para_anuncios").addClass("active-menu");
        </script>
        
        <script src="../javascript/planos_para_anuncios.js"></script>
    </body>
</html>
