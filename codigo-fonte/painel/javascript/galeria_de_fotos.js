
$(document).ready(function(){if($("#viewGaleriaDeFotos").is(":visible")){
    console.log("jQuery operando na view galeria_de_fotos.php");
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
        verificaPreenchido();
    }
    
    // --------------------------------------------------------
    /* Operações gerais */
    
    function enviaAjaxTornarPrincipal(){
        var obj = $(".divImagem").find("input[type=checkbox]:checked").attr("name");
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_galeria_de_fotos.php',
            data: "hiddenTornarPrincipal=true&ImgPrincipal="+obj,
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    location.reload();
                }else{
                    var erro = "<strong>Erro tornar imagem principal: </strong>";
                    erro += "verifique a imagem selecionada e tente novamente.";
                    mostraDialogo(erro, "danger", 6000);
                }
            },
            error: function (data) {
                console.log("ERRO [175]");
                console.log(data);
                var erro = "<strong>Erro 175</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            }
        });
    }
    
    function enviaAjaxRemover(){
        var obj = [];
        $.each($(".divImagem").find("input[type=checkbox]:checked"), function(){
           obj.push($(this).attr("name")); 
        });
        $.ajax({
            type: 'POST',
            url: '../php/funcoes_galeria_de_fotos.php',
            data: "hiddenRemover=true&ImgRemover="+obj,
            success: function (data) {
                console.log(data);
                if(data == "1"){
                    location.reload();
                }else{
                    var erro = "<strong>Erro tornar imagem principal: </strong>";
                    erro += "verifique a imagem selecionada e tente novamente.";
                    mostraDialogo(erro, "danger", 6000);
                }
            },
            error: function (data) {
                console.log("ERRO [176]");
                console.log(data);
                var erro = "<strong>Erro 176</strong><br>Um erro inesperado aconteceu, tente novamente.";
                erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                mostraDialogo(erro, "danger", 6000);
            }
        });
    }
    
    
    
    // --------------------------------------------------------
    /* Validadores de formulários */
    
    
    
    
    // --------------------------------------------------------
    /* Operações com formulários */
    
    
    // armazena a imagem do botão upload para o album
    $('#btnAdicionarImagem').change(function (event) {

        var file_data = $('#btnAdicionarImagem').prop('files');

        // verifica se é uma imagem
        for (var i = 0; i < file_data.length; i++) {
            if(!file_data[i].type.match(/image.*/)) {
                mostraDialogo("<strong>Erro ao adicionar imagem.</strong><br>O tipo de arquivo que você está tentando selecionar não é válido. Tenha certeza de adicionar imagens com o formato <strong>jpg</strong> ou <strong>png</strong>.","danger",6000);
                return false;
            }
        }
        
        var form_data = new FormData();  
        
        if( ($(".divImagem").length + file_data.length) >= 9 ){
            mostraDialogo("<strong>Erro ao adicionar imagem.</strong><br>O número de imagens que você está tentando adicionar está acima do limite.","warning",3000);
            return false;
        }
        
        for (var i = 0; i < file_data.length; i++) {
            form_data.append('fileAlbum', file_data[i]);
       
            $.ajax({
                type: 'POST',
                url: '../php/funcoes_galeria_de_fotos.php',
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                data: form_data,
                beforeSend: function() {
                    $("#divAguarde").show();
                },
                success: function (data) {
                    console.log(data);
                    if(data == "1"){
                        //console.log("");
                    }else{
                        //mostraDialogo("<strong>Erro ao adicionar imagem.</strong><br>O tipo de arquivo que você está tentando selecionar não é válido. Tenha certeza de adicionar imagens com o formato <strong>jpg</strong> ou <strong>png</strong>.","danger",6000);
                    }
                },
                error: function (data) {
                    console.log("ERRO [544]");
                    console.log(data);
                    var erro = "<strong>Erro 544</strong><br>Um erro inesperado aconteceu, tente novamente.";
                    erro +=" Se o problema persistir, contate nossa equipe de suporte.";
                    mostraDialogo(erro, "danger", 6000);
                   
                },
                complete: function(){
                    setTimeout(location.reload(), 3000);
                }
            });
        }
    });
    
    function verificaPreenchido(){
        var porcentagem = 0;
        
        if($(".divImagem").length >= 1){
            porcentagem += 25;
        }
        if($(".divImagem").length >= 2){
            porcentagem += 25;
            $("#porcentagemImagem").hide();
        }else{
            $("#porcentagemImagem").show();
        }
        if($(".divImagem").find(".panel-primary").length == 1){
            porcentagem += 50;
            $("#porcentagemPrincipal").hide();
        }else{
            $("#porcentagemPrincipal").show();
        }
        
        verificaBarra(porcentagem);
        
        $(".spanPorcentagem").text(porcentagem);
        $("div .progress-bar").attr("aria-valuenow", porcentagem);
        $("div .progress-bar").css("width", porcentagem+"%");
    }
    
    // verifica a porcentagem da barra para adicionar ou remover classes
    function verificaBarra(porcentagem){
        if(porcentagem == 100){
            $("div .progress-bar").removeClass("progress-bar-primary").addClass("progress-bar-success");
            $("div .progress").removeClass("progress-striped active");
            $(".spanItensRestantes").hide();
            $("div .progress").css("margin-bottom", "-10px");
        }else{
            $("div .progress-bar").removeClass("progress-bar-success").addClass("progress-bar-primary");
            $("div .progress").addClass("progress-striped active");
            $(".spanItensRestantes").show();
            $("div .progress").css("margin-bottom", "10px");
            
        }
    }
    
    // -----------------------------------------------------------
    /* Operações com cliques e botões */
    
    $("#btnRemover").click(function(e){
        e.preventDefault();
        
        if($(".divImagem").find("input[type=checkbox]:checked").length >= 1){
            $("#modalExcluirImagem").modal("show");
        }else{
            mostraDialogo("<strong>Erro ao remover imagens:</strong><br>Nenhuma imagem está selecionada.", "warning", 3000);
        }
    });
     $("#btnRemoverConfirma").click(function(e){
          enviaAjaxRemover();
     });
    
    $("#btnTornarPrincipal").click(function(e){
        e.preventDefault();
        
        if($(".divImagem").find("input[type=checkbox]:checked").length == 1){
            enviaAjaxTornarPrincipal();
        }else{
            mostraDialogo("<strong>Erro ao tornar imagem principal:</strong><br>Somente uma imagem pode ser a principal do seu album. Selecione apenas a imagem que deseja tornar principal.", "warning", 3000);
        }
    });
    
    
    // -----------------------------------------------------------
    
    iniciaScript();
    
}});