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
function getPokedex($pokedexName, $pdo)
{
    $query = "SELECT * FROM pokedexs WHERE name = :name AND user_id = :user_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":name", $pokedexName);
    $stmt->bindParam(":user_id", $_SESSION["user_id"]);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}

function getUsernamePokedex(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}

function getAllPokemons($pdo, $g)
{
    $query = "SELECT * FROM pokemons WHERE generation = :generation";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":generation", $g); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
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
function update_pokedex(object $pdo, string $pokedexName, string $description, array $generationsdata, string $userID)
{

    $generationsfinaldata = 0;

    foreach($generationsdata as $generations)
    {
        $generationsfinaldata .= $generations;
    }

    $query = "UPDATE pokedexs SET name = :name, description = :description, generations = :generations WHERE id = :id;";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":name", $pokedexName, PDO::PARAM_STR);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":generations", $generationsfinaldata);
    $stmt->bindParam(":id", $_SESSION["actual_pokedex_id"]);
    $stmt->execute();
}
function remove_pokedex($pdo, $pokedexName, $id)
{
    $query = "DELETE FROM pokedexs WHERE id = :id;";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":id", $_SESSION["actual_pokedex_id"]);
    $stmt->execute();
}