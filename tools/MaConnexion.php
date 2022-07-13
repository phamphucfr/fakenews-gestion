<?php

class MaConnexion {
    // Attributs
    private static $url = "mysql:host=127.0.0.1:3306;dbname=phamphucfr;charset=utf8";
    private static $user = "root";
    private static $pass = "";
    
    static function connect(){
        return new PDO(MaConnexion::$url, MaConnexion::$user, MaConnexion::$pass);
    }
}
?>
