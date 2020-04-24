
$(document).ready(function(){if($("#viewDuvidasEAjuda").is(":visible")){
    console.log("jQuery operando na view duvidas_e_ajuda.php");
    // --------------------------------------------------------
    
    /* Glossário
     * 
     * 
     */
    
    // variaveis globais
    var mainForm = "";
    var mainFormNome = "";
    
    // função chamada quando se inicia o script
    function iniciaScript(){//iniciaScript-sumario
        $(".painel-duvidas").find(".panel-body").hide();
    }
    
    // --------------------------------------------------------
    /* Operações gerais */
    
    function enviaAjax(){
        $.ajax({
            type: 'POST',
            url: '../php/validarEditarAnuncio.php',
            data: form_data,
            success: function (data) {
                //console.log(data);
                if(data){
                    
                }else{
                    var erro = "<strong>Erro ao cadastrar empresa: </strong>";
                    erro += "verifique os valores digitados e tente novamente.";
                    mostraDialogo(erro, "danger", 6000);
                }
            },
            error: function (data) {
                console.log("ERRO [X]");
                console.log(data);
                var erro = "<strong>Erro X</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            }
        });
    }
    
    
    // --------------------------------------------------------
    /* Validadores de formulários */
    
    
    
    
    // --------------------------------------------------------
    /* Operações com formulários */
    
    
    
    // -----------------------------------------------------------
    /* Operações com cliques e botões */
    
    $(".panel-heading").click(function(e){
        $(this).closest(".panel").find(".panel-body").slideToggle(200);
    });
    
    
    // -----------------------------------------------------------
    
    iniciaScript();
    
}});