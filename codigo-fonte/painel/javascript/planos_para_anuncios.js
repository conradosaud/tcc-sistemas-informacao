
$(document).ready(function(){
    
    var cupom = null;
    var plano = null;
    var diasRestante = 0;
    
    function enviaAjaxCupom(objCupom){
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_planos_para_anuncios.php',
            data: "verificaCupom=true&cupom="+objCupom,
            success: function (data) {
                //console.log(data);
                if(data == "cupomInexistente"){
                    mostraMensagem("<strong>Cupom inexistente</strong><br>O cupom inserido não existe. Verifique o valor digitado e tente novamente.");
                    return;
                }
                if(data == "cupomInvalido"){
                    mostraMensagem("<strong>Cupom invalido</strong><br>Este cupom já foi utilizado ou seu prazo de validade expirou.");
                    return
                }
                
                data = JSON.parse(data);
                cupom = JSON.parse(data.Cupom);
                plano = JSON.parse(data.Plano);

                avancarPainel();
                
            },
            error: function (data) {
                console.log(data);
                var erro = "Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                $("#btnEnviarCupom").removeProp("disabled");
            }
        });
    }
    
    function enviaAjaxContratarPlano(objDias){
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_planos_para_anuncios.php',
            data: "contratarPlano=true&IdPlano="+plano.IdPlano+"&IdCupom="+cupom.IdCupom+"&Valor="+plano.Valor+"&Desconto="+(cupom == null?plano.ValorDesconto:cupom.Desconto)+"&diasEscolhidos="+objDias,
            success: function (data) {
                console.log(data);
                if(data == "Sucesso"){
                    $("#selecionarData").fadeOut(300);
                    $("#divSucessoContratacao").fadeIn(500);
                }
                if(data == "Erro"){
                    $("#selecionarData").hide();
                    $("#divErroContratacao").show();
                }
            },
            error: function (data) {
                console.log(data);
                var erro = "Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                $(".btnSalvarCalendario").removeProp("disabled");
            }
        });
    }
    
    function avancarPainel(){
        var divCupom = $("#divInserirCupom");
        var divData = $("#selecionarData");
        
        if(divCupom.is(":visible")){
            divCupom.fadeOut(300);
            divData.fadeIn(500);
            montaPainelData();
            return;
        }
        if(divData.is(":visible")){
            divCupom.fadeIn(500);
            divData.fadeOut(300);
            return;
        }
    }
    
    function montaPainelData(){
        $(".spanTipoPlano").text(plano.TipoPlano);
        $(".spanPlanoEscolhido").text(plano.Nome);
        
        switch(plano.TipoDia){
            case "Semanal": 
                $(".spanTipo").text("Semanal (segunda à sexta)");
                $(".layoutDiasSemanal").show();
                $(".spanDiasSemanal").text(plano.Duracao);
                $("#spanDiasRestanteSemanal").text(plano.Duracao);
                break;
            case "Fim de Semana":
                $(".spanTipo").text("Fim de Semana (sábados e domingos)");
                $(".layoutDiasFds").show();
                $(".spanDiasFs").text(plano.Duracao);
                $("#spanDiasRestanteFs").text(plano.Duracao);
                break;
            case "Especial":
                $(".spanTipo").text("Especial (segunda à domingo)");
                $(".layoutDiasEspecial").show();
                $(".spanDiasEspecial").text(plano.Duracao);
                $("#spanDiasRestanteEspecial").text(plano.Duracao);
                break;
        }
        
        $(".spanValorPlano").text(formatarDinheiro(plano.Valor));

        if((cupom != null && cupom.Desconto > 0) || (plano.ValorDesconto > 0)){
            $(".layoutDesconto").show();
            $(".spanTipoAssinatura").text((cupom == null?"(pacote)":"(cupom)"));
            $(".spanDesconto").text(cupom == null?plano.ValorDesconto+"%":cupom.Desconto+"%");
        }
        
        $(".spanTotal").text(calcularTotal(cupom, plano));
        
        (plano.Duracao > 1?$(".spanDiasPlural").show():$(".spanDiasPlural").hide());
        diasRestante = plano.Duracao;
    }
    
    function calcularTotal(cupom, plano){
        var valor = plano.Valor;
        var desconto = 0;
        var total = 0;
        
        if(cupom != null){
            desconto = cupom.Desconto;
        }else{
            desconto = plano.ValorDesconto;
        }

        if(desconto > 0){
            total = valor - ((desconto * valor) / 100);
            total = parseFloat(total).toFixed(2);
        }else{
            total = valor;
        }
        
        total = formatarDinheiro(total);
        return total;
    }
    
    function formatarDinheiro(valor){
        if(valor == 0){
            return "0,00";
        }
        
        valor = parseFloat(valor).toFixed(2);
        valor = valor.toString();
        valor = valor.replace(".", ",");
        
        return valor;
    }
    
    // -----------------------------------------------------------
    
    /* Operações com o calendário */
    
    $(".calendario tbody td").click(function(){
        if($(this).hasClass("calendario-selecionado")){
            $(this).removeClass("calendario-selecionado");
            $(this).text($(this).text());
            diasRestante++;
        }else{
            if(!$(this).hasClass("calendario-muted") && (diasRestante < plano.Duracao+1 && diasRestante > 0)){
                $(this).addClass("calendario-selecionado");
                $(this).prepend('<i class="fa fa-check"> </i> ');
                diasRestante--;
            }
        }
        
        switch(plano.TipoDia){
            case "Semanal": 
                break;
            case "Fim de Semana":
                break;
            case "Especial":
                if(diasRestante == 0){
                    $(".layoutDiasEspecial").hide();
                    $("#pEspecialEsgotado").show();
                }else{
                    $(".layoutDiasEspecial").show();
                    $("#spanDiasRestanteEspecial").text(diasRestante);
                    $("#pEspecialEsgotado").hide();
                }
                break;
        }
        
        /*
        if(diasRestante == 0){
            if(objContratar.TipoDia=="Semanal"){
                $("#pSemanaEsgotado").show();
                $("#pSemanaRestante").hide();
            }else{
                $("#pFsEsgotado").show();
                $("#pFsRestante").hide();
            }
        }else{
            if(objContratar.TipoDia=="Semanal"){
                $("#pSemanaEsgotado").hide();
                $("#pSemanaRestante").show();
                $("#diasRestanteSemanal").text(diasRestante);
            }else{
                $("#pFsEsgotado").hide();
                $("#pFsRestante").show();
                $("#diasRestanteFs").text(diasRestante);
            }
        }
        */
        
    });
    
    function montaObjDias(){
        var qnt = $(".calendario-selecionado").length;
        if(qnt != plano.Duracao){
            return 0;
        }
        
        var objDias = [];
        $.each($(".calendario-selecionado"), function(){
            objDias.push($(this).attr("data"));
        });
        
        return objDias;
    }
    
    function mostraMensagem(mensagem){
        $("#alertCupom").show();
        $("#msgCupom").html(mensagem);
    }
    
    $("#btnEnviarCupom").click(function(){
        var cupom = $("#txtCupom").val();
        
        $("#btnEnviarCupom").prop("disabled", "true");
        enviaAjaxCupom(cupom);
    });
    
    $(".btnSalvarCalendario").click(function(){
        if(diasRestante > 0){
            var msg = "<strong>Você não selecionou todos os dias</strong><br> Ainda restam "+diasRestante+" dia(s) para serem selecionados. Marque-os no calendário.";
            mostraDialogo(msg, "warning", 4000);
            return false;
        }
        
        var objDias = montaObjDias();
        if(objDias == 0){
            mostraDialogo("<strong>Erro ao salvar</strong><br>Ocorreu um erro ao salvar os dias selecionados. Tente novamente mais tarde.", "danger", 4000);
            return false;
        }
        
        $(".btnSalvarCalendario").prop("disabled", "true");
        enviaAjaxContratarPlano(objDias);
        
    });
    
});


