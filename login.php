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
        <div class="bg-neutral-900 border border-gray-600 rounded-lg px-6 py-7 max-w-md w-full mb-[2%]">
            <form action="includes/login.inc.php" class="flex flex-col mt-2 mb-1" method="POST">
                <p class="text-center text-neutral-200 font-bold text-lg mb-5">Login to your account</p>
                
                <label for="usernameOrEmail" class="text-neutral-200 font-medium mt-5 mb-1">Username or email</label>
                <input name="usernameOrEmail" type="text" placeholder="coolpokedex@hello.dot or hihiguys123" class="bg-gray-800 text-neutral-200 border border-gray-600 rounded-md px-3 py-2 w-full mb-5">

                <label for="pwd" class="text-neutral-200 font-medium mt-5 mb-1">Password</label>
                <input name="pwd" type="password" placeholder="Minimum of 8 characters" class="bg-gray-800 text-neutral-200 border border-gray-600 rounded-md px-3 py-2 w-full mb-5">

                <button class="bg-gray-300 border rounded-md py-2 mt-4 cursor-pointer text-base">Log In</button>
                
                <div class="text-center mt-4">
                    <a href="register.php" class="text-blue-400 hover:underline">Don't have an account? Sign up</a>
                </div>
                <div>
                <?php
                
                check_login_errors();
                
                ?>
                </div>
            </form>
        </div>
    </main>
    <?php include('footer.php'); ?>
</body>
</html>