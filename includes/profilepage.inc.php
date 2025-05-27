<?php

if (isset($_GET["user"])) 
{

    $username = $_GET["user"];

    try {
        require_once 'dbh.inc.php';
        require_once 'profilepage_model.inc.php';
        require_once 'profilepage_view.inc.php';
        require_once 'profilepage_contr.inc.php';

        $errors = [];

        if(doesUserNotExist($username, $pdo))
        {
            $errors["userDoesNotExist"] = "This user does not exist!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_profilepage"] = $errors;
            $_SESSION["profilepage_data"] = [
                "username" => $username
            ];

            header("Location: ../index.php?user=" . $username);
            die();
        }

        $pdo = null;
        $stmt = null;
    
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
