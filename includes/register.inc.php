<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pwd = $_POST["pwd"];
    $username = $_POST["username"];
    $email = $_POST["email"]; 
    $year = $_POST["year"];
    $month = $_POST["month"]; 
    $day = $_POST["day"];
    $dob = $year . "-" . $month . "-" . $day;

    try {
        require_once 'dbh.inc.php';
        require_once 'register_model.inc.php';
        require_once 'register_view.inc.php';
        require_once 'register_contr.inc.php';


        $errors = [];

        if (isInputEmpty($username, $pwd, $email, $dob)) {
            $errors["emptyInput"] = "Fill in all fields!";
        }
        if (isEmailInvalid($email)) {
            $errors["invalidEmail"] = "This email is invalid!";
        }
        if (isUsernameTaken($pdo, $username)) {
            $errors["takenUsername"] = "This username was already used!";
        }
        if (isEmailTaken($pdo, $email)) {
            $errors["takenEmail"] = "This email was already used!";
        }
        if (isDOBPartsEmpty($day, $month, $year)) {
            $errors["emptyDOB"] = "Please fill your birth date (day, month, and year)!";
        }
        if(isPasswordNotSafe($pwd))
        {
            $errors["notSafePwd"] = "Please make sure your password have 8+ character, and 1 special character";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_register"] = $errors;
            $_SESSION["register_data"] = [
                "pwd" => $pwd,
                "username" => $username,
                "email" => $email,
                "dob" => $dob,
                "year" => $year,
                "month" => $month,
                "day" => $day
            ];
            header("Location: ../register.php");
            exit();
        }

        create_user($pdo, $username, $email, $pwd, $dob);

        $pdo = null;
        $stmt = null;

        header("Location: ../register.php?signup=success");
        exit();
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}