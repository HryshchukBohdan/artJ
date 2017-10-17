<?php
namespace config;
class Db
{
    private static $db;
    private static $db_name = 'art';
    private static $user    = 'art';
    private static $pwd     = 'art';

    private function __clone() {

        return true;
    }

    private function __wakeup() {

        return true;
    }

    private function __construct($host, $db_name, $user, $pwd) {

        $this->link = mysqli_connect($host, $user, $pwd, $db_name)

            or die("Error!: " . mysqli_error($this->link));

        if(!mysqli_set_charset($this->link, "utf8")){

            printf("Error!: " . mysqli_error($this->link));
        }
    }

    public static function getConnect() {

        if (!self::$db) {

            self::$db = new Db("localhost", self::$db_name, self::$user, self::$pwd);
        }
            return self::$db->link;
    }
}