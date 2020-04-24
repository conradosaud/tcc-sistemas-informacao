
$(document).ready(function(){if($("#viewHorarioDeFuncionamento").is(":visible")){
    console.log("jQuery operando na view horario_de_funcionamento.php");
    // --------------------------------------------------------
    
    /* Glossário
     * 
     * var objForm - possui todos os elementos do form daquele dia da semana
     * var objVal - possui o valor dos elementos daquele dia da semana
     * 
     */
    
    // variaveis globais
    var objForm;
    var objVal;
    var objOriginal;
    
    // função chamada quando se inicia o script
    function iniciaScript(){//iniciaScript-sumario
        criaObjOriginal();
    }
    
    // --------------------------------------------------------
    /* Operações gerais */
    
    function criaObjOriginal(){
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_horario_de_funcionamento.php',
            data: "getHorarios=true",
            success: function (data) {
                //console.log(data);
                if(data){
                    objOriginal = JSON.parse(data);
                    
                    criaObj();
                    verificaPreenchido();
                    montaForm(objOriginal);
                }else{
                    var erro = "<strong>Erro ao resgatar informações de horários: </strong>";
                    erro += "tente novamente mais tarde. Se o erro persistir, contacte nosso suporte.";
                    mostraDialogo(erro, "danger", 6000);
                }
            },
            error: function (data) {
                console.log("ERRO [675]");
                console.log(data);
                var erro = "<strong>Erro 675</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            }
        });
    }
    
    function criaObj(){
        objVal = {
            segunda: getTable("Segunda", true), terca: getTable("Terca", true), quarta: getTable("Quarta", true),
            quinta: getTable("Quinta", true), sexta: getTable("Sexta", true), sabado: getTable("Sabado", true),
            domingo: getTable("Domingo", true)
        };
        
        objForm = {
            segunda: getTable("Segunda"), terca: getTable("Terca"), quarta: getTable("Quarta"),
            quinta: getTable("Quinta"), sexta: getTable("Sexta"), sabado: getTable("Sabado"),
            domingo: getTable("Domingo")
        };
    }
    
    function habilitaAberto(habilita, elemento){
        if(habilita){
            elemento.closest("td").next().find("select").removeProp("disabled");
            elemento.closest("td").next().next().find("select").removeProp("disabled");
        }else{
            console.log(elemento.closest("tr").find("td:first").text());
            elemento.closest("tr").find("td:first").next().next().find("select").prop("disabled", true);
            elemento.closest("tr").find("td:first").next().next().next().find("select").prop("disabled", true);
            elemento.closest("tr").find("td:first").next().next().find('select :nth-child(1)').prop('selected', true);
            elemento.closest("tr").find("td:first").next().next().next().find('select :nth-child(1)').prop('selected', true);
            elemento.closest("tr").find("td:first").next().find('.formAberto').prop('checked', false);
        }
    }
    
    function habilitaTodo(habilita, elemento){
        if(habilita){
            elemento.closest("td").addClass("success alert-success");
        }else{
            elemento.closest("tr").find(".formTodo").closest("td").removeClass("success alert-success");
            elemento.closest("tr").find(".formTodo").prop("checked", false);
        }
    }
    
    $("input[type=checkbox]").change(function(x){
        if($(this).hasClass("formAberto")){
            if($(this).is(":checked")){
                habilitaAberto(true, $(this));
                habilitaTodo(false, $(this));
            }else{
                habilitaAberto(false, $(this));
            }   
        }
        if($(this).hasClass("formTodo")){
            if($(this).is(":checked")){
                habilitaTodo(true, $(this));
                habilitaAberto(false, $(this));
            }else{
                habilitaTodo(false, $(this));
            }
        }
        verificaPreenchido(true);
    });
    
   
    
    function getTable(dia, valor){
        if(valor){
            return {
                aberto: $("#tr"+dia+" td:first").next().find("input").is(":checked"),
                das: $("#tr"+dia+" td:first").next().next().find("select").find(":selected").text(),
                as: $("#tr"+dia+" td:first").next().next().next().find("select").find(":selected").text(),
                todo: $("#tr"+dia+" td:first").next().next().next().next().find("input").is(":checked")
            };
        }else{
            return {
                aberto: $("#tr"+dia+" td:first").next().find("input"),
                das: $("#tr"+dia+" td:first").next().next().find("select"),
                as: $("#tr"+dia+" td:first").next().next().next().find("select"),
                todo: $("#tr"+dia+" td:first").next().next().next().next().find("input")
            };
        }
    }
    
    function enviaAjax(prosseguir){
        criaObj();
        console.log(JSON.stringify(objVal));
        //console.log(objVal.serialize());
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_horario_de_funcionamento.php',
            data: "form="+JSON.stringify(objVal)+"&hiddenHorarios=true",
            success: function (data) {
                console.log(data);
                if(data){
                    if(prosseguir){
                        window.location.href="../view/informacoes_do_local.php";
                    }else{
                        mostraDialogo("<strong>Informações salvas com sucesso!</strong><br>Os horários foram salvos e já podem ser visualizado pelos usuários. ", "success", 3000);
                    }
                }else{
                    var erro = "<strong>Erro ao salvar horários: </strong>";
                    erro += "verifique os valores digitados e tente novamente.";
                    mostraDialogo(erro, "danger", 6000);
                }
            },
            error: function (data) {
                console.log("ERRO [674]");
                console.log(data);
                var erro = "<strong>Erro 674</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                window.setTimeout(function(){ $("#btnSalvar, #btnSalvarProsseguir").removeProp("disabled"); }, 2000);
            }
        });
    }
    
    // verifica o quão completo está o anuncio e notifica na porcentagem
    function verificaPreenchido(tempoReal){
        var porcentagem = 0;
        var preenchido = 0;
        
        if(tempoReal){
            criaObj();
            if(objVal.segunda.das){preenchido++;};
            if(objVal.terca.das){preenchido++;};
            if(objVal.quarta.das){preenchido++;};
            if(objVal.quinta.das){preenchido++;};
            if(objVal.sexta.das){preenchido++;};
            if(objVal.sabado.das){preenchido++;};
            if(objVal.domingo.das){preenchido++;};
        }else{
            if(objOriginal.segundaDas){preenchido++;};
            if(objOriginal.tercaDas){preenchido++;};
            if(objOriginal.quartaDas){preenchido++;};
            if(objOriginal.quintaDas){preenchido++;};
            if(objOriginal.sextaDas){preenchido++;};
            if(objOriginal.sabadoDas){preenchido++;};
            if(objOriginal.domingoDas){preenchido++;};
        }
        
        if(preenchido == 1){
            porcentagem = 50;
            $("#porcentagemDias").show();
        }else if(preenchido >= 2){
            porcentagem = 100;
            $("#porcentagemDias").hide();
        }else{
            $("#porcentagemDias").show();
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
    
    function validaForm(){
        criaObj();
        var erros = [];
        var aux1, aux2;
        
        aux1 = objVal.segunda.das.replace(":",".");aux1 = (parseFloat(aux1))+(parseFloat(0.001));aux2 = objVal.segunda.as.replace(":",".");aux2 = (parseFloat(aux2))+(parseFloat(0.001));if(aux1 && !aux2 || !aux1 && aux2){erros.push("Existem horários não preenchidos na linha <strong>Segunda</strong>");}
        aux1 = objVal.terca.das.replace(":",".");aux1 = (parseFloat(aux1))+(parseFloat(0.001));aux2 = objVal.terca.as.replace(":",".");aux2 = (parseFloat(aux2))+(parseFloat(0.001));if(aux1 && !aux2 || !aux1 && aux2){erros.push("Existem horários não preenchidos na linha <strong>Terça</strong>");}
        aux1 = objVal.quarta.das.replace(":",".");aux1 = (parseFloat(aux1))+(parseFloat(0.001));aux2 = objVal.quarta.as.replace(":",".");aux2 = (parseFloat(aux2))+(parseFloat(0.001));if(aux1 && !aux2 || !aux1 && aux2){erros.push("Existem horários não preenchidos na linha <strong>Quarta</strong>");}
        aux1 = objVal.quinta.das.replace(":",".");aux1 = (parseFloat(aux1))+(parseFloat(0.001));aux2 = objVal.quinta.as.replace(":",".");aux2 = (parseFloat(aux2))+(parseFloat(0.001));if(aux1 && !aux2 || !aux1 && aux2){erros.push("Existem horários não preenchidos na linha <strong>Quinta</strong>");}
        aux1 = objVal.sexta.das.replace(":",".");aux1 = (parseFloat(aux1))+(parseFloat(0.001));aux2 = objVal.sexta.as.replace(":",".");aux2 = (parseFloat(aux2))+(parseFloat(0.001));if(aux1 && !aux2 || !aux1 && aux2){erros.push("Existem horários não preenchidos na linha <strong>Sexta</strong>");}
        aux1 = objVal.sabado.das.replace(":",".");aux1 = (parseFloat(aux1))+(parseFloat(0.001));aux2 = objVal.sabado.as.replace(":",".");aux2 = (parseFloat(aux2))+(parseFloat(0.001));if(aux1 && !aux2 || !aux1 && aux2){erros.push("Existem horários não preenchidos na linha <strong>Sabado</strong>");}
        aux1 = objVal.domingo.das.replace(":",".");aux1 = (parseFloat(aux1))+(parseFloat(0.001));aux2 = objVal.domingo.as.replace(":",".");aux2 = (parseFloat(aux2))+(parseFloat(0.001));if(aux1 && !aux2 || !aux1 && aux2){erros.push("Existem horários não preenchidos na linha <strong>Domingo</strong>");}
        
        return erros;
    }
    
    // --------------------------------------------------------
    /* Operações com formulários */
    
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
    
    function montaForm(obj){
        if(obj.segundaDas == "99:99" || obj.segundaDas.length < 1){objForm.segunda.aberto.prop("checked", false);objForm.segunda.das.prop("disabled", true);objForm.segunda.as.prop("disabled", true);if(obj.segundaDas == "99:99"){objForm.segunda.todo.prop("checked", true);objForm.segunda.todo.closest("td").addClass("success alert-success");}}else{objForm.segunda.aberto.prop("checked", true);objForm.segunda.das.prop("disabled", false);objForm.segunda.as.prop("disabled", false);objForm.segunda.todo.prop("checked", false);objForm.segunda.todo.closest("td").removeClass("success alert-success");objForm.segunda.das.find("option:contains('"+obj.segundaDas+"')").prop("selected", true);objForm.segunda.as.find("option:contains('"+obj.segundaAs+"')").prop("selected", true);}
        if(obj.tercaDas == "99:99" || obj.tercaDas.length < 1){objForm.terca.aberto.prop("checked", false);objForm.terca.das.prop("disabled", true);objForm.terca.as.prop("disabled", true);if(obj.tercaDas == "99:99"){objForm.terca.todo.prop("checked", true);objForm.terca.todo.closest("td").addClass("success alert-success");}}else{objForm.terca.aberto.prop("checked", true);objForm.terca.das.prop("disabled", false);objForm.terca.as.prop("disabled", false);objForm.terca.todo.prop("checked", false);objForm.terca.todo.closest("td").removeClass("success alert-success");objForm.terca.das.find("option:contains('"+obj.tercaDas+"')").prop("selected", true);objForm.terca.as.find("option:contains('"+obj.tercaAs+"')").prop("selected", true);}
        if(obj.quartaDas == "99:99" || obj.quartaDas.length < 1){objForm.quarta.aberto.prop("checked", false);objForm.quarta.das.prop("disabled", true);objForm.quarta.as.prop("disabled", true);if(obj.quartaDas == "99:99"){objForm.quarta.todo.prop("checked", true);objForm.quarta.todo.closest("td").addClass("success alert-success");}}else{objForm.quarta.aberto.prop("checked", true);objForm.quarta.das.prop("disabled", false);objForm.quarta.as.prop("disabled", false);objForm.quarta.todo.prop("checked", false);objForm.quarta.todo.closest("td").removeClass("success alert-success");objForm.quarta.das.find("option:contains('"+obj.quartaDas+"')").prop("selected", true);objForm.quarta.as.find("option:contains('"+obj.quartaAs+"')").prop("selected", true);}
        if(obj.quintaDas == "99:99" || obj.quintaDas.length < 1){objForm.quinta.aberto.prop("checked", false);objForm.quinta.das.prop("disabled", true);objForm.quinta.as.prop("disabled", true);if(obj.quintaDas == "99:99"){objForm.quinta.todo.prop("checked", true);objForm.quinta.todo.closest("td").addClass("success alert-success");}}else{objForm.quinta.aberto.prop("checked", true);objForm.quinta.das.prop("disabled", false);objForm.quinta.as.prop("disabled", false);objForm.quinta.todo.prop("checked", false);objForm.quinta.todo.closest("td").removeClass("success alert-success");objForm.quinta.das.find("option:contains('"+obj.quintaDas+"')").prop("selected", true);objForm.quinta.as.find("option:contains('"+obj.quintaAs+"')").prop("selected", true);}
        if(obj.sextaDas == "99:99" || obj.sextaDas.length < 1){objForm.sexta.aberto.prop("checked", false);objForm.sexta.das.prop("disabled", true);objForm.sexta.as.prop("disabled", true);if(obj.sextaDas == "99:99"){objForm.sexta.todo.prop("checked", true);objForm.sexta.todo.closest("td").addClass("success alert-success");}}else{objForm.sexta.aberto.prop("checked", true);objForm.sexta.das.prop("disabled", false);objForm.sexta.as.prop("disabled", false);objForm.sexta.todo.prop("checked", false);objForm.sexta.todo.closest("td").removeClass("success alert-success");objForm.sexta.das.find("option:contains('"+obj.sextaDas+"')").prop("selected", true);objForm.sexta.as.find("option:contains('"+obj.sextaAs+"')").prop("selected", true);}
        if(obj.sabadoDas == "99:99" || obj.sabadoDas.length < 1){objForm.sabado.aberto.prop("checked", false);objForm.sabado.das.prop("disabled", true);objForm.sabado.as.prop("disabled", true);if(obj.sabadoDas == "99:99"){objForm.sabado.todo.prop("checked", true);objForm.sabado.todo.closest("td").addClass("success alert-success");}}else{objForm.sabado.aberto.prop("checked", true);objForm.sabado.das.prop("disabled", false);objForm.sabado.as.prop("disabled", false);objForm.sabado.todo.prop("checked", false);objForm.sabado.todo.closest("td").removeClass("success alert-success");objForm.sabado.das.find("option:contains('"+obj.sabadoDas+"')").prop("selected", true);objForm.sabado.as.find("option:contains('"+obj.sabadoAs+"')").prop("selected", true);}
        if(obj.domingoDas == "99:99" || obj.domingoDas.length < 1){objForm.domingo.aberto.prop("checked", false);objForm.domingo.das.prop("disabled", true);objForm.domingo.as.prop("disabled", true);if(obj.domingoDas == "99:99"){objForm.domingo.todo.prop("checked", true);objForm.domingo.todo.closest("td").addClass("success alert-success");}}else{objForm.domingo.aberto.prop("checked", true);objForm.domingo.das.prop("disabled", false);objForm.domingo.as.prop("disabled", false);objForm.domingo.todo.prop("checked", false);objForm.domingo.todo.closest("td").removeClass("success alert-success");objForm.domingo.das.find("option:contains('"+obj.domingoDas+"')").prop("selected", true);objForm.domingo.as.find("option:contains('"+obj.domingoAs+"')").prop("selected", true);}
    }
    
    // -----------------------------------------------------------
    /* Operações com cliques e botões */
    
    $("#btnSalvar, #btnSalvarProsseguir").click(function(e){
        $("#btnSalvar, #btnSalvarProsseguir").prop("disabled", true);
        
        var erros = validaForm();
        if(erros.length > 0){
            mostraErros(erros);
            $("#btnSalvar, #btnSalvarProsseguir").removeProp("disabled");
        }else{
            $(".alert").hide();
            var prosseguir = ($(this).attr("id")=="btnSalvarProsseguir"?true:false);
            enviaAjax(prosseguir);
        }
    });
    
    $("#btnDesabilitaTodos").click(function(e){
        e.preventDefault();
        
        $("tbody input[type=checkbox]").prop("checked",false);
        $("tbody td").removeClass("success alert-success");
        $("tbody select").prop("disabled", true);
        $("tbody select :nth-child(1)").prop('selected', true);
        $(".alert").hide();
        
        verificaPreenchido(true);
    });
    
    $("select, select:disabled").change(function(){
        verificaPreenchido(true);
    });
    
    
    // -----------------------------------------------------------
    
    iniciaScript();
    
}});