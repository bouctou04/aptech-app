<?php

class Database {
    private static string $dsn = "mysql";
    private static string $host = "127.0.0.1";
    private static string $db_name = "aptech_app";
    private static string $db_user = "root";
    private static string $db_password = "";
    private static $pdo = NULL;

    /**
     * @return PDO|null
     */
    public static function get_pdo() {
        if(self::$pdo === NULL) {
            self::$pdo = new PDO(self::$dsn.":host=".self::$host.";dbname=".self::$db_name, self::$db_user, self::$db_password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        return self::$pdo;
    }
}
