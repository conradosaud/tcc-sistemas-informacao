<?php

interface InterfaceREST {
    public function get($action, $obj);
    public function post($action, $obj);
    public function put($action, $objAtual, $objNovo);
    public function delete($action, $obj);
}
