
$(document).ready(function(){if($("#viewInformacoesDoLocal").is(":visible")){
    console.log("jQuery operando na view informacoes_do_local.php");
    // --------------------------------------------------------
    
    /* Glossário
     * 
     * 
     */
    
    // variaveis globais
    var obj;
    
    // função chamada quando se inicia o script
    function iniciaScript(){//iniciaScript-sumario
        verificaMarcadores();
        criaObj();
    }
    
    // --------------------------------------------------------
    /* Operações gerais */
    
    function criaObj(){
        obj = {
            atendeLocal: $("#trAtendeLocal").find("td:nth-child(1)").find("input").is(":checked")?true:false,
            entregasDomicilio: $("#trEntregasDomicilio").find("td:nth-child(1)").find("input").is(":checked")?true:false,
            estacionamento: $("#trEstacionamento").find("td:nth-child(1)").find("input").is(":checked")?true:false
        };
    }
    
    function enviaAjax(prosseguir){
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_informacoes_do_local.php',
            data: "obj="+JSON.stringify(obj)+"&hiddenInfo=true",
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    if(prosseguir){
                        window.location.href = "../view/integracao_com_facebook.php";
                    }else{
                        mostraDialogo("<strong>Dados salvos com sucesso!</strong><br>Suas informações foram alteradas com sucesso e já podem ser visualizadas pelos usuários.","success",3000);
                    }
                }else{
                    var erro = "<strong>Erro ao salvar dados: </strong>";
                    erro += "verifique os valores e tente novamente. Se o problema persistir, entre em contato com o suporte.";
                    mostraDialogo(erro, "danger", 6000);
                }
            },
            error: function (data) {
                console.log("ERRO [329]");
                console.log(data);
                var erro = "<strong>Erro 329</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                window.setTimeout(function(){ $("#btnSalvar, #btnSalvarProsseguir").removeProp("disabled"); }, 2000);
            }
        });
    }
    
    
    // --------------------------------------------------------
    /* Validadores de formulários */
    
    
    
    
    // --------------------------------------------------------
    /* Operações com formulários */
    
    function verificaMarcadores(){
        
        var atendimentoTrue = "<span>Atendemos clientes em nosso estabelecimento.</span>";
        var atendimentoFalse = "<span class='text-muted'>Não atendemos clientes em nosso estabelecimento.</span>";
        var entregasTrue = "<span>Realizamos entregas a domicílio.</span>";
        var entregasFalse = "<span class='text-muted'>Não realizamos entregas a domicílio.</span>";
        var estacionamentoTrue = "<span>Temos estacionamento para clientes.</span>";
        var estacionamentoFalse = "<span class='text-muted'>Não possuimos estacionamento para clientes.</span>";
        
        $.each($("tr"), function(){
            var bool = ($(this).find("td:nth-child(1)").find("input").is(":checked")?true:false);
            
            switch($(this).attr("id")){
                case "trAtendeLocal":
                    $(this).find("td:nth-child(2)").html((bool?atendimentoTrue:atendimentoFalse));
                    break;
                case "trEntregasDomicilio":
                    $(this).find("td:nth-child(2)").html((bool?entregasTrue:entregasFalse));
                    break;
                case "trEstacionamento":
                    $(this).find("td:nth-child(2)").html((bool?estacionamentoTrue:estacionamentoFalse));
                    break;
            }
        });
    }
    
    // -----------------------------------------------------------
    /* Operações com cliques e botões */
    
    $("#btnSalvar, #btnSalvarProsseguir").click(function(e){
        $("#btnSalvar, #btnSalvarProsseguir").prop("disabled", true);
        
        criaObj();
        var prosseguir = ($(this).attr("id")=="btnSalvarProsseguir"?true:false);
        enviaAjax(prosseguir);
    });
    
    $("input[type=checkbox]").change(function(){
        verificaMarcadores();
    });
    
    // -----------------------------------------------------------
    
    iniciaScript();
    
}});