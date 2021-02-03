<?php

function get_user_data($username, $password) {

    $pdo = database_connect();

    $query = "SELECT * FROM usersinfo WHERE name = :username";
    $statement = $pdo->prepare($query);
    $statement->execute(['username' => $username]);

    $data = $statement->fetch();

    return $data;
}