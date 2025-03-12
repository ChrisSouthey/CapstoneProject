<?php

include (__DIR__ . '/db.php');

function login($name, $password) {
    global $db;

    $stmt = $db->prepare('SELECT id FROM users WHERE name= :user AND password = :pass');

    $stmt->bindValue(':user', $name);
    $stmt->bindValue(':pass', sha1($password));

    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return($user);
    //return($stmt->rowCount() > 0);
}

//---------------------------------------------Users functions------------------------

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

function updateUser($id, $email, $name, $password) {
    global $db;

    $result = '';

    $sql = 'UPDATE users SET email = :e, name = :n, password = :p WHERE id = :id';

    $stmt = $db->prepare($sql);

    $binds = array(
        ':id'=> $id,
        ":e" => $email,
        ":n" => $name,
        ":p" => sha1($password),
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = 'User Updated';
    }

    return $result;
}

function getUser($id){
    global $db;

    $result = [];

    $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");

    $binds = array(
        ':id'=> $id
    );

    if ( $stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return $result;
}


function getUserByName($name, $password){
    global $db;

    $result = [];

    $stmt = $db->prepare("SELECT * FROM users WHERE name = :name AND password = :password");

    $binds = array(
        ':name'=> $name,
        ':password'=> $password
    );

    if ( $stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    return $result;
}

function getUsers(){

    global $db;

    $results = [];

    $stmt = $db->prepare("SELECT * FROM users");

    if($stmt->execute() && $stmt->rowCount() > 0){
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $results;
}


//-------------------------------------Groups functions------------------------------
function addGroup($id, $groupName){

    global $db;

    $result = "";

    $stmt = $db->prepare("SELECT COUNT(*) FROM groupz WHERE id = ? AND groupName = ?");
    $stmt->execute([$id, $groupName]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $error =  "A group with this name already exists.";
        return $error;
    }
    else{
        $sql = "INSERT INTO groupz SET id = :id, groupName = :n";

        $stmt = $db->prepare($sql);

        $binds = array(
            ":id" => $id,
            ":n" => $groupName,
        );

        if($stmt->execute($binds) && $stmt->rowCount() > 0){
        }

        return $result;
    }
}

function getGroups($id){
    global $db;

    $result = [];

    $stmt = $db->prepare("SELECT * FROM groupz WHERE id = :id ORDER BY groupID");

    $binds = array(
        ':id'=> $id
    );

    if ( $stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $result;
}




//-------------------------------------------------Cards Functions---------------------------------------
function addCard2($groupID, $cardName, $cardType, $cardColor, $cardRarity, $cardImg){

    global $db;

    $result = "";

    $sql = "INSERT INTO cards SET groupID = :id, cardName = :n, cardType = :t, cardColor = :c, cardRarity = :r, cardImg = :i";

    $stmt = $db->prepare($sql);

    $binds = array(
        ":id" => $groupID,
        ":n" => $cardName,
        ":t" => $cardType,
        ":c" => $cardColor,
        ":r" => $cardRarity,
        ":i" => $cardImg,
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = "Data Added";
    }

    return $result;
}

function addCard($groupID, $cardImg){

    global $db;

    $result = "";

    $sql = "INSERT INTO cards SET groupID = :id, cardImg = :i";

    $stmt = $db->prepare($sql);

    $binds = array(
        ":id" => $groupID,
        ":i" => $cardImg
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0){
        $result = "Data Added";
    }

    return $result;
}

function getCards($groupID) {
    global $db; // Use global database connection

    $result = [];

    $stmt = $db->prepare("SELECT * FROM cards WHERE groupID = :groupID");

    $binds = array(
        ':groupID' => $groupID
    );

    if ($stmt->execute($binds)) { 
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $result;
}













