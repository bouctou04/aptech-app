<?php


namespace Model;

use \PDO;

abstract class Database
{
    /**
     * @var string
     */
    private static string $dsn = "mysql";

    /**
     * @var string
     */
    private static string $host = "127.0.0.1";

    /**
     * @var string
     */
    private static string $db_name = "aptech_app";

    /**
     * @var string
     */
    private static string $db_user = "root";

    /**
     * @var string
     */
    private static string $db_password = "";

    /**
     * @var null
     */
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