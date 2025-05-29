<?php


function isInputEmpty($pokedexName)
{
    if(empty($pokedexName))
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
function create_pokedex($pdo, $pokedexName, $userID)
{
    set_pokedex($pdo, $pokedexName, $userID);
}