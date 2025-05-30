<?php

declare(strict_types=1);

function getUsername(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username); 
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); 
    return $result;
}

function getUserInfo(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username); 
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); 
    return $result;
}

function changeRole(object $pdo, string $username, string $role)
{
    $query = "UPDATE users SET role = :role WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username); 
    $stmt->bindParam(":role", $role); 
    $stmt->execute();

    updateSessionRole($username, $pdo);
}

function updateSessionRole(string $username, object $pdo)
{
    if($username == $_SESSION["user_username"])
    {
        $userdata = getUserInfo($pdo, $username);
        $_SESSION["user_role"] = $userdata["role"];
    }
}