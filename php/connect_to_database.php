<?php

function database_connect(){

$db_servername = "localhost";
$db_username = "root";
$db_name = 'cookie_clicker';
$db_password = "";
$db_charset = "utf8mb4";

try {

    $dsn = "mysql:host=".$db_servername.";dbname=".$db_name."; charset=".$db_charset."";
    $pdo = new PDO($dsn, $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;

    } catch (\PDOException $e) {

    error_log($e->getMessage());
    return null;
    }

}
