<?php

declare(strict_types=1);

function checkFirstInput(object $pdo, string $firstInput)
{
    $query = "SELECT * FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $firstInput);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$results)
    {
        $results = null;
        $stmt = null;
        $query = null;
        
        $query = "SELECT * FROM users WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $firstInput);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        if($results)
        {
            return "user";
        }
        return $results;
    }
    if($results)
    {
        return "email";
    }
    return $results;
}

function getUsername(object $pdo, string $firstInput)
{
    $query = "SELECT * FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $firstInput);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}

function getEmail(object $pdo, string $firstInput)
{
    $query = "SELECT * FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $firstInput);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}

function getPwd(object $pdo, string $pwd)
{
    $query = "SELECT pwd FROM users WHERE pwd = :pwd;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":pwd", $pwd);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}

function checkInputsUser(object $pdo, string $firstInput, string $pwd)
{
    $query = "SELECT * FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $firstInput);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    if($results && password_verify($pwd, $results['pwd']))
    {
        return $results;
    }
    $results = null;
    return $results;
}

function checkInputsEmail(object $pdo, string $firstInput, string $pwd)
{
    $query = "SELECT * FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $firstInput);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    if($results && password_verify($pwd, $results['pwd']))
    {
        return $results;
    }
    $results = null;
    return $results;
}