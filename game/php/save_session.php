<?php

function save_session_to_database() {
    
    $pdo = database_connect();

    $ability1 = $_SESSION['data']['ability1'];
    $ability2 = $_SESSION['data']['ability2'];
    $ability3 = $_SESSION['data']['ability3'];
    $ability4 = $_SESSION['data']['ability4'];
    $cookies = $_SESSION['data']['cookies'];
    $username = $_SESSION['data']['name'];

    $query = "UPDATE usersinfo SET cookies='$cookies', ability1='$ability1', ability2='$ability2', ability3='$ability3', ability4='$ability4' WHERE name='$username'";
    $statement = $pdo->prepare($query);
    $statement->execute();

}