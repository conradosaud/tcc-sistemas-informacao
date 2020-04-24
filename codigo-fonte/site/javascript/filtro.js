$(document).ready(function(){

    /*
     * C = categoria
     * A = avaliações
     * O = opções
     * I = informações
     * F = funcionamento
     */

    var marcados = [];
    
    function iniciaScript(){
        getMarcadosInicial();
    };
    
    function getMarcadosInicial(){
        if($("#bodyHome").is(":visible")){
            marcados.push({id: "cb0", tipo: "C", value: "Todos"});
            marcados.push({id: "cb14", tipo: "A", value: "Recomendados"});
            marcados.push({id: "cb36", tipo: "F", value: "Todos"});
        }
        
    }
    
    function setMarcados(form){
        $.each(form.find("input"), function(){
           if($(this).is(":checked")){
               console.log($(this).val());
           }
        });
    }
    
    // Controla a marcação dos checkbox
    $("#marcarDesmarcar").click(function(e){
        e.preventDefault();
        
        if($(this).text() == "Desmarcar todos"){
            $.each($(".checkboxList input"), function(){
                if($(this).attr("rel-tipo") == "C"){
                    $(this).removeAttr("checked");
                }
            });
            $(this).html("<strong>Marcar todos</strong>");
            
            for (var i = 0; i < marcados.length; i++) {
                if(marcados[i].value == "Todos"){
                    marcados.splice(i, 1);
                }
            }
            
        }else{
            $.each($(".checkboxList input"), function(){
                if($(this).attr("rel-tipo") == "C"){
                    $(this).attr("checked", "checked");
                }
            });
            $(this).html("<strong>Desmarcar todos</strong>");
        }
    });
    
    $(".checkboxList input").change(function(){
        if($(this).is(":checked")){
            marcados.push({id:$(this).attr("id"),tipo: $(this).attr("rel-tipo"), value: $(this).next().text()});
        }else{
            for (var i = 0; i < marcados.length; i++) {
                if(marcados[i].value == $(this).next().text()){
                    marcados.splice(i, 1);
                }
            }
        }
    });
    
    $(".btnEnviarMarcados").click(function(e){
        e.preventDefault();
        
        var url = "filtro=on";
        
        var categoria = "&C=";
        var avaliacoes = "&A=";
        var opcoes = "&O=";
        var informacoes = "&I=";
        var funcionamento = "&F=";
        
        for (var i = 0; i < marcados.length; i++) {
            switch(marcados[i].tipo){
                case "C": categoria += "%"+marcados[i].value;break;
                case "A": avaliacoes += "%"+marcados[i].value;break;
                case "O": opcoes += "%"+marcados[i].value;break;
                case "I": informacoes += "%"+marcados[i].value;break;
                case "F": funcionamento += "%"+marcados[i].value;break;
            }
        }
        
        if(categoria.length > 3){url += categoria;}
        if(avaliacoes.length > 3){url += avaliacoes;}
        if(opcoes.length > 3){url += opcoes;}
        if(informacoes.length > 3){url += informacoes;}
        if(funcionamento.length > 3){url += funcionamento;}
        
        window.location.href = "anunciados.php?"+url;
    });
    
    iniciaScript();
    
});


