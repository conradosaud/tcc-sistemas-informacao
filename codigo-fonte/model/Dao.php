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
        $db = new PDO("mysql:host=localhost;dbname=banco;charset=utf8","root","");
        $db->setAttribute(PDO::ATTR_AUTOCOMMIT, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}

