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

    $binds = array(
        ":e" => $email,
        ":n" => $name,
        ":p" => sha1($password)
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = "Data Added";
    }

    return $result;
}




/*
CREATE TABLE `users` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
    `name` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
    `password` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


  CREATE TABLE `groupz` (
    `groupID` int unsigned NOT NULL AUTO_INCREMENT,
    `id` int unsigned NOT NULL,
    `groupName` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
    PRIMARY KEY (`groupID`),
    UNIQUE KEY `unique assignment` (`id`,`groupName`),
    KEY `fk_userID` (`id`),
    CONSTRAINT `fk_userID` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci; */