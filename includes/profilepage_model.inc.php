<?php

declare(strict_types=1);

function getUsername(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}
function getPokedexs(object $pdo, $userID)
{
    $query = "SELECT * FROM pokedexs WHERE user_id = :user_id;";
    $stmt = $pdo->prepare($query);
    $user_id =  $userID;
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}