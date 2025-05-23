<?php

declare(strict_types=1);


function getUsername(object $pdo, string $username)
{
    $query = "SELECT username FROM users WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username); 
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); 
    return $result;
}
function getEmail(object $pdo, string $email)
{
    $query = "SELECT username FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query); 
    $stmt->bindParam(":email", $email); 
    $stmt->execute(); 

    $result = $stmt->fetch(PDO::FETCH_ASSOC); 
    return $result;
}
function set_user(object $pdo, string $username, string $email, string $pwd, string $dob)
{
    $query = "INSERT INTO users (username, email, pwd, dob) VALUES (:username, :email, :pwd, :dob);";
    $stmt = $pdo->prepare($query); 

    $options = [
        "cost" => 12
    ];

    $pwd = password_hash($pwd, PASSWORD_DEFAULT, $options);

    $stmt->bindParam(":username", $username); 
    $stmt->bindParam(":email", $email); 
    $stmt->bindParam(":pwd", $pwd); // Store the hashed password
    $stmt->bindParam(":dob", $dob); 
    $stmt->execute();
}