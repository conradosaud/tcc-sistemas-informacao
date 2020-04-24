
$(document).ready(function(){if($("#viewInformacoesEmpresa").is(":visible")){
    console.log("jQuery operando na view informacoes_empresa.php");
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
    
    function enviaAjax(){
        var seguimento = ($("#selectSeguimentoAltera").is(":visible")?$("#selectSeguimento :selected").text():$("#seguimentoPadrao :selected").text());
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_informacoes_empresa.php',
            data: $("#formEmpresa").serialize()+"&Seguimento="+seguimento,
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    mostraDialogo("<strong>Informações salvas com sucesso!</strong><br>As informações da sua empresa foram alteradas com sucesso.", "success", 3000);
                }else{
                    var erro = "<strong>Erro ao cadastrar empresa: </strong>";
                    erro += "verifique os valores digitados e tente novamente.";
                    mostraDialogo(erro, "danger", 6000);
                }
            },
            error: function (data) {
                console.log("ERRO [371]");
                console.log(data);
                var erro = "<strong>Erro 371</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            },
            complete: function(){
                window.setTimeout(function(){ $("#btnSalvar").removeProp("disabled"); }, 2000);
            }
        });
    }
    
    
    // --------------------------------------------------------
    /* Validadores de formulários */
    
    function validaForm(){
        var erros = [];
        
        var nomeEmpresa = $("#txtNomeEmpresa").val();
        var seguimento = $("#selectSeguimento :selected").text();
        var email = $("#txtEmailEmpresa").val();
        var site = $("#txtSiteEmpresa").val();
        
        if(nomeEmpresa.trim().length < 4){
            erros.push("O valor inserido em <strong>Razão social ou nome fantasia</strong> é muito curto.");
        }
        if($("#selectSeguimentoAltera").is(":visible")){
            if(seguimento.trim() == "Selecione"){
                erros.push("Selecione uma opção em <strong>Seguimento</strong>.");
            }
        }
        if(site){
            if(site.indexOf("acebook") != -1 || site.indexOf("oogle") != -1){
                erros.push("Insira seu site apenas se possuir um dominio próprio. Sua página do Facebook pode ser vinculada com nossos serviços ,a href='../view/integracao_com_facebook.php'>clicando aqui</a>.");
            }
        }
        if(email){
            if(!validaEmail(email)){
                erros.push("Insira um endereço de email válido.");
            }
        }
        
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
    
    function escondeErros(){
        $(".alert").remove();
    }
    
    // -----------------------------------------------------------
    /* Operações com cliques e botões */
    
    $("#btnSalvar").click(function(){
        $("#btnSalvar").prop("disabled", true);
        
        var erros = validaForm();
        if(erros.length > 0){
            mostraErros(erros);
            $("#btnSalvar").removeProp("disabled");
        }else{
            escondeErros();
            enviaAjax();
        }
    });
    
    $("#mudaSeguimento").click(function(e){
        $("#modalMudarSeguimento").modal("show");
    });
    $("#btnMudarSeguimentoConfirma").click(function(){
        $("#selectSeguimentoPadrao").hide();
        $("#selectSeguimentoAltera").show();
    });
    
    
    // -----------------------------------------------------------
    
    iniciaScript();
    
}});