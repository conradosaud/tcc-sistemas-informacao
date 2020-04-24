$(document).ready(function(){

    var clicando = false;
    var mouseriding = false;

    $(".bloco a").click(function(e){
        e.preventDefault();
         console.log("zz");
    });
    
    // Para desktop **************
    $(".bloco a, .bloco-card, .mini-card").bind("mousedown touchstart", function(){
       clicando = true;
       mouseriding = false;
    });
    $(".bloco a, .bloco-card, .mini-card").bind("mouseup touchend", function(){
        if(clicando && mouseriding){
            mouseriding = false;
            clicando = false;
        }else{
            var href;
            href = $(this).find(".hiddenCardClick").attr("href");
            if(href == null){
                href = $(this).attr("href");
            }
            window.location.href = href;
        }
    });
    $('.bloco a, .bloco-card, .mini-card').bind("mousemove touchmove", function(){
        mouseriding = true;
    });

});


