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
function AreTypesTheSame($type1, $type2)
{
    if($type1 == $type2)
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

function update_fetchAllPokemons($pdo)
{
    $allGens = range(1, 9);
    $allPokemons = [];
    foreach($allGens as $g)
    {
        $pokemons = getAllPokemons($pdo, $g);
        if ($pokemons) {
            $allPokemons[$g] = $pokemons;
        }
    }
    return $allPokemons;
}

function create_pokemon($pokedexName, $generation, $image, $pokedexEntry, $type1, $type2, $pdo)
{
    set_pokemon($pokedexName, $generation, $image, $pokedexEntry, $type1, $type2, $pdo);
}