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

function DoesUserHaveAlreadyTsPokedex($pokedexName, $pdo, $userID)
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
function create_pokedex($pdo, $pokedexName, $description, $generationsdata, $userID)
{
    set_pokedex($pdo, $pokedexName, $description, $generationsdata, $userID);
}