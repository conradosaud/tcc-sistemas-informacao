$(document).ready(function(){
    //console.log("btnFlutuante operando");

    function toggleBtnFlutuante(){
        alert("oee");
        var input = $(".txtBtnFlutuante input");
        if(input.is(":visible")){
            input.hide(); 
            input.val("");
        }else{
            input.show();
            input.focus();
        }
    }
    
    $("#btnPesquisarFlutuante").click(function(){
        var input = $(".txtBtnFlutuante input");
        input.show();
        input.focus();
    });
    $(".txtBtnFlutuante input").blur(function(){
        var input = $(".txtBtnFlutuante input");
        if(input.val().length > 1){
            return false;
        }
        input.hide(); 
        input.val("");
    });

});