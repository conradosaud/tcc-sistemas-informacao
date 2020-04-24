
$(document).ready(function(){if($("#viewApresentacao").is(":visible")){
    console.log("jQuery operando na view apresentacao.php");
    // --------------------------------------------------------
    
    /* Glossário
     * 
     * obj - objeto com todos o conteúdo dos formularios
     * objInicial - objeto com todo o conteudo dos formularios originais
     * form - objeto com o ID de todos os campos
     * 
     */
    
    // variaveis globais
    var obj;
    var objInicial;
    var form;
    
    // função chamada quando se inicia o script
    function iniciaScript(){//iniciaScript-sumario
        criaObj();
        objInicial = obj;
        verificaPreenchido();
    }
    
    // --------------------------------------------------------
    /* Operações gerais */
    
    // cria um objeto com todos os campos dos formulários
    function criaObj(){
        var nomeExibicaoCampo = $("#txtNomeExibicao");
        var descricaoCurtaCampo = $("#txtDescricaoCurta");
        var descricaoLongaCampo = $("#txtDescricaoLonga");
        
        var nomeExibicao = nomeExibicaoCampo.val().trim();
        var descricaoCurta = descricaoCurtaCampo.val().trim();
        var descricaoLonga = descricaoLongaCampo.val().trim();
        
        obj = {nomeExibicao:nomeExibicao,descricaoCurta:descricaoCurta,descricaoLonga:descricaoLonga};
        form = {nomeExibicao:nomeExibicaoCampo,descricaoCurta:descricaoCurtaCampo,descricaoLonga:descricaoLongaCampo};
    }
    
    function enviaAjax(prosseguir){
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_apresentacao.php',
            data: $("#formApresentacao").serialize(),
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    console.log(prosseguir);
                    if($(".tutorial").is(":visible")){
                        window.location.href = "../view/enderecos_e_contatos.php?tutorial=1";
                    }
                    if(prosseguir){
                        window.location.href = "../view/enderecos_e_contatos.php";
                    }else{
                        mostraDialogo("<strong>Informações salvas com sucesso!</strong><br>Suas novas informações já estão disponíveis em seu anúncio.", "success", 3000);
                    }
                }else{
                    var erro = "<strong>Erro ao salvar informações: </strong>";
                    erro += "verifique os valores digitados e tente novamente.";
                    mostraDialogo(erro, "danger", 6000);
                }
            },
            error: function (data) {
                console.log("ERRO [434]");
                console.log(data);
                var erro = "<strong>Erro 434</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                window.setTimeout(function(){ $("#btnSalvar, #btnSalvarProsseguir").removeProp("disabled"); }, 2000);
            }
        });
    }
    
    // verifica o quão completo está o anuncio e notifica na porcentagem
    function verificaPreenchido(){
        var porcentagem = 0;
        
        if(obj.nomeExibicao.length > 1){
            porcentagem += 34;
            $("#porcentagemNomeExibicao").hide();
        }else{
            $("#porcentagemNomeExibicao").show();
        }
        if(obj.descricaoCurta.length > 1){
            porcentagem += 33;
            $("#porcentagemDescricaoCurta").hide();
        }else{
            $("#porcentagemDescricaoCurta").show();
        }
        if(obj.descricaoLonga.length > 1){
            porcentagem += 33;
            $("#porcentagemDescricaoLonga").hide();
        }else{
            $("#porcentagemDescricaoLonga").show();
        }
        
        verificaBarra(porcentagem);
        
        $(".spanPorcentagem").text(porcentagem);
        $("div .progress-bar").attr("aria-valuenow", porcentagem);
        $("div .progress-bar").css("width", porcentagem+"%");
    }
    
    // verifica a porcentagem da barra para adicionar ou remover classes
    function verificaBarra(porcentagem){
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
    }
    
    // --------------------------------------------------------
    /* Validadores de formulários */
    
    // valida o formulario
    function verificaForm(){
        var erros = [];
        
        if(obj.nomeExibicao.length < 3){
            erros.push("O valor digitado em <strong>Nome de Exibição</strong> é muito curto.");
        }
        if(obj.descricaoCurta.length < 3){
            erros.push("O valor digitado em <strong>Descrição Curta</strong> é muito curto.");
        }
        if(obj.descricaoLonga.length < 5){
            erros.push("O valor digitado em <strong>Descrição Longa</strong> é muito curto.");
        }
        
        return erros;
    }
    
    function mostraErros(erros){
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
        
        $("#errosForm").html(html);
    }
    
    function escondeErros(){
        $(".alert").remove();
    }
    
    // --------------------------------------------------------
    /* Operações com formulários */
    
    
    // -----------------------------------------------------------
    /* Operações com cliques e botões */
    
    $("input, textarea").blur(function(e){
        if($(e.relatedTarget).hasClass("btn")) {
            $("#btnSalvar, #btnSalvarProsseguir").prop("disabled", true);
            var btn = e.relatedTarget;
            enviaSalvar($(btn));
        }else{
            criaObj();
        }
        verificaPreenchido();
    });
    
    $("#btnSalvar, #btnSalvarProsseguir").click(function(){
        $("#btnSalvar, #btnSalvarProsseguir").prop("disabled", true);
        enviaSalvar($(this));
    });
    
    function enviaSalvar(btn){
        criaObj();
        var erros = verificaForm();
        if(erros.length > 0){
            mostraErros(erros);
            $("#btnSalvar, #btnSalvarProsseguir").removeProp("disabled");
        }else{
            escondeErros();
            var prosseguir = (btn.attr("id") === "btnSalvarProsseguir"?true:false);
            enviaAjax(prosseguir);
        }
    }
    
    
    // -----------------------------------------------------------
    
    iniciaScript();
    
}});