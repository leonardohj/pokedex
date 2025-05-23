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