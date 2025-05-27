<?php

declare(strict_types=1);

function login_input()
{
    ?>
    <div class="bg-neutral-900 border border-gray-600 rounded-lg px-6 py-7 max-w-md w-full mb-[2%]">
            <form action="includes/login.inc.php" class="flex flex-col mt-2 mb-1" method="POST">
                <p class="text-center text-neutral-200 font-bold text-lg mb-5">Login to your account</p>
                
                <label for="usernameOrEmail" class="text-neutral-200 font-medium mt-5 mb-1">Username or email</label>
                <div class="relative mb-2">
                <?php
                if(isset($_SESSION["login_data"]["firstinput"]))
                {
                    $hasErrors = isset($_SESSION["errors_login"]);
                    $borderClass = $hasErrors ? "border-red-500" : "border-green-500";

                    echo '<input name="usernameOrEmail" type="text" placeholder="coolpokedex@hello.dot or hihiguys123" class="bg-gray-800 text-neutral-200 border '. $borderClass .' rounded-md px-3 py-2 w-full mt-1" value="'. htmlspecialchars($_SESSION["login_data"]["firstinput"]) . '">';
                    
                }
                else
                {
                    echo '<input name="usernameOrEmail" type="text" placeholder="coolpokedex@hello.dot or hihiguys123" class="bg-gray-800 text-neutral-200 border border-gray-600 rounded-md px-3 py-2 w-full mt-1">';
                }
                ?>
                </div>

                <label for="pwd" class="text-neutral-200 font-medium mt-5 mb-1">Password</label>
                <div class="relative mb-2">
                <?php
                if(isset($_SESSION["login_data"]["pwd"]))
                {
                    $hasErrors = isset($_SESSION["errors_login"]);
                    $borderClass = $hasErrors ? "border-red-500" : "border-green-500";

                    echo '<input name="pwd" type="password" placeholder="Minimum of 8 characters" class="bg-gray-800 text-neutral-200 border '. $borderClass .' rounded-md px-3 py-2 w-full mt-1">';
                    
                    if($hasErrors)
                    {
                        check_login_errors();  
                    }
                }
                else
                {
                    echo '<input name="pwd" type="password" placeholder="Minimum of 8 characters" class="bg-gray-800 text-neutral-200 border border-gray-600 rounded-md px-3 py-2 w-full mt-1">';
                }
                ?>
                </div>                
                <button class="bg-gray-300 border rounded-md py-2 mt-6 cursor-pointer text-base">Log In</button>
                <div class="text-center mt-4">
                    <a href="register.php" class="text-blue-400 hover:underline">Don't have an account? Sign up</a>
                </div>
                <div>
                </div>
            </form>
        </div>
        <?php
        unset($_SESSION["login_data"]);
        unset($_SESSION["errors_login"]);
}

function check_login_errors()
{
    if (isset($_SESSION['errors_login'])) {
        $errors = $_SESSION['errors_login'];

        if (isset($errors["emptyInput"])) {
            echo <<<HTML
            <div class="absolute text-red-500 text-sm font-bold mt-1">
                {$errors["emptyInput"]}
            </div>
            HTML;
        }
        if (isset($errors["inputDoNotMatch"])) {
            echo <<<HTML
            <div class="absolute text-red-500 text-sm font-bold mt-1">
                {$errors["inputDoNotMatch"]}
            </div>
            HTML;
        }
    }
}
?>