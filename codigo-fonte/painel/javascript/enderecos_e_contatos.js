
$(document).ready(function(){if($("#viewEnderecosEContatos").is(":visible")){
    console.log("jQuery operando na view enderecos_e_contatos.php");
    // --------------------------------------------------------
    
    /* Glossário
     * 
     * 
     */
    
    // variaveis globais
    var obj;
    var form;
    var mainForm;
    var mainFormNome;
    
    // função chamada quando se inicia o script
    function iniciaScript(){//iniciaScript-sumario
        verificaPorcentagem();
    }
    
    // --------------------------------------------------------
    /* Operações gerais */
    
    function criaObj(){
        var emailCampo = $("#"+mainFormNome+" input[name=txtEmail]");
        var cepCampo = $("#"+mainFormNome+" input[name=txtCep]");var cidadeCampo = $("#"+mainFormNome+" input[name=txtCidade]");
        var ruaCampo = $("#"+mainFormNome+" input[name=txtRua]");var numeroCampo = $("#"+mainFormNome+" input[name=txtNumero]");
        var bairroCampo = $("#"+mainFormNome+" input[name=txtBairro]");var complementoCampo = $("#"+mainFormNome+" input[name=txtComplemento]");
        var telefone1Campo = $("#"+mainFormNome+" input[name=txtTelefone1]");var telefone2Campo = $("#"+mainFormNome+" input[name=txtTelefone2]");
        var celular1Campo = $("#"+mainFormNome+" input[name=txtCelular1]");var celular2Campo = $("#"+mainFormNome+" input[name=txtCelular2]");
        var celular1cboxCampo = $("#"+mainFormNome+" input[name=cboxCelular1]");var celular2cboxCampo = $("#"+mainFormNome+" input[name=cboxCelular2]");
        
        form = {email:emailCampo,cep:cepCampo,cidade:cidadeCampo,rua:ruaCampo,numero:numeroCampo,
        bairro:bairroCampo,complemento:complementoCampo,telefone1:telefone1Campo,telefone2:telefone2Campo,
        celular1:celular1Campo, celular2:celular2Campo, celular1cbox:celular1cboxCampo, celular2cbox:celular2cboxCampo};
        
        obj = {email:emailCampo.val(),cep:cepCampo.val(),cidade:cidadeCampo.val(),rua:ruaCampo.val(),numero:numeroCampo.val(),
        bairro:bairroCampo.val(),complemento:complementoCampo.val(),telefone1:telefone1Campo.val(),telefone2:telefone2Campo.val(),
        celular1:celular1Campo.val(), celular2:celular2Campo.val(),celular1cbox:celular1cboxCampo.prop("checked"), celular2cbox:celular2cboxCampo.prop("checked")};
    }
    
    function enviaAjaxAltera(prosseguir){
        var hidden = mainFormNome.substring(mainFormNome.indexOf("-")+1, mainFormNome.length);
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_enderecos_e_contatos.php',
            data: mainForm.serialize()+"&cboxCelular1-ajax="+obj.celular1cbox+"&cboxCelular2-ajax="+obj.celular2cbox+"&hiddenIdEndereco="+hidden,
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    if(prosseguir){
                        window.location.href = "../view/galeria_de_fotos.php";
                    }else{
                        if($("#hiddenIdEndereco").val()=="false"){
                            location.reload();
                        }else{
                            mostraDialogo("<strong>Informações salvas com sucesso!</strong><br>Verifique sua <strong>integração com o Google Maps</strong> e mantenha-a atualizada.", "success", 3000);
                        }
                    }
                }else{
                    var erro = "<strong>Erro ao cadastrar empresa: </strong>";
                    erro += "verifique os valores digitados e tente novamente.";
                    mostraDialogo(erro, "danger", 6000);
                }
            },
            error: function (data) {
                console.log("ERRO [911]");
                console.log(data);
                var erro = "<strong>Erro 911</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                window.setTimeout(function(){ $(".btnSalvar, .btnSalvarProsseguir").removeProp("disabled"); }, 2000);
            }
        });
    }
    
    function enviaAjaxCadastro(prosseguir){
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_enderecos_e_contatos.php',
            data: mainForm.serialize()+"&cboxCelular1-ajax="+obj.celular1cbox+"&cboxCelular2-ajax="+obj.celular2cbox+"&Cadastro=true",
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    if($(".tutorial").is(":visible")){
                        window.location.href = "../view/visao_geral.php?tutorial=1";
                        return;
                    }
                    if(prosseguir){
                        window.location.href = "../view/galeria_de_fotos.php";
                    }else{
                        location.reload();
                    }
                }else{
                    var erro = "<strong>Erro ao cadastrar empresa: </strong>";
                    erro += "verifique os valores digitados e tente novamente.";
                    mostraDialogo(erro, "danger", 6000);
                }
            },
            error: function (data) {
                console.log("ERRO [911]");
                console.log(data);
                var erro = "<strong>Erro 911</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                window.setTimeout(function(){ $(".btnSalvar, .btnSalvarProsseguir").removeProp("disabled"); }, 2000);
            }
        });
    }
    
    function enviaAjaxExclui(senha, id){
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_enderecos_e_contatos.php',
            data: "hiddenEmpresaExcluir=true&Senha="+senha+"&IdEndereco="+id,
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    location.reload();
                    $("#modalExcluir").modal("hide");
                }else{
                    $("#alertSenhaExcluir").slideDown(200);
                }
            },
            error: function (data) {
                console.log("ERRO [911]");
                console.log(data);
                var erro = "<strong>Erro 911</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                $("#btnExcluirConfirma").removeProp("disabled");
            }
        });
    }
    
    function mostraErros(erros){
        var html = "";
        html += '<div class="alert alert-danger">';
        html += '   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        html += '   <span class="fa fa-info-circle"></span> <strong>Erro ao salvar:</strong> você precisa preencher ao menos um campo principal para salvar.';
        html += '</div>';
        
        $(".errosForm").html(html);
    }
    
    function escondeErros(){
        $(".alert").remove();
    }
    
    
    // --------------------------------------------------------
    /* Validadores de formulários */
    
    function validaForm(){
        var erro = true;
        
        if(obj.email.length > 1){
            if(validaEmail(obj.email)){
                erro = false;
            }else{
                console.log("ta errado email");
                return true;
            }
        }
        if(obj.telefone1.length > 1){
            erro = false;
        }
        if(obj.celular1.length > 1){
            erro = false;
        }
        if(obj.cep.length > 1){
            if(obj.rua.length > 1 && obj.numero.length > 1 && obj.bairro.length > 1){
                erro = false;
            }else{
                erro = true;
            }
        }
        
        return erro;
    }
    
    function verificaPorcentagem(){
        var porcentagem = 0;
        
        if($(".formExistente").length){
            porcentagem += 100;
            $("#porcentagemEndereco").hide();
        }else{
            $("#porcentagemEndereco").show();
        }
        
        if(porcentagem == 100){
            $("div .progress-bar").removeClass("progress-bar-primary").addClass("progress-bar-success");
            $("div .progress").removeClass("progress-striped active");
            $(".spanItensRestantes").hide();
            $("div .progress").css("margin-bottom", "-10px");
        }else{
            $("div .progress-bar").removeClass("progress-bar-success").addClass("progress-bar-primary");
            $("div .progress").addClass("progress-striped active");
            $(".spanItensRestantes").show();
            $("div .progress").css("margin-bottom", "10px");
        }
        
        $(".spanPorcentagem").text(porcentagem);
        $("div .progress-bar").attr("aria-valuenow", porcentagem);
        $("div .progress-bar").css("width", porcentagem+"%");
    }
    
    
    // --------------------------------------------------------
    /* Operações com formulários */
    
    //Quando o campo cep perde o foco.
    $("input[name=txtCep]").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#txtRua").val("");
                $("#txtBairro").val("");
                //$("#cidade").val("...");
                //$("#uf").val("...");
                //$("#ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#txtRua").val(dados.logradouro);
                        $("#txtBairro").val(dados.bairro);
                        //$("#txtCidade").val(dados.localidade);
                        //$("#uf").val(dados.uf);
                        //$("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        mostraDialogo("<strong>CEP não encontrado.</strong><br>Nossos motores de busca não encontraram o endereço do seu CEP. Favor digitá-lo manualmente.", "warning", 4000);
                    }
                });
            } //end if.
            else {
                mostraDialogo("<strong>CEP inválido!</strong><br>Nossos motores de busca identificaram seu CEP como inválido. Favor digitá-lo manualmente.", "warning", 4000);
            }
        } //end if.
    });
    
    // -----------------------------------------------------------
    /* Operações com cliques e botões */
    
    $(".btnCadastrarNovo").click(function(e){
        e.preventDefault();
        
        $.each($(".formExistente"), function(){
            $(this).find(".panel-body").slideUp(300);
            $(this).find(".panel-heading").find(".btnSalvar").hide();
            $(this).find(".panel-heading").closest(".row").find(".panel-footer").slideUp();
         });
        
        $("#rowFormVazio").slideDown(300);
    });
    
    $("#btnCancelar").click(function(e){
        e.preventDefault();
        
        $("#rowFormVazio").slideUp(300);
    });
    
    $(".btnSalvar, .btnSalvarProsseguir").click(function(e){
        $(".btnSalvar, .btnSalvarProsseguir").prop("disabled", true);
        
        if($(this).hasClass("btnSalvar")){
            mainFormNome = $(this).closest(".panel-heading").closest(".row").find("form").attr("id");
        }else{
            mainFormNome = $(this).closest(".panel-footer").closest(".row").find("form").attr("id");
        }
        
        mainForm = $("#"+mainFormNome);
        criaObj();
        
        var erros = validaForm();
        if(erros){
            mostraErros();
            $(".btnSalvar, .btnSalvarProsseguir").removeProp("disabled");
        }else{
            escondeErros();
            var prosseguir = ($(this).hasClass("btnSalvarProsseguir")?true:false);

            if(mainFormNome == "formVazio"){
                enviaAjaxCadastro(prosseguir);
            }else{
                enviaAjaxAltera(prosseguir);
            }
            
        }
    });
    
    $(".btnToggleEndereco").click(function(e){
        e.preventDefault();
        
        escondeErros();
        $("#rowFormVazio").hide();
        
        if($(this).closest(".panel-heading").closest(".row").find(".panel-body").is(":visible")){
            $(this).closest(".panel-heading").closest(".row").find(".panel-body").slideUp(300);
            $(this).closest(".panel-heading").find(".btn").slideUp(300);
            $(this).closest(".panel-heading").closest(".row").find(".panel-footer").hide();
        }else{
            $(".formExistente").find(".panel-body").hide();
            $(".formExistente").closest(".panel-heading").find(".btn").not(this).hide();
            $(".formExistente").find(".panel-footer").hide();
            
            $(this).closest(".panel-heading").closest(".row").find(".panel-body").slideDown(300);
            $(this).closest(".panel-heading").find(".btn").slideDown(300);
            $(this).closest(".panel-heading").closest(".row").find(".panel-footer").show();
        }
       
    });
    
    $(".btnExcluirEndereco").click(function(e){
        e.preventDefault();

        $("#modalExcluir").modal("show");  
        $("#hiddenEndereco").val(($(this).attr("rel-id")));    
    });
    $("#btnExcluirConfirma").click(function(){
        $("#btnExcluirConfirma").prop("disabled", true);
        var senha = $("#txtSenhaExcluir").val();
        var id = $("#hiddenEndereco").val();
        if(senha.length <= 2){
            $("#alertSenhaExcluir").slideDown(200);
            $("#alertSenhaExcluir").slideDown(200);
        }else{
            enviaAjaxExclui(senha, id);
        }
    });
    
    // -----------------------------------------------------------
    
    iniciaScript();
    
}});