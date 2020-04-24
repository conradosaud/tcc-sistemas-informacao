
$(document).ready(function(){if($("#viewIntegracaoComFacebook").is(":visible")){
    console.log("jQuery operando na view integracao_com_facebook.php");
    // --------------------------------------------------------
    
    /* Glossário
     * 
     * 
     */
    
    // variaveis globais
    var usuarioConectado = false;
    var nomePagina;
    var idPagina;
    var obj;
    
    var idApi = 375545962881629;
    
    // --------------------------------------------------------
    /* SDK Facebook */
    
    // SDK do Facebook
    window.fbAsyncInit = function() {
        FB.init({
            appId      : idApi,
            cookie     : true,
            status     : true,
            xfbml      : true,
            version    : 'v2.10'
        });

        // * ---------  Primeiras funções a serem chamadas após o SDK
    
    };

    // Função chamada para iniciar o SDK do Facebook
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
     
    
    
    // --------------------------------------------------------
    /* Operações com a API do Facebook */
    
    // executa o login do usuario
    function login(){
        FB.login(function(response){
           if(response.status === "connected"){
               usuarioLogado();
           }else{
               console.log("ERRO AO CONECTAR-SE COM O FACEBOOK!");
               usuarioDeslogado();
           }
        });
    }
    
    // executa ações se o usuário está logado
    function usuarioLogado(){
        console.log("Usuário conectado com o Facebook!");
        usuarioConectado = true;
    }
    
    // executa ações se o usuário não estiver logado
    function usuarioDeslogado(){
        console.log("O usuário não conectado com o Facebook.");
        usuarioConectado = false;
    }
    
    // --------------------------------------------------------
    /* Operacações com o Facebook */
    
    $("#removerVinculacaoFacebook").click(function(e){
        e.preventDefault();

        var obj = {id:"", nome:"", curtida:0, comentarios:0};
        enviaVinculacaoFacebookAjax(obj, false);
        
        $("#facebookVinculado").hide();
        $("#preVinculacao").show();
    });
    
    // quando o usuário clica para vincular sua página ao facebook
    $("#fbPermissao").click(function(e){
        e.preventDefault();
        FB.login(function(response) {
            if(response.status === "connected"){
                var campos = "accounts";
                FB.api("/me?fields="+campos, function(response){
                    if(!response.accounts){
                        $("#divErrosIntegracao").show();
                        return false;
                    }
                    
                    $("#preVinculacao").hide();
                    $("#posVinculacao").slideDown(200);
                    console.log(response.accounts);
                    
                    for(var i = 0; i < response.accounts.data.length; i++){
                        var botao = '<a href="#" class="btn btn-default escolherPagina" style="margin-top: 10px;" name="'+response.accounts.data[i].name+'" id="'+response.accounts.data[i].id+'">'+response.accounts.data[i].name+'</a><br>';
                        $("#listaPaginas").append(botao);
                    }
                    
                });
            }else{
                $("#divErrosIntegracao").show();
                console.log("ERRO AO CONECTAR-SE COM O FACEBOOK!");
                usuarioDeslogado();
           }
        }, {scope: 'pages_show_list'});
    });
    
    // operação ao escolher a página para vincular
    $(document).on("click", ".escolherPagina", function(e){
        e.preventDefault();
        
        nomePagina = $(this).attr("name");
        idPagina = $(this).attr("id");
        
        enviaAjaxInsere();

        $("#posVinculacao").hide();
        $("#divIntegracaoAguarde").slideDown(200);
    });
    
    // --------------------------------------------------------
    
    // função chamada quando se inicia o script
    function iniciaScript(){//iniciaScript-sumario
        
    }
    
    // --------------------------------------------------------
    /* Operações gerais */
    
    function criaObj(){
        obj = {
            cboxCurtidas:$("#cboxCurtidas").is(":checked"),
            cboxComentarios:$("#cboxComentarios").is(":checked"),
            cboxCompartilhar:$("#cboxCompartilhar").is(":checked"),
            cboxEnviar:$("#cboxEnviar").is(":checked"),
        };
    }
    
    function enviaAjaxInsere(){
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_integracao_com_facebook.php',
            data: "hiddenNovoFacebook=true&idPagina="+idPagina+"&nomePagina="+nomePagina,
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    location.reload();
                }else{
                    $("#divIntegracaoAguarde").hide();
                    $("#divIntegracaoErro").show();
                }
            },
            error: function (data) {
                console.log("ERRO [674]");
                console.log(data);
                var erro = "<strong>Erro 674</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            }
        });
    }
    
    function enviaAjaxAltera(prosseguir, remover){
        var data;
        if(remover){
            data = "hiddenRemove=true";
        }else{
            data = "hiddenAltera=true";
        }
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_integracao_com_facebook.php',
            data: "obj="+JSON.stringify(obj)+"&"+data,
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    if(remover){
                        location.reload();
                        return;
                    }
                    if(prosseguir){
                        window.location.href = "../view/integracao_com_maps.php";
                    }else{
                        mostraDialogo("<strong>Informações salvas com sucesso!</strong><br>Suas alterações foram realizadas com sucesso e já podem ser visualizadas pelos usuários.","success",3000);
                    }
                }else{
                    mostraDialogo("<strong>Erro ao salvar informações.</strong><br>Suas informações não podem ser salvas, tente novamente. Se o erro persistir, entre em contato com nossa equipe de suporte.","danger",5000);
                }
            },
            error: function (data) {
                console.log("ERRO [673]");
                console.log(data);
                var erro = "<strong>Erro 673</strong><br>Um erro inesperado aconteceu, tente novamente.";
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

    
    // -----------------------------------------------------------
    /* Operações com cliques e botões */
    
    $("#btnSalvar, #btnSalvarProsseguir").click(function(e){
        $("#btnSalvar, #btnSalvarProsseguir").prop("disabled", true);
        
        criaObj();
        var prosseguir = ($(this).attr("id")=="btnSalvarProsseguir");
        enviaAjaxAltera(prosseguir);
    });
    
    $("#btnRemoverIntegracao").click(function(e){
        e.preventDefault();
        $("#modalRemoverIntegracao").modal("show");
    });
    $("#btnRemoverIntegracaoConfirma").click(function(e){
        e.preventDefault();
        enviaAjaxAltera(false, true);
    });
    
    
    // -----------------------------------------------------------
    
    iniciaScript();
    
}});