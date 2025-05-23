<?php

declare(strict_types=1);

function isInputEmpty(string $username, string $pwd, string $email, $dob) 
{
    if(empty($username) || empty($pwd) || empty($email) || empty($dob))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function isEmailInvalid(string $email)
{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function isUsernameTaken(object $pdo, string $username)
{
    if(getUsername($pdo, $username))
    {
        return true;
    }
    else
    {
        return false;
    }
}


function isEmailTaken(object $pdo, string $email)
{
    if(getEmail($pdo, $email))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function isDOBPartsEmpty($day, $month, $year)
{
    if(empty($day) || empty($month) || empty($year))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function create_user(object $pdo, string $username, string $email, string $pwd, string $dob)
{
    set_user($pdo, $username, $email, $pwd, $dob);
}