$(document).ready(function(){
    
    var itensTotal = 0;
    var itensVisiveis = 0;
    var itensLimite = 5;
    
    function iniciaScript(){
        $(".menu-item").hide();
        itensTotal = $("#hiddenQntItensTotal").val();
        carregaMais(true);
        
        if(itensTotal <= itensLimite){
            $("#btnCarregarMais").hide();
        }
    }
    
    /* ------------------------- */
    /* Ajax */
    
    
    /* ------------------------- */
    /* Filtro */
    
    $(".filtroAnunciados").click(function(e){
        e.preventDefault();
        
        $(this).next().slideToggle(200);
    });
    
    /* ------------------------- */
    /* Outros */
    
    
    function carregaMais(iniciaScript){
        var contador = 0;
        $.each($(".menu-item"), function(){
            if(contador < itensLimite){
                if($(this).is(":hidden")){
                    if(iniciaScript){
                        $(this).show();
                    }else{
                        $(this).slideDown(250);
                    }
                    contador++;
                    itensVisiveis++;
                }
            }
        });
        
        if(itensVisiveis == itensTotal){
            $("#btnCarregarMais").prop("disabled", true);
        }
    }
    
    if($(".menu-filtro").is(":hidden")){
        $(".toggleFiltro i").removeClass("fa-minus").addClass("fa-plus");
        $(".btnFiltrar").hide();
    }
    
    function getQntAnuncios(){
        var contador = 0;
        $.each($(".menu-item"), function(){
            contador++;
        });
        
        return contador;
    }
    
    /* ------------------------- */
    /* Botões */
    
    $(".toggleFiltro").click(function(){
       if($(".menu-filtro").is(":visible")){
           //$(".menu-filtro").addClass("hidden-md-down");
           $(".menu-filtro").slideUp(350, function(){
               $(".menu-filtro").addClass("hidden-md-down");
           });
           $(".btnFiltrar").slideUp(200);
           $(".toggleFiltro i").removeClass("fa-minus").addClass("fa-plus");
       }else{
           $(".menu-filtro").removeClass("hidden-md-down", function(){
              $(".menu-filtro").slideDown(350); 
           });
           $(".btnFiltrar").slideDown(200);
           $(".toggleFiltro i").removeClass("fa-plus").addClass("fa-minus");
       }
    });
    
    $("#btnCarregarMais").click(function(){
        carregaMais();
    });
    
    $(".menu-item").click(function(){
        var id = $(this).attr("data-id");
        window.location.href = "anuncio.php?Anuncio="+id;
    });
    
    iniciaScript();
    
});

