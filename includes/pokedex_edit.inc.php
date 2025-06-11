<?php
    
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $pokedexName = $_POST["pokedexNameEdit"];
    $description = empty($_POST["descriptionEdit"]) ? 'No description' : $_POST["descriptionEdit"];
    $generationsdata = isset($_POST["generationsEdit"]) ? $_POST["generationsEdit"] : [];

    try {
        require_once 'dbh.inc.php';
        require_once 'pokedex_model.inc.php';
        require_once 'pokedex_view.inc.php';
        require_once 'pokedex_contr.inc.php';
        require_once 'config_session.inc.php';

        $result = getUsernamePokedex($pdo, $_SESSION["user_username"]);
        $result2 = getPokedex($_SESSION["actual_pokedex_name"], $pdo);

        $_SESSION["actual_pokedex_id"] = htmlspecialchars($result2["id"]);
        $_SESSION["user_id"] = htmlspecialchars($result["id"]);
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);
        $_SESSION["user_role"] = htmlspecialchars($result["role"]);

        $userID = $_SESSION["user_id"];
        
        $errors = [];
        
        if (isInputEmpty($pokedexName)) {
            $errors["emptyInputNameEdit"] = "Fill in all fields!";
        }
        
        if (empty($generationsdata)) {
            $errors["emptyInputGenEdit"] = "Fill in the generations <br> you want for your pokedex!";
        }

        if (DoesUserHaveAlreadyTsPokedex($pokedexName, $pdo, $userID)) {
            $errors["usedPokedexNameEdit"] = "Duplicate Pokédex name!";
        }

        if ($errors) {
            $_SESSION["errors_pokedexEdit"] = $errors;
            $_SESSION["pokedex_data"] = [
                "pokedexNameEdit" => $pokedexName,
                "descriptionEdit" => $description,
                "generationsEdit" => $generationsdata
            ];

            header("Location: ../user.php?user=" . $_SESSION["user_username"] . "&edited=wentwrong&pokedex=" . htmlspecialchars($_SESSION["actual_pokedex_name"]));
            die();
        }

        change_pokedex($pdo, $pokedexName, $description, $generationsdata, $userID);

        header("Location: ../user.php?user=" . $_SESSION["user_username"] . "&edited=success&pokedex=" . htmlspecialchars($pokedexName));

        $pdo = null;
        $stmt = null;
        die();
    } 
    catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
}