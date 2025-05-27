<?php

declare(strict_types=1);

function doesUserNotExist($username, $pdo)
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