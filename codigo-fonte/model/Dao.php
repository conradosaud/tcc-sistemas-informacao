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
        $db = new PDO("mysql:host=179.188.16.205;dbname=busca_bd;charset=utf8","busca_bd","ConradoGame100");
        $db->setAttribute(PDO::ATTR_AUTOCOMMIT, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}

