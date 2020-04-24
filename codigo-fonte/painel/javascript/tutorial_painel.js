
$(document).ready(function(){
    console.log("jQuery tutorial_painel.php operando");
    // --------------------------------------------------------
    
    /* Glossário
     * 
     * 
     */
    
    // variaveis globais
    var mainForm = "";
    var mainFormNome = "";
    var tutorialContador = 0;
    
    // função chamada quando se inicia o script
    function iniciaScript(){//iniciaScript-sumario
        if (typeof tutorial != "undefined") {
            iniciaTutorial();
        }
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
    /* Operações com formulários */
    
    function iniciaTutorial(){
        if($("#viewInicio").is(":visible")){
            tutorialContador = 1;
        }
        if($("#viewVisaoGeral").is(":visible")){
            if($("#etapa12").is(":visible")){
                tutorialContador = 12;
            }else if($("#etapa14").is(":visible")){
                tutorialContador = 13;
            }else{
                tutorialContador = 4;
            }
        }
        if($("#viewApresentacao").is(":visible")){
            tutorialContador = 8;
        }
        if($("#viewEnderecosEContatos").is(":visible")){
            tutorialContador = 10;
        }
        $(".tutorial").show();
        tutorialNext();
    }
    
    function tutorialNext(){
        $(".tutorial-destaque").remove();
        $(".tutorial-apresentacao").remove();
        var titulo, texto, html;
        switch(tutorialContador){
            case 1:
                titulo = "Bem-vindo ao painel do usuário.";
                texto = "Neste painel você administra todos os recursos do anúncio da sua empresa, tais como editar as informações do seu anúncio, visualizar relatórios, ativar planos, e outros.";
                html = criaApresentacao(titulo, texto, true);
                $("#etapa1").addClass("tutorial-destaque");
		$("#etapa1").before(html);
                animarRolagem($(".tutorial-apresentacao"), 1500);
                break;
            case 2:
                titulo = "Acesse o menu Editar Meu Anúncio.";
                texto = "O primeiro passo aqui é inserir informações no seu anúncio, essas são as informações que todos os usuários irão ver. Clique no botão <strong><i class='fa fa-pencil'></i> Editar meu anúncio</strong> para prosseguir.";
                html = criaApresentacao(titulo, texto, false);
                $("#etapa2").addClass("tutorial-destaque");
		$("#etapa2").before(html);
                animarRolagem($(".tutorial-apresentacao"), 1500);
                break;
            case 3:
                window.location.href = "../view/visao_geral.php?tutorial=1";
                break;
            case 4:
                titulo = "Visão Geral do seu anúncio.";
                texto = "Nesta página você pode visualizar o quão completo o seu anúncio está e ter uma visão geral dele.";
                html = criaApresentacao(titulo, texto, true);
                $("#etapa4").addClass("tutorial-destaque");
		$("#etapa4").before(html);
                animarRolagem($(".tutorial-apresentacao"), 1500);
                break;
            case 5:
                titulo = "Anúncio ativo ou inativo.";
                texto = "Esta é a situação do seu anúncio no momento. Anúncios desativados ou incompletos não podem ser visitados pelos usuários. Para ativá-lo, é necessário preencher algumas informações básicas em seu anúncio.";
                html = criaApresentacao(titulo, texto, true);
                $("#etapa5").addClass("tutorial-destaque");
		$("#etapa5").before(html);
                animarRolagem($(".tutorial-apresentacao"), 1500);
                break;
            case 6:
                titulo = "Editar Apresentação do anúncio.";
                texto = "Um dos principais itens do anúncio é sua <strong>Apresentação</strong>, onde você define o nome que será exibido aos usuários e suas descrições. Clique no botão <strong>Preencher Agora <i class='fa fa-angle-right'></i></strong> para seguir a página de edições da sua apresentação.";
                html = criaApresentacao(titulo, texto, false);
                $("#etapa6").addClass("tutorial-destaque");
		$("#etapa6").before(html);
                animarRolagem($(".tutorial-apresentacao"), 1500);
                break;
            case 7:
                window.location.href = "../view/apresentacao.php?tutorial=1";
                break;
            case 8:
                titulo = "Apresentação do seu anúncio.";
                texto = "A apresentação do seu anúncio é uma das partes mais importantes. É neste painel onde você define qual o nome que será exibido para os usuários e também as descrições do seu negócio que você deve utilizar para atrair o público.";
                html = criaApresentacao(titulo, texto, true);
                $("#etapa8").addClass("tutorial-destaque");
		$("#etapa8").before(html);
                animarRolagem($(".tutorial-apresentacao"), 1500);
                break;
            case 9:
                titulo = "Preencha o formulário de apresentação.";
                texto = "Você deve preencher todas as informações do formulário de apresentação para poder ativar o seu anúncio. Preencha os campo abaixo e ao terminar, clique no botão <strong><i class='fa fa-save'></i> Salvar</strong> para realizar as alterações no seu anúncio ou utilize o botão <strong>Salvar e prosseguir <i class='fa fa-arrow-right'></i></strong> para salvar as alterações e seguir para o próximo formulário.";
                html = criaApresentacao(titulo, texto, false);
                $("#etapa9").addClass("tutorial-destaque");
		$("#etapa9").before(html);
                animarRolagem($(".tutorial-apresentacao"), 1500);
                break;
            case 10:
                titulo = "Endereços e contatos do seu anúncio.";
                texto = "Neste painel você pode inserir os endereços e contatos de todas as empresas que você tem. Caso possua mais de uma filial, você pode adicionar todos seus endereços aqui. Este é o último formulário que você precisa preencher para ativar seu anúncio.";
                html = criaApresentacao(titulo, texto, true);
                $("#etapa10").addClass("tutorial-destaque");
		$("#etapa10").before(html);
                animarRolagem($(".tutorial-apresentacao"), 1500);
                break;
            case 11:
                if($(".formExistente").is(":visible")){
                    window.location.href = "../view/visao_geral.php?tutorial=1";
                }
                titulo = "Adicione um novo registro.";
                texto = "Preencha o formulário com as informações da sua empresa. Mesmo que você não trabalhe atendendo clientes diretamente em seu local, é necessário informar ao menos alguma informação para contato. Todas as informações aqui inseridas são visíveis aos usuários.<br>Neste momento, cadastre seu primeiro endeço e clique no <strong><i class='fa fa-save'></i> Salvar</strong> para realizar as alterações no seu anúncio ou utilize o botão <strong>Salvar e prosseguir <i class='fa fa-arrow-right'></i></strong> para salvar as alterações e seguir para o próximo formulário. Se desejar cadastrar mais endereços você pode voltar neste painel mais tarde.";
                html = criaApresentacao(titulo, texto, false);
                $("#etapa11").show();
                $("#etapa11").addClass("tutorial-destaque");
		$("#etapa11").before(html);
                animarRolagem($(".tutorial-apresentacao"), 1500);
                break;
            case 12:
                titulo = "Ative seu anúncio.";
                texto = "Os requisitos mínimos para a ativação do seu anúncio foram concluídas! Para ativar seu anúncio clique em <strong><i class='fa fa-power-off'> Ativar anúncio</i></strong>.<br>Se desejar preencher mais informações sobre seu anúncio antes de deixá-lo disponível aos usuários, basta prosseguir.";
                html = criaApresentacao(titulo, texto, true);
                $("#etapa12").addClass("tutorial-destaque");
		$("#etapa12").before(html);
                animarRolagem($(".tutorial-apresentacao"), 1500);
                break;
            case 13:
                titulo = "Parabéns, você concluiu o tutorial.";
                texto = "Você chegou ao final do tutorial. Você pode preencher as demais informações do seu anúncio e deixá-lo completo, lembre-se que quanto mais completo seu anúncio for, mais visitado ele será.<br><br> Você também pode realizar outras operações dentro do painel do usuário através do menu lateral esquerdo (ou superior em tablets e celulares), inclusive, neste menu, você possui a opção <strong><i class='fa fa-question-o'></i> Dúvidas e informações</strong> e pode consultá-la sempre que quiser.<br>Obrigado por participar!";
                html = criaApresentacao(titulo, texto, true);
                $("#etapa13").addClass("tutorial-destaque");
		$("#etapa13").before(html);
                animarRolagem($(".tutorial-apresentacao"), 1500);
                break;
            case 14:
                window.location.href = "visao_geral.php";
                break;
        }
    }
    
    function criaApresentacao(titulo, texto, botao){
	var html = "";
	
	html += '<div class="row tutorial-apresentacao">';
	html +=    '<div class="col-md-12">';
	html +=        '<a href="#" class="close"><i class="fa fa-close" id="btnSairTutorial"></i></a>';
	html +=        '<span style="opacity: 0.6">Etapa '+(tutorialContador)+' de 13</span>';
	html +=        '<h3 style="margin-top:5px;">'+titulo+'</h3>';
	html +=        '<p>'+texto+'</p>';
	html +=    '</div>';
	if(botao){
		html +=    '<div class="col-md-12 text-right">';
		html +=        '<a href="#" class="btn btn-branco btn-tutorial" style="text-shadow: none;">Prosseguir <i class="fa fa-arrow-right"></i></a>';
		html +=    '</div>';
	}
	html += '</div>';
	
	return html;
    }
    
    function finalizarTutorial(){
        window.location.href = "inicio.php";
    }
    
    function animarRolagem(div, tempo){
        $("html, body").animate({ scrollTop: div.height()-120 }, tempo);
    }
    
    // -----------------------------------------------------------
    /* Operações com cliques e botões */
    
    $(".btn-tutorial-ativar").click(function(e){
        e.preventDefault();
        if($(".tutorial").is(":visible")){
            window.location.href = "../php/funcoes_visao_geral.php?Anunciando=1&tutorial=1";
        }else{
           window.location.href = "../php/funcoes_visao_geral.php?Anunciando=1";
        }
    });
    
    $(document).on("click", ".btn-tutorial", function(e){
        if($(".tutorial").is(":visible")){
            e.preventDefault();
            tutorialContador++;
            tutorialNext();
        }
    });
    
    $(document).on("click", "#btnSairTutorial", function(e){
        e.preventDefault();
        finalizarTutorial();
    });
    
    
    // -----------------------------------------------------------
    
    iniciaScript();
    
});