<?php

interface InterfaceValidar {
    public function criaObjeto($array); //cria um objeto com os dados do array
    public function validarDados($objeto); //valida campos
    public function inserirBanco($objeto); //insere no banco
}
