$(document).ready(function(){

    $("#txtPesquisar").keyup(function(event){
        if(event.keyCode == 13){
            pesquisar();
        }
    });
    
    $(".btnPesquisar").click(function(){
        if($(".btnFlutuante").is(":visible")){
           if($("#txtPesquisarFlutuante").val().length < 1){
               return false;
           }
        }
        pesquisar();
    });
    
    function pesquisar(){
        var texto = "";
        
        if($(".btnFlutuante").is(":visible")){
            texto = $("#txtPesquisarFlutuante").val();
        }else{
            texto = $("#txtPesquisar").val();
        }

        window.location.href = "anunciados.php?Pesquisa="+texto;
    }
    
});


