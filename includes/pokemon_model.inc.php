<?php

declare(strict_types=1);

function getPokemon($pokemonName, $pdo)
{
    $query = "SELECT name FROM pokemons WHERE name = :pokemonName";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":pokemonName", $pokemonName); 
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); 
    return $result;
}
function set_pokemon($pokemonName, $generation, $image, $description, $pdo)
{
    $query = "INSERT INTO pokemons (name, generation, image, description) VALUES (:pokemonName, :generation, :image, :description);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":pokemonName", $pokemonName);
    $stmt->bindParam(":generation", $generation);
    $stmt->bindParam(":image", $image);
    $stmt->bindParam(":description", $description);
    
    $stmt->execute();
}