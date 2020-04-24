<?php
    session_start();
    include_once("../php/funcoes_painel.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            include_once("./fixo/meta.php");
            include_once("./fixo/header.php");
        ?>
        <link href="../css/duvidas_e_ajuda.css" rel="stylesheet" />
    </head>
    <body id="viewDuvidasEAjuda">
        <div id="wrapper">
            
            <?php
                include_once("./fixo/navbar-top.php");
                include_once("./fixo/navbar-side.php");
            ?>
            
            
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><i class="fa fa-info-circle"></i> &nbsp; Dúvidas e Informações</h2>  
                            <h5 style="font-size: 16px;">Dúvidas ou dificuldades em alguma parte do nosso sistema? Veja abaixo nosso FAQ (resposta para dúvidas frequentes) com possíveis soluções.</h5>
                        </div>
                    </div>              
                    <!-- /. ROW  -->
                    <hr />
                    
                    <div class="row">
                        <div class="col-md-12">
                            <p>Clique para ver</p>
                        </div>
                        
                        <div class="col-md-12">
                            <p class="lead">Anúncios</p>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default painel-duvidas">
                                <div class="panel-heading">
                                    <span>Como ativar meu anúncio e deixá-lo visível a todos?</span>
                                </div>
                                <div class="panel-body">
                                    Para ativar seu anúncio e deixá-lo visível para todos os usuários do site visitarem-no, acesse a página
                                    <strong>Menu Geral</strong> no menu <strong>Editar meu anúncio</strong> que pode ser encontrado
                                    no menu lateral esquerdo (ou superior para tablets e celulares). Ao acessar <strong>Visão Geral</strong>,
                                    você verá logo no início da página a situação em que seu anúncio se encontra e um botão para operá-lo, tal
                                    como ativar ou desativar.<br>
                                    Seu anúncio pode se encontrar em três situações:
                                    <ul class="lista-comum">
                                        <li><strong>Anuncio Ativo</strong><br>Indica que seu anúncio já está ativo e pode ser visualizado por todos usuários.</li>
                                        <li><strong>Anuncio Desativado</strong><br>Indica que seu anúncio não está ativo e ninguém pode visualizá-lo.</li>
                                        <li><strong>Anuncio Incompleto</strong><br>Indica que ainda falta informações importantes para serem preenchidas em seu anúncio antes de poder ativá-lo. Neste momento, seu anúncio permanece desativado.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default painel-duvidas">
                                <div class="panel-heading">
                                    <span>Onde posso inserir e editar as informações do meu anúncio?</span>
                                </div>
                                <div class="panel-body">
                                    As informações do seu anúncio podem ser editadas e consultadas sempre que quiser. Para isso, utilize o menu <strong>Editar meu anúncio</strong>
                                    localizado no menu lateral esquerdo (ou superior para tablets e celulares). Ao clicar em <strong>Editar me anúncio</strong>
                                    será apresentado sub-menus que indicam qual parte do seu anúncio você deseja editar ou visualizar. Você pode editar todas elas.<br>
                                    Uma vez que as informações do anúncio foram alteradas, é necessário clicar no botão <strong><i class="fa fa-save"></i> Salvar</strong>
                                    (ou no botão <i>Salvar e prosseguir <i class="fa fa-arrow-right"></i></i>) para que as alterações sejam salvas.<br>
                                    As alterações realizadas no seu anúncio são imediatas e podem ser visualizadas logo em seguida.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default painel-duvidas">
                                <div class="panel-heading">
                                    <span>Como faço para visualizar o meu anúncio?</span>
                                </div>
                                <div class="panel-body">
                                    Você pode visualizar seu anúncio de duas formas:<br>
                                    <strong>Opção 1:</strong> clicar no botão <strong><i class="fa fa-eye"></i> Ver meu anúncio</strong>, localizado
                                    no menu lateral esquerdo (ou superior para tablets e celulares). Você será direcionado diretamente para a página
                                    de anúncios (fora do painel) e poderá visualizá-lo exatamente como os outros usuários do site.<br>
                                    <strong>Opção 2:</strong> você também pode procurar o seu anúncio no site através da pesquisa.<br><br>
                                    Ambas as opções só irão exibir seu anúncio se ele estiver <strong>Ativo</strong>.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default painel-duvidas">
                                <div class="panel-heading">
                                    <span>Qual a diferença do meu anúncio e minha empresa?</span>
                                </div>
                                <div class="panel-body">
                                    Cada empresa cadastrada no site possui um anúncio. Neste momento, você está dentro do painel de
                                    sua empresa cadastrada como <strong><?php echo $_SESSION["NomeEmpresa"]; ?></strong>. Neste
                                    momento você pode editar o anúncio da sua empresa que será exibida para os usuários. No anúncio,
                                    você pode exibir informações como descrição, endereço, contatos, imagens, etc.<br>
                                    Sua empresa é apenas uma forma de filtramos seu anúncio e evitar anúncios duplicados, isto é,
                                    empresas diferentes exibindo o mesmo anúncio.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default painel-duvidas">
                                <div class="panel-heading">
                                    <span>Como cadastrar minhas outras empresas?</span>
                                </div>
                                <div class="panel-body">
                                    Antes de cadastrar suas outras empresas no sistema, tenha certeza de duas coisas:
                                    <ul class="lista-comum">
                                        <li><strong>A nova empresa que quer cadastar não é filial da sua atual</strong>
                                            <br>Se a nova empresa que quer cadastrar é uma filial da sua atual empresa, não é necessário criar o registro
                                            de uma empresa secundária. Para isso, basta acessar a página <strong>Endereços e Contato</strong> localizadas
                                            no menu lateral esquerdo (ou superior para tablets e celulares) em <strong>Editar meu anúncio</strong> e adicionar
                                            novos endereços e contatos desta sua nova filial. Desta forma, você evita duplicar anúncios de uma mesma empresa no sistema, e também evita a confusão dos usuários ao consultarem seu anúncio.</li>
                                        <li><strong>É compatível com as cidades disponibilizadas no sitem</strong><br>
                                            Nosso site é focado em publicidade em cidades específicas. Se você possui um mesmo negócio em cidades
                                            diferentes e as mesmas não fazem parte da nossa <a href="#">lista de cidades</a> disponíveis para anúnciar
                                            no site, você não poderá criar uma nova empresa. Nosso sistema está se expandido por todo Brasil, por isso,
                                            pedimos que aguarde até que nossa expansão chegue até você!
                                        </li>
                                    </ul>
                                    <br>
                                    Após confirmar os itens anteriores, para cadastar uma nova empresa, clique no botão <i class="fa fa-cog"></i>
                                    localizado no menu superior, ao lado do nome de sua empresa e selecione 
                                    <strong><i class="fa fa-reply"></i> Voltar para o painel de empresas</strong>. Fazendo isso, você estará
                                    de volta ao painel das empresas que você possui cadastrado. Basta clicar no botão
                                    <strong><i class="fa fa-plus"></i> Cadastrar novo</strong> e preencher o formulário.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default painel-duvidas">
                                <div class="panel-heading">
                                    <span>Como alterar as informações da minha empresa e meu seguimento?</span>
                                </div>
                                <div class="panel-body">
                                    Para alterar as informações de cadastro da sua empresa, clique no botão <i class="fa fa-cog"></i>
                                    localizado no menu superior, ao lado do nome de sua empresa e selecione 
                                    <strong><i class="fa fa-pencil"></i> Editar informações da empresa</strong>. Fazendo isso, 
                                    você será direcionado a página de edição da sua empresa.<br><br>
                                    <strong>Atenção:</strong> cuidado ao alterar as informações de Cidade e Seguimento de sua empresa,
                                    pois eles influenciam fortemente a forma como nossos motores de busca irão trabalhar para exibir
                                    seu anúncio aos usuários do site.
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <p class="lead">Planos</p>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default painel-duvidas">
                                <div class="panel-heading">
                                    <span>O que são os planos para anúncios?</span>
                                </div>
                                <div class="panel-body">
                                    Os planos para anúncios são serviços pagos que você pode contratar para modificar a forma
                                    que nossos motores de buscas trabalhar para exibir sua empresa. Dessa forma, você 
                                    aumentará seu fluxo de visitas, poderá realizar mais vendas de um produto em promoção,
                                    terá uma visibilidade maior de seu anúncio, e consequentemente, ganhará novos freguêses.
                                    <br>Nossos planos possuem um custo muito baixo e retornam sempre um resultado surpreendente.<br>
                                    Acesse nossa página de <a href="planos_para_anuncios.php">planos para anúncios</a> e conheça
                                    detalhadamente nossos serviços e custos.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default painel-duvidas">
                                <div class="panel-heading">
                                    <span>O que são os cupons e como usá-los?</span>
                                </div>
                                <div class="panel-body">
                                    Os cupons são códigos que entregamos a alguns usuários por motivos específicos, duram
                                    um determinado período de tempo e possuem benefícios variados.<br>
                                    Para utilizar um cupom, acesse a página <a href="planos_para_anuncios.php">planos para anúncios</a>
                                    e após digitar o código do seu cupom, clique no botão <strong>Enviar cupom</strong> para
                                    saber mais sobre ele.
                                </div>
                            </div>
                        </div>
                    
                    
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        
        <?php
            include_once("./fixo/scripts.php");
        ?>
        
        <script>
            $("#a_duvidas_e_ajuda").addClass("active-menu");
        </script>
        
        <script src="../javascript/duvidas_e_ajuda.js"></script>
    </body>
</html>
