<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $firstInput = $_POST["usernameOrEmail"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_view.inc.php';
        require_once 'login_contr.inc.php';

        $inputinserted = verifiesFirstInput($pdo, $firstInput);
        $errors = [];

        $result = ($inputinserted === "user") ? getUsername($pdo, $firstInput) : getEmail($pdo, $firstInput);


        if (isInputEmpty($firstInput, $pwd)) {
            $errors["emptyInput"] = "Fill in all fields!";
        }
        else if(DoesInputsNotMatch($pdo, $firstInput, $pwd))
        {
            $errors["inputDoNotMatch"] = "Sorry, but your password was incorrect!\nPlease try again.";
        }
        
        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;
            $_SESSION["login_data"] = [
                "firstinput" => $firstInput,
                "pwd" => $pwd
            ];
            header("Location: ../login.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionID = $newSessionId . "_" . $result["id"];
        session_id($sessionID);

        $_SESSION["user_id"] = htmlspecialchars($result["id"]);
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);
        $_SESSION["user_role"] = htmlspecialchars($result["roll"]);

        $_SESSION["last_regeneration"] = time();
        
        header("Location: ../index.php?index=sucess"); 
        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
else
{
    header("Location: ../index.php");
    die();
}