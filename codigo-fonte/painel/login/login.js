
$(document).ready(function(){if($("#viewLogin").is(":visible")){
    console.log("jQuery operando na view painel_de_acesso.php e painel_de_cadastro.php");
    // --------------------------------------------------------
    
    /* Glossário
     * 
     * 
     */
    
    // variaveis globais
    var mainForm = "";
    var mainFormNome = "";
    
    // função chamada quando se inicia o script
    function iniciaScript(){//iniciaScript-sumario
        
    }
    
    // --------------------------------------------------------
    /* Operações gerais */
    
    function enviaAjaxLogin(cadastro){
        var form;
        if(cadastro){
            form = "hiddenAcessarPainel=true&txtEmailLogin="+cadastro.email+"&txtSenhaLogin="+cadastro.senha;
        }else{
            form = $("#formLogin").serialize();
        }
        console.log(form);
        //var manterConectado = $("#cboxManterConectado").is(":checked");
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_login.php',
            data: form,
            success: function (data) {
                console.log(data);
                if(data == "ok"){
                    if(cadastro){
                        window.location.href = "../view/painel_de_empresas.php?tutorialP=1";
                    }else{
                        window.location.href = "../view/painel_de_empresas.php";
                    }
                }else{
                    mostraErroLogin();
                    return;
                }
            },
            error: function (data) {
                console.log("ERRO [645]");
                console.log(data);
                var erro = "<strong>Erro 645</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte."
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                $("#btnAcessarPainel").removeProp("disabled");
            }
        });
    }
    
    function enviaAjaxCadastro(){
        var form = $("#formCadastro").serialize();
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_login.php',
            data: form,
            success: function (data) {
                console.log(data);
                if(data == "ok"){
                    var cadastro = {email:$("#txtEmailCad").val(),senha:$("#txtSenhaCad").val()};
                    enviaAjaxLogin(cadastro);
                }else if(data == "emailExistente"){
                    mostraErrosEmail();
                }else{
                    mostraDialogo("<strong>Erro ao cadastrar-se:</strong> verifique os valores digitados e tente novamente.", "danger", 3000);
                }
            },
            error: function (data) {
                console.log("ERRO [331]");
                console.log(data);
                var erro = "<strong>Erro 331</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte."
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                $("#btnCadastrar").removeProp("disabled");
            }
        });
    }
    
    
    // --------------------------------------------------------
    /* Mensagens de erro e sucesso */
    
    // mostra mensagem de erro ao logar
    function mostraErroLogin(){
        $("#alertDadosIncorretos").fadeIn(200);
    }
    
    function mostraErrosCadastro(erros){
        $("#alertCamposInvalidos").fadeIn(200);
        
        var html = "";
        html += "<ul class='list-nospacing'>";
        for (var i = 0; i < erros.length; i++) {
            html += "<li>"+erros[i]+"</li>";
        }
        html += "</ul>";
        
        $("#errosCamposInvalidos").html(html);
    }
    
    function mostraErrosEmail(){
        $("#alertCamposInvalidos").fadeIn(200);
        
        var html = "O email que você está tentando cadastrar já consta registrado em nosso sistema.<br>";
        html += "Se você já possui uma conta <a href='painel_de_acesso.php'>clique aqui</a> para acessá-la, ";
        html += "ou <a href='#'>clique aqui</a> caso você tenha esquecido sua senha.";
        
        $("#errosCamposInvalidos").html(html);
    }
    
    // --------------------------------------------------------
    /* Validadores de formulários */
    
    // valida o formulario de login
    function validaFormLogin(){
        var erros = false;
        
        var email = $("#txtEmailLogin").val();
        var senha = $("#txtSenhaLogin").val();

        if(email.length < 1 || senha.length < 1){
            erros = true;
        }
        
        return erros;
    }
    
    function validaFormCadastro(){
        
        var erros = [];
        
        var nome = $("#txtNomeCad").val();
        var email = $("#txtEmailCad").val();
        var senha = $("#txtSenhaCad").val();
        var senhaConfirma = $("#txtSenhaConfirmaCad").val();
        
        if(nome.trim().length < 5){
            erros.push("O valor inserido no campo <strong>Nome completo</strong> é muito curto.");
        }
        if(!validaEmail(email)){
            erros.push("O valor inserido no campo <strong>Email</strong> é invalido.");
        }
        if(senha.trim().length < 3){
            erros.push("A senha inserida é muito curta. Escolha uma senha mais forte.");
        }
        if(senha != senhaConfirma){
            erros.push("As senhas digitadas não são iguais. Escolha uma senha que você possa se lembrar sempre.");
        }
        
        return erros;
    }
    
    // --------------------------------------------------------
    /* Operações com formulários */

    
    // -----------------------------------------------------------
    /* Operações com cliques e botões */
    
    $("#btnAcessarPainel").click(function(){
        $(this).prop("disabled",true);

        var erros = validaFormLogin();  
        if(erros){
            mostraErroLogin();
            $(this).removeProp("disabled");
            return;
        }else{
            enviaAjaxLogin();
        }
    });
    
    $("#btnCadastrar").click(function(){
        $(this).prop("disabled",true);
        
        var erros = validaFormCadastro();
        if(erros.length >= 1){
            mostraErrosCadastro(erros);
            $(this).removeProp("disabled");
            return;
        }else{
            enviaAjaxCadastro();
        }
    });
    
    
    // -----------------------------------------------------------
    
    iniciaScript();
    
}});