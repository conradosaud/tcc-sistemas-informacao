<?php

interface InterfaceCRUD {
    public function buscaTodos(); //busca todos os itens
    public function busca($id); //busca um item em especifico pelo parametro passado (geralmente id)
    public function altera($atual, $novo); //altera um item. O item passado deve seru m objeto da propria classe
    public function insere($objeto); //insere um novo item. O item passado deve ser um objeto da propria classe
    public function remove($id); //remove um item pelo parametro passado (geralmente id)
}
