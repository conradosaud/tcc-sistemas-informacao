$(document).ready(function(){
    
    $(".multi-endereco").click(function(e){
        e.preventDefault();
        
        var data_end = $(this).attr("data-end");
        
        if($(".card-group[data-end="+data_end+"]").is(":visible")){
            return;
        }
        
        $(".card-group").slideUp(200, function(){
            $(".card-group[data-end="+data_end+"]").slideDown(200);
        });
    });
    
    function animarRolagem(div, tempo){
	$('html, body').animate({
		scrollTop: $(div).offset().top - 100
	}, tempo);
    }
    
    $(".btn-circle-sm, .btn-circle").click(function(e){
        e.preventDefault();
        
        var icon = $(this).find("i");

        if(icon.hasClass("fa-facebook-square")){
            animarRolagem($(".card-deck-overflow"), 1500);
        }
        if(icon.hasClass("fa-clock-o")){
            animarRolagem($("#divFuncionamento"), 1500);
        }
        if(icon.hasClass("fa-phone-square")){
            animarRolagem($(".card-group"), 1500);
        }
        if(icon.hasClass("fa-map-marker")){
            animarRolagem($("#map"), 2000);
        }
        if(icon.hasClass("fa-comment")){
            animarRolagem($("#divComentariosFb"), 2000);
        }
    });
    
    $(".vaParaEnderecos").click(function(e){
        e.preventDefault();
        animarRolagem($(".card-group"), 800);
    });
    
});

