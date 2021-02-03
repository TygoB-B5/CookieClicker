<?php

function login_correct($username, $password){

    $pdo = database_connect();

    $query = "SELECT * FROM usersinfo WHERE name = :username";
    $statement = $pdo->prepare($query);
    $statement->execute(['username' => $username]);
    $hash = $statement->fetch();

    if(password_verify($password, $hash['pass'])) {
        return true;
    }
     else {
        return false;
    }
}