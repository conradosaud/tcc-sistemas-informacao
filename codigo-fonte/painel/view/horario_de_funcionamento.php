<?php
    session_start();
    include_once("../php/funcoes_painel.php");
    include_once("../php/funcoes_horario_de_funcionamento.php");
    $objHorarios = busca();
    //var_dump($objHorarios);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
        <link href="../css/horario_de_funcionamento.css" rel="stylesheet" />
    </head>
    <body id="viewHorarioDeFuncionamento">
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>
            
            
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><i class="fa fa-list"></i> &nbsp; Editar Horário de Funcionamento</h2>  
                            <h5 style="font-size: 16px;">Informe os dias e horários que seu negócio está em funcionamento, desta forma podemos otimizar nossos motores de busca e orientar os visitantes.</h5>
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
                                            <li>
                                                <span id="porcentagemDias">Preencha ao menos <strong>dois</strong> dias da semana em que seu estabeleciomento está aberto</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <!--   Kitchen Sink -->
                            <div class="panel panel-default">
                                <div class="panel-heading text-right">
                                    <button href="#" id="btnSalvar" class="btn btn-success"><i class="fa fa-save"></i> Salvar alterações</button>
                                </div>
                                <div class="panel-body">
                                    <div id="errosForm"></div>
                                    <a href="#" id="btnDesabilitaTodos"><i class="fa fa-repeat"></i> Resetar formulário</a>
                                    <div class="table-responsive" style="margin-top: 5px;">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Dia</th>
                                                    <th>Aberto</th>
                                                    <th>Das</th>
                                                    <th>Às</th>
                                                    <th>24 horas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="trSegunda" >
                                                    <td><strong>Segunda</strong></td>
                                                    <td><label><input type="checkbox" class="formAberto"/> Sim</label></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><label><input type="checkbox" class="formTodo"/> Sim</label></td>
                                                </tr>
                                                <tr id="trTerca">
                                                    <td><strong>Terça</strong></td>
                                                    <td><label><input type="checkbox" class="formAberto"/> Sim</label></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><label><input type="checkbox" class="formTodo"/> Sim</label></td>
                                                </tr>
                                                <tr id="trQuarta">
                                                    <td><strong>Quarta</strong></td>
                                                    <td><label><input type="checkbox" class="formAberto"/> Sim</label></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><label><input type="checkbox" class="formTodo"/> Sim</label></td>
                                                </tr>
                                                <tr id="trQuinta">
                                                    <td><strong>Quinta</strong></td>
                                                    <td><label><input type="checkbox" class="formAberto"/> Sim</label></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><label><input type="checkbox" class="formTodo"/> Sim</label></td>
                                                </tr>
                                                <tr id="trSexta">
                                                    <td><strong>Sexta</strong></td>
                                                    <td><label><input type="checkbox" class="formAberto"/> Sim</label></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><label><input type="checkbox" class="formTodo"/> Sim</label></td>
                                                </tr>
                                                <tr id="trSabado">
                                                    <td><strong>Sábado</strong></td>
                                                    <td><label><input type="checkbox" class="formAberto"/> Sim</label></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><label><input type="checkbox" class="formTodo"/> Sim</label></td>
                                                </tr>
                                                <tr id="trDomingo">
                                                    <td><strong>Domingo</strong></td>
                                                    <td><label><input type="checkbox" class="formAberto"/> Sim</label></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><select disabled="true" class="form-control"><option></option><option>00:00</option><option>00:30</option><option>01:00</option><option>01:30</option><option>02:00</option><option>02:30</option><option>03:00</option><option>03:30</option><option>04:00</option><option>04:30</option><option>05:00</option><option>05:30</option><option>06:00</option><option>06:30</option><option>07:00</option><option>07:30</option><option>08:00</option><option>08:30</option><option>09:00</option><option>09:30</option><option>10:00</option><option>10:30</option><option>11:00</option><option>11:30</option><option>12:00</option><option>12:30</option><option>13:00</option><option>13:30</option><option>14:00</option><option>14:30</option><option>15:00</option><option>15:30</option><option>16:00</option><option>16:30</option><option>17:00</option><option>17:30</option><option>18:00</option><option>18:30</option><option>19:00</option><option>19:30</option><option>20:00</option><option>20:30</option><option>21:00</option><option>21:30</option><option>22:00</option><option>22:30</option><option>23:00</option><option>23:30</option></select></td>
                                                    <td><label><input type="checkbox" class="formTodo"/> Sim</label></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="panel-footer text-right">
                                    <button id="btnSalvarProsseguir" class="btn btn-primary">Salvar e prosseguir <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <!-- End  Kitchen Sink -->
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
            $("#a_horarios_de_funcionamento").addClass("active-menu");
            $(".nav-second-level").addClass("in");
        </script>
        
        <script src="../javascript/horario_de_funcionamento.js"></script>
    </body>
</html>
