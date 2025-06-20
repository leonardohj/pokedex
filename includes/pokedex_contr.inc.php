<?php


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
function fetchAllPokemons($pdo)
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

function DoesUserHaveAlreadyTsPokedexCreate($pokedexName, $pdo, $userID)
{
    if(checkIfUserHavePokedexSameName($pokedexName, $pdo, $userID))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function DoesUserHaveAlreadyTsPokedexEdit($pokedexName, $pdo, $userID)
{
    if($pokedexName == $_SESSION["actual_pokedex_name"])
    {
        return false;   
    }

    if(checkIfUserHavePokedexSameName($pokedexName, $pdo, $userID))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function create_pokedex($pdo, $pokedexName, $description, $generationsdata, $userID)
{
    set_pokedex($pdo, $pokedexName, $description, $generationsdata, $userID);
}
function change_pokedex($pdo, $pokedexName, $description, $generationsdata, $userID)
{
    update_pokedex($pdo, $pokedexName, $description, $generationsdata, $userID, true);
}
function delete_pokedex($pdo, $pokedexName, $id)
{
    remove_pokedex($pdo, $pokedexName, $id);
}