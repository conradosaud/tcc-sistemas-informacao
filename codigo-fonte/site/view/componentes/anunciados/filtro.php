
<!-- Filtro -->
<div class="col-12 col-lg-3 col-xl-3" style="padding: 0; margin-bottom: 15px;">
    <div class="row">
        <div class="col-12" style="margin-bottom: 10px;">
            <a class="btn bg-color-primary-btn" href="home.php"><i class="fa fa-arrow-left"></i> Voltar</a>
        </div>
    </div>
    <div class="row menu-filtro-cabecalho">
        <div class="col-6 text-left">
            <button class="btn btn-sm btn-default toggleFiltro" style="cursor: pointer;"><i class="fa fa-minus"></i></button>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-sm btnFiltrar bg-color-secondary-btn btnEnviarMarcados">Filtrar <i class="fa fa-filter"></i></button>
        </div>
    </div>
    <div class="menu-filtro hidden-md-down">
        <div class="row" id="listasCheckbox">
            <div class="col-12">
                <a href="#" class="filtroAnunciados"><i class="fa fa-plus"></i> &nbsp; Categoria</a>
                <section style="max-height: 200px;">
                    <form class="" autocomplete="off">
                        <ul class="checkboxList" style="overflow-x: hidden;">
                            <li><a style="color: #664B3A; text-decoration: underline;" href="#" id="marcarDesmarcar" class="link-color-secondary"><strong>Desmarcar todos</strong></a></li>
                            <li><input id="cb1" name="cb1" type="checkbox" rel-tipo="C" checked><label for="cb1">Pizzaria</label></li>
                            <li><input id="cb2" name="cb2" type="checkbox" rel-tipo="C" checked><label for="cb2">Lanche</label></li>
                            <li><input id="cb3" name="cb3" type="checkbox" rel-tipo="C" checked><label for="cb3">Salgadaria/Pastelaria</label></li>
                            <li><input id="cb4" name="cb4" type="checkbox" rel-tipo="C" checked><label for="cb4">Restaurante</label></li>
                            <li><input id="cb5" name="cb5" type="checkbox" rel-tipo="C" checked><label for="cb5">Bar/Pub</label></li>
                            <li><input id="cb6" name="cb6" type="checkbox" rel-tipo="C" checked><label for="cb6">Sorveteria/Açaizeiro</label></li>
                            <li><input id="cb7" name="cb7" type="checkbox" rel-tipo="C" checked><label for="cb7">Doces/Bolos em geral</label></li>
                            <li><input id="cb8" name="cb8" type="checkbox" rel-tipo="C" checked><label for="cb8">Loja de conveniência</label></li>
                            <li><input id="cb9" name="cb9" type="checkbox" rel-tipo="C" checked><label for="cb9">Comida japonesa</label></li>
                            <li><input id="cb10" name="cb10" type="checkbox" rel-tipo="C" checked><label for="cb10">Padaria</label></li>
                            <li><input id="cb11" name="cb11" type="checkbox" rel-tipo="C" checked><label for="cb11">Cafeteria</label></li>
                            <li><input id="cb12" name="cb12" type="checkbox" rel-tipo="C" checked><label for="cb12">Supermercado/Merceria</label></li>

                        </ul>
                    </form>
                </section>
            </div>
            <div class="col-lg-12">
                <a href="#" class="filtroAnunciados"><i class="fa fa-plus"></i> &nbsp; Avaliações</a>
                <section class="listasCheckbox" style="display: none;"> 
                    <form class="" autocomplete="off">
                        <ul class="checkboxList">
                            <li><input id="cb14" name="cb14" type="checkbox" checked="true" rel-tipo="A"><label for="cb14"><strong>Recomendados</strong></label></li>
                            <li><input id="cb15" name="cb15" type="checkbox" rel-tipo="A"><label for="cb15"><strong>Com promoções</strong></label></li>
                            <li><input id="cb16" name="cb16" type="checkbox" rel-tipo="A"><label for="cb16">Mais avaliados</label></li>
                            <li><input id="cb17" name="cb17" type="checkbox" rel-tipo="A"><label for="cb17">Mais curtidos</label></li>
                            <li><input id="cb18" name="cb18" type="checkbox" rel-tipo="A"><label for="cb18">Mas comentados</label></li>
                        </ul>
                    </form>
                </section>
            </div>
            <div class="col-lg-12">
                <a href="#" class="filtroAnunciados"><i class="fa fa-plus"></i> &nbsp; Opções</a>
                <section class="listasCheckbox" style="display: none;">
                    <form class="" autocomplete="off">
                        <ul class="checkboxList">
                            <li><input id="cb19" name="cb19" type="checkbox" rel-tipo="O"><label for="cb19">Entregas a domicílio</label></li>
                            <li><input id="cb20" name="cb20" type="checkbox" rel-tipo="O"><label for="cb20">Atende-se no local</label></li>
                            <li><input id="cb21" name="cb21" type="checkbox" rel-tipo="O"><label for="cb21">Com estacionamento</label></li>
                        </ul>
                    </form>
                </section>
            </div>
            <div class="col-12">
                <a href="#" class="filtroAnunciados"><i class="fa fa-plus"></i> &nbsp; Informações</a>
                <section class="listasCheckbox" style="display: none;">
                    <form class="" autocomplete="off">
                        <ul class="checkboxList">
                            <li><input id="cb22" name="cb22" type="checkbox" rel-tipo="I"><label for="cb22">Endeços disponíveis</label></li>
                            <li><input id="cb23" name="cb23" type="checkbox" rel-tipo="I"><label for="cb23">Telefones disponíveis</label></li>
                            <li><input id="cb24" name="cb24" type="checkbox" rel-tipo="I"><label for="cb24">Email disponível</label></li>
                            <li><input id="cb25" name="cb25" type="checkbox" rel-tipo="I"><label for="cb25">Mapa disponível</label></li>
                            <li><input id="cb26" name="cb26" type="checkbox" rel-tipo="I"><label for="cb26">Facebook disponível</label></li>
                        </ul>
                    </form>
                </section>
            </div>
            <div class="col-12 hidden-sm-down">
                <a href="#" class="filtroAnunciados"><i class="fa fa-plus"></i> &nbsp; Funcionamento</a>
                <section  class="listasCheckbox" style="display: none;">
                    <form class="" autocomplete="off">
                        <ul class="checkboxList">
                            <li><input id="cb36" name="cb36" type="checkbox" checked="true" rel-tipo="F"><label for="cb36"><strong>Todos</strong></label></li>
                            <li><input id="cb27" name="cb27" type="checkbox" rel-tipo="F"><label for="cb27">Aberto agora</label></li>
                            <li><input id="cb28" name="cb28" type="checkbox" rel-tipo="F"><label for="cb28">Fechado agora</label></li>
                            <br>
                            <h2 class="text-color-secondary"><strong>Aberto às:</strong></h2>
                            <li><input id="cb29" name="cb29" type="checkbox" rel-tipo="F"><label for="cb29">Segunda-feira</label></li>
                            <li><input id="cb30" name="cb30" type="checkbox" rel-tipo="F"><label for="cb30">Terça-feira</label></li>
                            <li><input id="cb31" name="cb31" type="checkbox" rel-tipo="F"><label for="cb31">Quarta-feira</label></li>
                            <li><input id="cb32" name="cb32" type="checkbox" rel-tipo="F"><label for="cb32">Quinta-feira</label></li>
                            <li><input id="cb33" name="cb33" type="checkbox" rel-tipo="F"><label for="cb33">Sexta-feira</label></li>
                            <li><input id="cb34" name="cb34" type="checkbox" rel-tipo="F"><label for="cb34">Sábado</label></li>
                            <li><input id="cb35" name="cb35" type="checkbox" rel-tipo="F"><label for="cb35">Domingo</label></li>
                        </ul>
                    </form>
                </section>
            </div>
            <div class="col-12 text-right" style="margin-top: 10px; padding: 15px;">
                <button class="btn btn-info bg-color-secondary-btn btnEnviarMarcados">Filtrar <i class="fa fa-filter"></i></button>
            </div>

        </div>


    </div>
</div>
