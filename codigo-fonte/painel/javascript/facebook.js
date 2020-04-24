
console.log("jQuery Facebook em operação.");


    // --------------------------------------------------------
    
    /* Glossário
     * 
     */
    
    // variaveis globais
    var btnLogin = ".btnLoginFacebook";
    var divComentarios = ".divComentariosFacebook";
    
    var usuarioConectado = false;
    var hiddenConectado = "#hiddenConectado";
    
    var idApi = "323819004741424";
    var senhaApi = "ab239ef9f94b35ad791d9615528d3c50";
    var token = idApi+"|"+senhaApi;
    

    // --------------------------------------------------------

    // SDK do Facebook
    window.fbAsyncInit = function() {
        FB.init({
            appId      : idApi,
            cookie     : true,
            status     : true,
            xfbml      : true,
            version    : 'v2.8'
        });

        // * ---------  Primeiras funções a serem chamadas após o SDK
        
        // verifica se o usuário está logado
        verificaLogado();
        
        // esconde todos os elementos que só serão exibidos após a api ser carregada
        $(".fb-carregado").hide();
        
        // Mostra um loader enquantos os elementos não estiverem carregados
        FB.Event.subscribe('xfbml.render', function(response) {
            $(".fb-carregando").hide();
            $(".fb-carregado").show();
        });
    
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
    /* Operações gerais */
    
    function enviaAjax(){
        var campos = "id,email,first_name,gender,last_name,name,link,locale,timezone,updated_time,verified,accounts";
        FB.api("/me?fields="+campos, function(response){
                if(response.id.length < 1){
                    console.log("Não foi possível salvar visitante.");
                    return false;
                }
                $.ajax({
                type: 'POST',
                url: '../php/validarVisitante.php',
                data: response,
                success: function (data) {
                    console.log(data);
                    if(data == true){
                        console.log("Visitante salvo com sucesso!");
                    }else{
                        console.log("O visitante já possui registro.");
                    }
                },
                error: function (data) {
                    console.log("ERRO @@@@@@@@@@@");
                    console.log(data);
                }
            });
        });
    }
    
    
    // --------------------------------------------------------
    /* Operações com a API do Facebook */
    
    // executa o login do usuario
    function login(){
        FB.login(function(response){
           if(response.status === "connected"){
               usuarioLogado();
               enviaAjax();
           }else{
               console.log("ERRO AO CONECTAR-SE COM O FACEBOOK!");
               usuarioDeslogado();
           }
        });
    }
    
    // executa ações se o usuário está logado
    function usuarioLogado(){
        console.log("Usuário conectado com o Facebook!");
        $(btnLogin).hide();
        $(hiddenConectado).val(true);
        usuarioConectado = true;
    }
    
    // executa ações se o usuário não estiver logado
    function usuarioDeslogado(){
        console.log("O usuário não conectado com o Facebook.");
        $(btnLogin).show();
    }
    
    // verifica se o usuário está logado e executa ações
    function verificaLogado(){
        FB.getLoginStatus(function(response) {
            if(response.status === "connected"){
                usuarioLogado();
            }else{
                usuarioDeslogado();
            }
        });
    }
    
    