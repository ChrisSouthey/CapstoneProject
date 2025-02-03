<?php

include (__DIR__ . '/db.php');

function login($name, $password) {
    global $db;

    $stmt = $db->prepare('SELECT id FROM users WHERE name= :user AND password = :pass');

    $stmt->bindValue(':user', $name);
    $stmt->bindValue(':pass', sha1($password));

    $stmt->execute();

    return($stmt->rowCount() > 0);
}

function getUsers(){

    global $db;

    $results = [];

    $stmt = $db->prepare("SELECT * FROM users ORDER BY email, name, password");

    if($stmt->execute() && $stmt->rowCount() > 0){
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $results;
}

function addUser($email, $name, $password){

    global $db;

    $result = "";

    $sql = "INSERT INTO users SET email = :e, name = :n, password = :p";

    $stmt = $db->prepare($sql);

    $stmt->bindPARAM('')

    if($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = "Data Added";
    }

    return $result;
}