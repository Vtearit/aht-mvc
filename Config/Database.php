<?php
namespace mvc\Config;
use PDO;
class Database
{
    private static $bdd = null;

    private function __construct() {
    }

    public static function getBdd() {
        if(is_null(self::$bdd)) {
            self::$bdd = new PDO("mysql:host=localhost;dbname=mvc;port=3307", 'root', '');
        }
        return self::$bdd;
    }
}
?>