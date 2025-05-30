<?php

declare(strict_types=1);

function isInputEmpty($input)
{
    if(empty($input))
    {
        return true;
    }
    else
    {
        return false;

    }
}

function doesPokemonAlreadyExist($pokemonName, $pdo)
{
    $results = getPokemon($pokemonName, $pdo);
    if($results["name"] == $pokemonName)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function isImageInputNotAnLink($image)
{
    if(strpos($image, "http://") !== 0 && strpos($image, "https://") !== 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function create_pokemon($pokedexName, $generation, $image, $description, $pdo)
{
    set_pokemon($pokedexName, $generation, $image, $description, $pdo);
}