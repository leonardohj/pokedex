<?php



function checkIfUserHavePokedexSameName($pokedexName, $pdo)
{
    $query = "SELECT name FROM pokedexs WHERE name = :name AND user_id = :user_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $pokedexName);
    $stmt->bindParam(":user_id", $_SESSION["user_id"]);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}

function set_pokedex(object $pdo, string $pokedexName)
{
    $query = "INSERT INTO pokedexs (name, user_id) VALUES (:name, :user_id);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":name", $pokedexName);
    $stmt->bindParam(":user_id", $_SESSION["user_id"]);
    $stmt->execute();
}

function getUsername(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}
