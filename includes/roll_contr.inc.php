<?php

declare(strict_types=1);

function isUsernameEmpty($username)
{
    if(empty($username))
    {
        return true;
    }
    else
    {
        return false;
    }
}
function isRoleEmpty($role)
{
    if(empty($role))
    {
        return true;
    }
    else
    {
        return false;
    }
}
function doesUserExist($username, $pdo)
{
    if(!getUsername($pdo, $username))
    {
        return true; 
    }
    else
    {
        return false;
    }
}