<?php
function register_user($username, $password) {

$pdo = database_connect();

$query = "SELECT * FROM usersinfo WHERE name = :username";
$statement = $pdo->prepare($query);
$statement->execute(['username' => $username]);

$count = $statement->rowCount();

if($count > 0) {
    echo 'Username already exists';
    return;
}

//hash password
$password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO usersinfo (name, pass) VALUES ('$username', '$password');";
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => $username, 'pass' => $password]);

echo 'succesfully registered user';
}
?>