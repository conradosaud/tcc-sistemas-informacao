
function initMap() {
    var franca = {lat: -20.5389191, lng: -47.4012037};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: franca
    });   

        var marker;

        $.each($(".hiddenMap"),function(){
            var aux = $(this).val();
            aux = aux.split("|");
            var position = {lat: parseFloat(aux[0]), lng: parseFloat(aux[1])};
            marker = new google.maps.Marker({
                position: position,
                map: map,
                center: position
            });
        });
      
           
    

}
