<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $role = $_POST["roles"];

    try {
        require_once 'dbh.inc.php';
        require_once 'role_model.inc.php';
        require_once 'role_view.inc.php';
        require_once 'role_contr.inc.php';


        $errors = [];

        if (isUsernameEmpty($username)) {
            $errors["emptyUsername"] = "Fill in all fields!";
        }
        if (isRoleEmpty($role) || $role === "") 
        { 
            $errors["emptyRole"] = "Fill in all fields!";
        }
        if (!doesUserExist($username, $pdo)) {
            $errors["invalidUser"] = "This user does not exist";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_role"] = $errors;
            $_SESSION["role_data"] = [
                "username" => $username,
                "roles" => $role
                ];
            header("Location: ../support.php");
            exit();
        }

        changeRole($pdo, $username, $role);

        $pdo = null;
        $stmt = null;

        header("Location: ../support.php?rolegiven=success");
        die();
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}