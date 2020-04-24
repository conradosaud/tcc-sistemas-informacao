<?php
    session_start();
    include_once("../php/funcoes_painel.php");
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
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>
            
            
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><i class="fa fa-envelope"></i> &nbsp; Entrar em contato</h2>  
                            <h5 style="font-size: 16px;">Gostaria de entrar em contato com nossa equipe de desenvolvimento? Utilize o formulário abaixo para enviar uma mensagem para nós, o responderemos o mais rápido possível.</h5>
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                    <hr />
                    
                    <div class="row">
                        <div class="col-md-12">
                            <p class="lead">Dúvidas ou informações sobre o sistema? <a href="duvidas_e_ajuda.php">Clique aqui</a>.</p>
                        </div>
                        <div class="col-md-12">
                            <p>Utilize o formulário abaixo para enviar uma mensagem para nós. Lembre-se de inserir um endereço de email válido, pois será onde lhe retornaremos sua resposta.</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <form role="form">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Seu email</label>
                                    <input class="form-control" placeholder="Digite seu email" type="email" required="true"/>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Assunto</label>
                                    <select class="form-control">
                                        <option>Suporte Técnico</option>
                                        <option>Comercial</option>
                                        <option>Sugestões</option>
                                        <option>Problemas ou erros</option>
                                        <option>Dúvidas</option>
                                        <option>Outro...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mensagem</label>
                                    <textarea placeholder="Digite sua mensagem aqui..." class="form-control" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar <i class="fa fa-send"></i></button>
                            </div>
                        </form>
                    </div>
                    
                </div>
                    
                    
            </div>
                <!-- /. PAGE INNER  -->
        </div>
            <!-- /. PAGE WRAPPER  -->
        <!-- /. WRAPPER  -->
        
        <?php
            include_once("./fixo/scripts.php");
        ?>
        
        <script>
            $("#a_entrar_em_contato").addClass("active-menu");
        </script>
        
   
    </body>
</html>
