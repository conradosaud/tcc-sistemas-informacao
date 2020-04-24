
$(document).ready(function(){if($("#viewPainelDeEmpresas").is(":visible")){
    console.log("jQuery operando na view painel_de_empresas.php");
    // --------------------------------------------------------
    
    /* Glossário
     * 
     * 
     */
    
    // variaveis globais
    var tutorial = 1;
    var ultimoId = 0;
    
    // função chamada quando se inicia o script
    function iniciaScript(){//iniciaScript-sumario
        if (typeof tutorialP != "undefined") {
            iniciaTutorial();
        }
    }
    
    // --------------------------------------------------------
    /* Operações gerais */
    
    function enviaAjaxSair(){
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_painel_de_empresas.php',
            data: "Logout=true",
            success: function (data) {
                mostraDialogo("Você foi desconectado.", "info");
                window.location.href = "../login/painel_de_acesso.php";
            },
            error: function (data) {
                console.log("ERRO [867]");
                console.log(data);
                var erro = "<strong>Erro 867</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            }
        });
    }
    
    function enviaAjaxExcluir(){
        var idEmpresa = $("#hiddenEmpresaExcluir").val();
        var senha = $("#txtSenhaExcluir").val();
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_painel_de_empresas.php',
            data: "txtSenhaExcluir="+senha+"&hiddenEmpresaExcluir="+idEmpresa,
            success: function (data) {
                console.log(data);
                if(data){
                    location.reload();
                }else{
                    $("#alertSenhaExcluir").show();
                }
            },
            error: function (data) {
                console.log("ERRO [991]");
                console.log(data);
                var erro = "<strong>Erro 991</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                $("button[name=btnExcluirConfirma]").removeProp("disabled");
            }
        });
    }
    
    function enviaAjaxCadastro(){
        var nomeEmpresa = $("#txtNomeEmpresa").val();
        var seguimento = $("#selectSeguimento :selected").text();
        var cidade = $("#selectCidade :selected").text();
        var email = $("#txtEmailEmpresa").val();
        var site = $("#txtSiteEmpresa").val();
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_painel_de_empresas.php',
            data: "txtEmailEmpresa="+email+"&txtSiteEmpresa="+site+"&txtNomeEmpresa="+nomeEmpresa+"&selectSeguimento="+seguimento+"&selectCidade="+cidade+"&hiddenCadastrarEmpresa=true",
            success: function (data) {
                console.log(data);
                if(data != "false"){
                    ultimoId = data;
                    
                    if($("#textoTutorial").is(":visible")){
                        tutorial++;
                        proximoTutorial();
                        return;
                    }

                    window.location.href = "../php/funcoes_painel.php?IdEmpresa="+ultimoId;
                    
                }else{
                    var erro = "<strong>Erro ao cadastrar empresa: </strong>";
                    erro += "verifique os valores digitados e tente novamente.";
                    mostraDialogo(erro, "danger", 6000);
                }
                //mostraDialogo("Você foi desconectado.", "info");
                //window.location.href = "../login/painel_de_acesso.php";
            },
            error: function (data) {
                console.log("ERRO [328]");
                console.log(data);
                var erro = "<strong>Erro 328</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function (){
                $("#btnSalvarCadastrar").removeProp("disabled");
            }
        });
    }
    
    function enviaAjaxInfo(){
        var nomeCompleto = $("#txtNomeCompleto").val();
        var emailAcesso = $("#txtEmailAcesso").val();
        var telefone = $("#txtTelefoneContato").val();
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_painel_de_empresas.php',
            data: "hiddenCliente=true&NomeCompleto="+nomeCompleto+"&Email="+emailAcesso+"&Telefone1="+telefone,
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    mostraDialogo("<strong>Informações atualizadas com sucesso!</strong><br>Suas informações de perfil foram atualizaram e entrarão em vigor na próxima vez que você acessar o painel.", "success", 6000);
                    $("#modalEditarInfo").modal("hide");
                }else{
                    var erro = "<strong>Erro ao alterar informações: </strong>";
                    erro += "verifique os valores digitados e tente novamente.";
                    mostraDialogo(erro, "danger", 6000);
                }
            },
            error: function (data) {
                console.log("ERRO [329]");
                console.log(data);
                var erro = "<strong>Erro 328</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                $("#btnSalvarInfo").removeProp("disabled");
            }
        });
    }
    
    function enviaAjaxSenha(){
        var senhaAtual = $("#txtSenhaAtual").val();
        var novaSenha = $("#txtSenhaNova").val();
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_painel_de_empresas.php',
            data: "hiddenSenha=true&SenhaAtual="+senhaAtual+"&SenhaNova="+novaSenha,
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    mostraDialogo("<strong>Senha alterada com sucesso!</strong><br>Sua senha foi alterada, a partir de agora, utilize sua nova senha para acessar o painel.", "success", 4400);
                    $("#modalAlterarSenha").modal("hide");
                }else{
                    mostraErros(["A senha digitada em <strong>Senha Atual</strong> está incorreta."], $("#errosFormAlterarSenha"));
                }
            },
            error: function (data) {
                console.log("ERRO [327]");
                console.log(data);
                var erro = "<strong>Erro 327</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                $("#btnSalvarAlterarSenha").removeProp("disabled");
                $("#txtSenhaAtual").val("");
                $("#txtSenhaNova").val("");
                $("#txtSenhaNovaConfirma").val("");
            }
        });
    }
    
    
    // --------------------------------------------------------
    /* Validadores de formulários */
    
    function validaFormCadastro(){
        
        var erros = [];
        
        var nomeEmpresa = $("#txtNomeEmpresa").val();
        var seguimento = $("#selectSeguimento :selected").text();
        var cidade = $("#selectCidade :selected").text();
        var site = $("#txtSiteEmpresa").val();
        var email = $("#txtEmailEmpresa").val();
        
        if(nomeEmpresa.trim().length < 4){
            erros.push("O valor inserido em <strong>Razão social ou nome fantasia</strong> é muito curto.");
        }
        if(seguimento.trim() == "Selecione"){
            erros.push("Selecione uma opção em <strong>Seguimento</strong>.");
        }
        if(cidade.trim() == "Selecione"){
            erros.push("Selecione uma opção em <strong>Cidade</strong>.");
        }
        if(site){
            if(site.indexOf("acebook") != -1 || site.indexOf("oogle") != -1){
                erros.push("Insira seu site apenas se possuir um dominio próprio. Sua página do Facebook pode ser vinculada com nossos serviços mais tarde.");
            }
        }
        if(email){
            if(!validaEmail(email)){
                erros.push("Insira um endereço de email válido.");
            }
        }
        
        return erros;
    }
    
    function validaFormInfo(){
        var erros = [];
        
        var nomeCompleto = $("#txtNomeCompleto").val();
        var emailAcesso = $("#txtEmailAcesso").val();
        
        if(nomeCompleto.trim().length < 4){
            erros.push("O valor inserido em <strong>Nome completo</strong> é muito curto.");
        }
        if((emailAcesso.trim().length < 5) || (emailAcesso.indexOf("@") == -1) || (emailAcesso.indexOf(".") == -1)){
            erros.push("O valor inserido no campo <strong>Email de acesso</strong> é invalido.");
        }
        
        return erros;
    }
    
    function validaFormSenha(){
        var erros = [];
        
        var senhaAtual = $("#txtSenhaAtual").val();
        var senhaNova = $("#txtSenhaNova").val();
        var senhaNovaConfirma = $("#txtSenhaNovaConfirma").val();
        
        if(senhaAtual.trim().length < 3){
            erros.push("O valor inserido em <strong>Senha atual</strong> é muito curto.");
        }
        if(senhaNova.trim().length < 3){
            erros.push("O valor inserido em <strong>Nova senha</strong> é muito curto.");
        }
        if(senhaAtual.trim() == senhaNova.trim()){
            erros.push("Insira uma senha diferente da que você possui agora.");
        }
        if(senhaNovaConfirma.trim() != senhaNova.trim()){
            erros.push("As as novas senhas digitadas não são iguais. Tenha certeza de escolher uma senha que você possa sempre se lembrar.");
        }
        
        return erros;
    }
    
    function mostraErros(erros, form){
        if(form){
            var html = "";
            html += '<div class="alert alert-danger">';
            html += '   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
            html += '   <span class="fa fa-info-circle"></span> <strong>Erro ao salvar:</strong> um ou mais campos não foram preenchidos corretamente.';
            html += '   <ul class="lista-comum">';

            for (var i = 0; i < erros.length; i++) {
                html += ' <li>'+erros[i]+'</li>';
            }

            html += '   </ul>';
            html += '</div>';

            form.html(html);
        }else{
            $("#alertCadastroEmpresa").fadeIn(200);

            var html = "";
            html += "<ul class='list-nospacing'>";
            for (var i = 0; i < erros.length; i++) {
                html += "<li>"+erros[i]+"</li>";
            }
            html += "</ul>";

            $("#alertaCadastoEmpresa-erros").html(html);
        }
    }
    
    // --------------------------------------------------------
    /* Operações com tutorial */
    
    function animarRolagem(div, tempo){
        $('html, body').animate({
            scrollTop: $(div).offset().top
        }, tempo);
    }
    
    function criaBoxTutorial(titulo, texto, botao){
        var html = "";
        
        html += '<div class="row textoTutorial" id="textoTutorial">';
        html +=    '<div class="col-md-12">';
        html +=        '<a href="#" class="close" id="btnSairTutorial"><i class="fa fa-close"></i></a>';
        html +=        '<span style="opacity: 0.6">Etapa '+(tutorial+1)+' de 4</span>';
        html +=        '<h3 style="margin-top:5px;">'+titulo+'</h3>';
        html +=        '<p>'+texto+'</p>';
        html +=    '</div>';
        if(botao){
            html +=    '<div class="col-md-12 text-right">';
            html +=        '<a href="#" class="btn btn-branco btn-tutorial" style="text-shadow: none;">Prosseguir <i class="fa fa-arrow-right"></i></a>';
            html +=    '</div>';
        }
        html += '</div>';
        
        return html;
    }
    
    function proximoTutorial(){
        $("#textoTutorial").remove();
        $(".tutorial-evidencia").removeClass("tutorial-evidencia");
        $(".btn").attr("disabled", true);
        
        var titulo = "";
        var texto = "";
        var html = "";
        
        switch(tutorial){
            case 0:
                titulo = "Painel de Empresas";
                texto = "Este é o painel onde você pode acessar seus devidos paineis de edição, cadastrar novas empresas e exclui-las se desejar. Cada empresa possui um anúncio.";
                html = criaBoxTutorial(titulo, texto, true);
                $("#divPainel").addClass("tutorial-evidencia");
                $("#divPainel").before(html);
                $("#textoTutorial").hide().fadeIn(2000);
                animarRolagem("#textoTutorial", 2000);
                break;
            case 1:
                titulo = "Cadastrar Nova Empresa";
                texto = "Clique no botão <strong> <i class='fa fa-plus'></i> Cadastrar novo</strong> para criar sua primeira empresa na plataforma e dar início ao seu futuro anúncio.";
                html = criaBoxTutorial(titulo, texto);
                $("#btnCadastrarNovo").addClass("btn-tutorial");
                $("#btnCadastrarNovo").addClass("tutorial-evidencia");
                $("#btnCadastrarNovo").before(html);
                $("#btnCadastrarNovo").removeAttr("disabled");
                $("#textoTutorial").hide().fadeIn(1000);
                animarRolagem("#textoTutorial", 2000);
                break;
            case 2:
                titulo = "Faça seu registro";
                texto = "Complete as informações do formulário de acordo com sua empresa. Essas informações ficarão apenas no painel interno, elas não aparecerão para seus visitantes.<br>Ao terminar de preencher, clique no botão <strong>Salvar e cadastrar <i class='fa fa-save'></i></strong> para finalizar.";
                html = criaBoxTutorial(titulo, texto);
                $("#divCadastrarNovo").show();
                $("#divCadastrarNovo").addClass("tutorial-evidencia");
                $("#divCadastrarNovo").before(html);
                $("#btnSalvarCadastrar").removeAttr("disabled");
                $("#textoTutorial").hide().fadeIn(1000);
                animarRolagem("#textoTutorial", 2000);
                break;
            case 3:
                titulo = "Registro realizado com sucesso!";
                texto = "A partir de agora, sempre que você entrar acessar nosso painel, você será direcionado diretamente para o painel de anúncios enquanto tiver apenas uma empresa.<br>Clique no botão <strong>Prosseguir <i class='fa fa-arrow-right'></i> para começarmos a montar seu anúncio que será visitado por milhares de pessoas!</strong>";
                html = criaBoxTutorial(titulo, texto, true);
                $("#divPainel").remove();
                $(".tutorial").removeClass("tutorial");
                $("#textoLogo").after(html);
                $("#textoTutorial").css("width", "100%");
                $("#textoTutorial").hide().fadeIn(2000);
                animarRolagem("#textoTutorial", 2000);
                break;
            case 4:
                window.location.href = "../php/funcoes_painel.php?IdEmpresa="+ultimoId+"&tutorial=1";
                break;
            default:
                finalizaTutorial();
        }
    }
    
    function finalizaTutorial(){
        window.location.href = "../view/painel_de_empresas.php";
    }
    
    function iniciaTutorial(){
        tutorial = 0;
        $("#tutorial").addClass("tutorial");
        $("#tutorial").show();
        
        $(".btn").attr("disabled", "true");
        
        proximoTutorial();
    }
    
    // -----------------------------------------------------------
    /* Operações com cliques e botões */
    
    $("#btnCadastrarNovo").click(function(e){
        e.preventDefault();
        if($("#textoTutorial").is(":visible")){
            tutorial++;
            proximoTutorial();
            return;
        }
        
        if($("#divCadastrarNovo").is(":visible")){
            $("#divCadastrarNovo").slideUp(200);
            return;
        }
        $("#divCadastrarNovo").slideDown(200); 
        if($("#hiddenEmpresasJaCadastradas").val().length > 1){
            $("#alertAvisoCadastro").show();
       }
    });
    
    $("#btnCancelarVoltar").click(function(e){
        e.preventDefault();
        $("#divCadastrarNovo").slideUp(200);
    });
    
    $("#btnSalvarCadastrar").click(function(){
        $("#btnSalvarCadastrar").prop("disabled",true);

        var erros = validaFormCadastro();
        if(erros.length > 0){
            mostraErros(erros);
            $("#btnSalvarCadastrar").removeProp("disabled");
        }else{
            enviaAjaxCadastro();
        }
    });
    
    $(".btnSair").click(function(e){
        e.preventDefault(); 
        enviaAjaxSair();
    });
    
    $(".btnExcluir").click(function(e){
        e.preventDefault(); 
        console.log($(this).attr("rel-nome"));
        $("#modalExcluir").modal().show();
        $("#hiddenEmpresaExcluir").val($(this).attr("name"));
        $("#pNomeEmpresaExcluir").text($(this).attr("rel-nome"));
        
    });
    
    $("button[name=btnExcluirConfirma]").click(function(){
        $("button[name=btnExcluirConfirma]").prop("disabled",true);
        if($("#txtSenhaExcluir").val().length < 2){
            $("#alertSenhaExcluir").show();
            $("button[name=btnExcluirConfirma]").removeProp("disabled");
        }else{
            enviaAjaxExcluir();
        }
    });
    
    $(".close-tutorial").click(function(e){
        $("#modalSairTutorial").modal("show");
    });
    
    $(document).on('click', '.btn-tutorial', function(e){ 
        e.preventDefault();
        tutorial++;
        proximoTutorial();
    });
    
    $(".btn").click(function(e){
        if($("#textoTutorial").is(":visible")){
            if($(this).hasClass(".btn-tutorial") == false){
                e.preventDefault();
                return false;
            }
        }
    });
    
    $("#btnEditarInformacoes").click(function(e){
        e.preventDefault();
        $("#modalEditarInfo").modal("show");
    });
    $("#btnAlterarSenha").click(function(e){
        e.preventDefault();
        $("#modalAlterarSenha").modal("show");
    });
    
    $("#btnSalvarInfo").click(function(){
        $("#btnSalvarInfo").prop("disabled",true);
        
        var erros = validaFormInfo();
        if(erros.length > 0){
            mostraErros(erros, $("#errosFormEditarInfo"));
            $("#btnSalvarInfo").removeProp("disabled");
        }else{
            enviaAjaxInfo();
        }
    });
    $("#btnSalvarAlterarSenha").click(function(){
        $("#btnSalvarAlterarSenha").prop("disabled",true);
        
        var erros = validaFormSenha();
        if(erros.length > 0){
            mostraErros(erros, $("#errosFormAlterarSenha"));
            $("#btnSalvarAlterarSenha").removeProp("disabled");
        }else{
            enviaAjaxSenha();
        }
    });
    
    $(document).on("click", "#btnSairTutorial", function(e){
        e.preventDefault();
        finalizaTutorial();
    });
    
    // -----------------------------------------------------------
    
    iniciaScript();
    
}});