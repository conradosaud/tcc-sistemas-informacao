$(document).ready(function(){
    
    var idApp = "375545962881629";
    var senhaApp = "44d9a3c168694d32c15f699a0beb4760";
    var token = idApp+"|"+senhaApp;
    
    // Função chamada para iniciar o SDK do Facebook
    window.fbAsyncInit = function() {
            FB.init({
                    appId      : idApp,
                    cookie     : true,
                    status     : true,
                    xfbml      : true,
                    version    : 'v2.10'
            });

            // * ---------  Primeiras funções a serem chamadas após o SDK

            $(".fbCarregando").show();
            FB.Event.subscribe('xfbml.render', function(response) {
                    $(".fbCarregando").hide();
                    $(".fbCarregado").show();
            });

    };

    // SDK do Facebook
    (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "http://connect.facebook.net/pt_BR/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
    
    function btnEnviar(data){
        console.log(data);
        FB.ui({
            method: 'send',
            link: data
            });
    }
    
    $("#btnEnviar").click(function(e){
       e.preventDefault();
       btnEnviar($(this).attr("data-href"));
    });
    
});