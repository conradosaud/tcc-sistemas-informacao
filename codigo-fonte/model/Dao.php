<?php

class Dao{
    private static $db;
    
    public function instance(){
        if(!self::$db){
            self::$db = $this->connect();
        }
        return self::$db;
    }
    
    private function connect(){
        //$db = new PDO("mysql:host=localhost;dbname=busca;charset=utf8","root","");
        $db = new PDO("mysql:host=localhost;dbname=nome_banco;charset=utf8","root","");
        $db->setAttribute(PDO::ATTR_AUTOCOMMIT, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}

