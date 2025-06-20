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

        delete_pokedex($pdo, $pokedexName, $id);

        header("Location: ../user.php?user=" . $_SESSION["user_username"]);

        $pdo = null;
        $stmt = null;
        die();
    } 
    catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
}