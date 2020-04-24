// --------------------------------------------------------
/* API Maps */
function initMap() {
    var franca = {lat: -20.5389191, lng: -47.4012037};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: franca
    });

    var marker;
    $.ajax({
        type: 'POST',
        url: '../php/funcoes_integracao_com_maps.php',
        data: "buscaMaps=true",
        success: function (data) {
            console.log(data);
            if(data == "nenhumaCoordenada"){
                console.log("Sem coordenadas.");
                return false;
            }
            var obj = JSON.parse(data);
            for (var i = 0; i < obj.length; i++) {
                var position = {lat: parseFloat(obj[i].latitude), lng: parseFloat(obj[i].longitude)};
                marker = new google.maps.Marker({
                    position: position,
                    map: map
                });
                if(i == obj.length - 1){
                    map.setCenter(marker.getPosition()); 
                }
            }
        },
        error: function (data) {
            console.log("ERRO @@@@@@@@@@@");
            console.log(data);
        }
    });
   
    
/*
    var marker;

    marker = new google.maps.Marker({
        position: myLatLng,
        map: map
      });
      
      // cria marcadores
    marker = new google.maps.Marker({
        position: franca,
        map: map
      });

      // clique no marcador
    marker.addListener('click', function() {
        console.log("clicou né");
      });
      
      // converte endereço em geoposicao
        */
}

// tira os espaços do endereço para enviar via ajax
function formatUrl(url){
    url.replace(" ", "+");
    return url;
}
    
// --------------------------------------------------------

$(document).ready(function(){if($("#viewIntegracaoComMaps").is(":visible")){
    console.log("jQuery operando na view integracao_com_maps.php");
    // --------------------------------------------------------
    
    /* Glossário
     * 
     * 
     */
    
    // variaveis globais
    var tentativaLocalizar = false;
    
    
    // função chamada quando se inicia o script
    function iniciaScript(){//iniciaScript-sumario
       
    }
    
    // --------------------------------------------------------
    /* Operações gerais */
    
    function getLatLong(elemento, id, status){
        var endereco = 
            (elemento.closest("tr").find("td:nth-child(2)").text()).replace(/ /g, '+')+"+"+
            (elemento.closest("tr").find("td:nth-child(3)").text()).replace(/ /g, '+')+"+"+
            (elemento.closest("tr").find("td:nth-child(4)").text()).replace(/ /g, '+')+"+"+
            (elemento.closest("tr").find("td:nth-child(1)").text()).replace(/ /g, '+')+"+"+
            "Franca+SP";
        $.ajax({
            type: 'GET',
            url: 'https://maps.googleapis.com/maps/api/geocode/json?address='+endereco+'&key=AIzaSyCKIna3T2Vanf1w1aJ75_84UHuOjmUD5EI',
            success: function (data) {
                console.log(data);
                if(data.status=="OK"){
                    var obj = {Latitude:data.results[0].geometry.location.lat,
                    Longitude: data.results[0].geometry.location.lng};
                    enviaAjax(id, status, obj.Latitude, obj.Longitude);
                }else{
                    var erro = "<strong>Localização não encontrada: </strong>";
                    erro += "não foi possível localizar seu endereço no mapa. Verifique se as informações do endereço cadastrado estão corretas e tente novamente.";
                    mostraDialogo(erro, "warning", 6000);
                    $(".btnAtivar, .btnDesativar").show();
                    $(".carregando").hide();
                    tentativaLocalizar = id;
                }
            },
            error: function (data) {
                console.log("ERRO [770]");
                console.log(data);
                var erro = "<strong>Erro 770</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            }
        });
    }
    
    function enviaAjax(id, status, latitude, longitude){
        var form = "hiddenMaps=true&IdEndereco="+id+"&Status="+status;
        if(latitude && longitude){
            form += "&Latitude="+latitude+"&Longitude="+longitude;
        }
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_integracao_com_maps.php',
            data: form,
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    location.reload();
                }else{
                    var erro = "<strong>Erro ao ativar integração: </strong>";
                    erro += "verifique os valores digitados e tente novamente. Se o problema persistir, contate nossa equipe de suporte.";
                    mostraDialogo(erro, "danger", 6000);
                }
            },
            error: function (data) {
                console.log("ERRO [766]");
                console.log(data);
                var erro = "<strong>Erro 766</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            }
        });
    }
    
    function erroLocalizar(){
        var erro = "<strong>Localização não encontrada: </strong>";
        erro += "não foi possível localizar seu endereço no mapa. Verifique se as informações do endereço cadastrado estão corretas e tente novamente.";
        return erro;
    }
    
    
    // --------------------------------------------------------
    /* Validadores de formulários */
    
    
    
    
    // --------------------------------------------------------
    /* Operações com formulários */
    
    
    
    // -----------------------------------------------------------
    /* Operações com cliques e botões */
    
    $(".btnAtivar, .btnDesativar").click(function(e){
        e.preventDefault();

        $(".btnAtivar, .btnDesativar").hide();
        $(".carregando").show();
        
        var id = $(this).attr("name");
        var status = ($(this).hasClass("btnAtivar")?"A":"I");
        
        if(status == "I"){
            enviaAjax(id, status);
        }else{
            if(tentativaLocalizar == id){
                mostraDialogo(erroLocalizar(), "warning", 6000);
                $(".btnAtivar, .btnDesativar").show();
                $(".carregando").hide();
                return false;
            }else{
                getLatLong($(this), id, status);
            }
        }
    });
    
    
    // -----------------------------------------------------------
    
    iniciaScript();
    
}});