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

function getUsername(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}

function set_pokedex(object $pdo, string $pokedexName, string $description, array $generationsdata, string $userID)
{
    

    foreach($generationsdata as $generations)
    {
        $generationsfinaldata .= $generations;
    }

    $query = "INSERT INTO pokedexs (name, description, generations, user_id) VALUES (:name, :description, :generations, :user_id);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":name", $pokedexName);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":generations", $generationsfinaldata);
    $stmt->bindParam(":user_id", $userID);
    $stmt->execute();
}