<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $role = $_POST["roles"];

    try {
        require_once 'dbh.inc.php';
        require_once 'roll_model.inc.php';
        require_once 'roll_view.inc.php';
        require_once 'roll_contr.inc.php';


        $errors = [];

        if (isUsernameEmpty($username)) {
            $errors["emptyUsername"] = "Fill in all fields!";
        }
        if (isRoleEmpty($role) || $role === "") 
        { 
            $errors["emptyRole"] = "Fill in all fields!";
        }
        if (doesUserExist($username, $pdo)) {
            $errors["invalidUser"] = "This user does not exist";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_role"] = $errors;
            $_SESSION["role_data"] = [
                "username" => $username,
                "roles" => $role
                ];
            header("Location: ../index.php");
            exit();
        }

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php?rolegiven=success");
        die();
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}