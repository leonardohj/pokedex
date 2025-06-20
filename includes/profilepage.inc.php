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
        $result = getUsername($pdo, $username);

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

            
            die();
        }
        $_SESSION["profileuser_id"] = htmlspecialchars($result["id"]);
        $_SESSION["profileuser_username"] = htmlspecialchars($result["username"]);
        $_SESSION["profileuser_image"] = htmlspecialchars($result["image"]);
        $_SESSION["profileuser_role"] = htmlspecialchars($result['role']);
        
        $_SESSION["colorRole"] =
        [
            "admin" => "border-blue-500",
            "support" => "border-green-500",
            "peasent" => "border-red-500"
        ];

        $getPokedexs = getPokedexs($pdo, $_SESSION["profileuser_id"]);
        $_SESSION["pokedexs"] = $getPokedexs;
        

        $pdo = null;
        $stmt = null;
    
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
