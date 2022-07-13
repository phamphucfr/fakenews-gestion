<?php

class MaConnexion {
    // Attributs
    private static $url = "mysql:host=phamphucfr.sql.free.fr:3306;dbname=phamphucfr;charset=utf8";
    private static $user = "phamphucfr";
    private static $pass = "ANHYEU";
    
    static function connect(){
        return new PDO(MaConnexion::$url, MaConnexion::$user, MaConnexion::$pass);
    }
}
?>
