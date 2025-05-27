<?php
    require_once 'includes/login_view.inc.php';
    require_once 'includes/config_session.inc.php';

        if(isset($_SESSION["user_id"]))
    {
      header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Login - Pokedex Tracker</title>
    <style>
        p, label {
            font-family: "Arial Black", Arial, sans-serif;
        }
    </style>
</head>
<body class="m-0 h-screen flex flex-col">
    <header class="bg-gray-200 text-neutral-200 flex items-center justify-between px-2 pt-1 pb-2">
        <div class="flex items-center">
            <a href="login.php"><img src="./img/pokedex3Dlogo.png" alt="Pokedex Tracker Logo" class="h-8"></a>
        </div>
        <div class="flex items-center gap-2">
            <a href="register.php" class="bg-blue-600 text-white px-2 py-1 rounded-lg hover:bg-blue-500 ">Register</a>
            <a href="login.php" class="border border-gray-400 text-gray-800 px-2 py-1 rounded-lg hover:bg-gray-100">Login</a>
        </div>
    </header>
    <div class="h-3 bg-black flex items-center mb-[2%]">
        a
    </div>
    <main class="flex justify-center items-center flex-1">
       <?php login_input();?>
    </main>
    <?php include('footer.php'); ?>
</body>
</html>