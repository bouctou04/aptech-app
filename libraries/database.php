<?php

/**
 * @return PDO
 */
function get_pdo() {
    $dsn = 'mysql';
    $host = '127.0.0.1';
    $db_name = 'gestion_universitaire_2';
    $db_user = 'root';
    $db_password = '';

    $pdo = new PDO("$dsn:host=$host;dbname=$db_name", "$db_user", "$db_password", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $pdo;
}
