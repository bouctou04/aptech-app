<?php


class Database {
    private string $dsn = "mysql";
    private string $host = "127.0.0.1";
    private string $db_name = "aptech_app";
    private string $db_user = "root";
    private string $db_password = "";
    private static $pdo = NULL;

    /**
     * @return PDO|null
     */
    public static function get_pdo() {
        self::$pdo = new PDO("mysql:host=127.0.0.1;dbname=aptech_app", "root", "", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        return self::$pdo;
    }
}
