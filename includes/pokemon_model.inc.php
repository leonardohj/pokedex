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

function set_pokemon($pokemonName, $generation, $image, $pokedexEntry, $type1, $type2, $pdo)
{
    $query = "INSERT INTO pokemons (name, generation, image, pokedexEntry, type1, type2) VALUES (:pokemonName, :generation, :image, :pokedexEntry, :type1, :type2);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":pokemonName", $pokemonName);
    $stmt->bindParam(":generation", $generation);
    $stmt->bindParam(":image", $image);
    $stmt->bindParam(":pokedexEntry", $pokedexEntry);
    $stmt->bindParam(":type1", $type1);
    $stmt->bindParam(":type2", $type2);
    
    $stmt->execute();
}

function getAllPokemons($pdo, $g)
{
    $query = "SELECT * FROM pokemons WHERE generation = :generation";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":generation", $g); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}