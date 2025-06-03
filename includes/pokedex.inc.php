<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $pokedexName = $_POST["pokedexName"];
    $description = empty($_POST["description"]) ? 'No description' : $_POST["description"];
    $generationsdata = isset($_POST["generations"]) ? $_POST["generations"] : [];

    try {
        require_once 'dbh.inc.php';
        require_once 'pokedex_model.inc.php';
        require_once 'pokedex_view.inc.php';
        require_once 'pokedex_contr.inc.php';
        require_once 'config_session.inc.php';


        $result = getUsername($pdo, $_SESSION["user_username"]);

        $_SESSION["user_id"] = htmlspecialchars($result["id"]);
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);
        $_SESSION["user_role"] = htmlspecialchars($result["role"]);

        $userID = $_SESSION["user_id"];
        $errors = [];

        if (isInputEmpty($pokedexName)) {
            $errors["emptyInputName"] = "Fill in all fields!";
        }
        
        if (empty($generationsdata)) {
            $errors["emptyInputGen"] = "Fill in the generations <br> you want for your pokedex!";
        }

        if (DoesUserHaveAlreadyTsPokedex($pokedexName, $pdo, $userID)) {
            $errors["usedPokedexName"] = "Duplicate Pokédex name!";
        }

        if ($errors) {
            $_SESSION["errors_pokedex"] = $errors;
            $_SESSION["pokedex_data"] = [
                "pokedexName" => $pokedexName,
                "description" => $description,
                "generations" => $generationsdata
            ];
            header("Location: ../user.php?user=" . $_SESSION["user_username"]);
            die();
        }

        create_pokedex($pdo, $pokedexName, $description, $generationsdata, $userID);

        header("Location: ../user.php?user=" . $_SESSION["user_username"] . "&created=success");
        
        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}