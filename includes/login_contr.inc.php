<?php

declare(strict_types=1);

function isInputEmpty(string $firstInput, string $pwd)
{
    if(empty($firstInput) || empty($pwd))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function DoesInputsNotMatch(object $pdo, string $firstInput, string $pwd)
{
    $result = verifiesFirstInput($pdo, $firstInput);

    if($result == "user")
    {
        $answer = checkInputsUser($pdo, $firstInput, $pwd);
        if(!$answer)
        {
            return true;
        }
    }   
    else if($result == "email")
    {
        $answer = checkInputsEmail($pdo, $firstInput, $pwd);
        if(!$answer)
        {
            return true;
        }
    }
    return false; 
}

function verifiesFirstInput(object $pdo, string $firstinput)
{
    $result = checkFirstInput($pdo, $firstinput);
    if($result === "user")
    {
        return "user";
    }
    else
    {
        return "email";
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

function getAllPokemons($pdo, $g)
{
    $query = "SELECT * FROM pokemons WHERE generation = :generation";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":generation", $g); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}

function getAllPokemonsNOgeneration($pdo)
{
    $query = "SELECT * FROM pokemons";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
}