<?php

declare(strict_types=1);

function register_input()
{
    ?>
    
    <form action="includes/register.inc.php" method="POST" class="flex flex-col relative">
        <p class="text-center text-neutral-200 uppercase font-bold text-lg mb-5">Register to track your Pokémon!</p>
        <label for="dob" class="text-neutral-200 font-medium mt-5 mb-1">Birth date</label>
        <div class="relative flex flex-col mb-5">
          <div class="flex w-full">
            <?php
            $failedRegister = checkIfFailedRegister();
            if (isset($_SESSION["register_data"]["day"])) 
                {
                    $hasErrors = isset($_SESSION["errors_register"]["emptyDOB"]);
                    $borderClass = $hasErrors ? "border-red-500" : "border-green-500";
                    $borderClassPartERROR = $hasErrors ? "border-red-600" : "border-green-500";

                if($hasErrors)
                    {    
                        echo '<select style="max-height: 120px; overflow-y: auto;" name="day" class="bg-gray-800 text-neutral-200 border '. $borderClassPartERROR . ' rounded-l-md px-3 py-2 flex-1">';
                        echo '<option selected disabled style="display:none" value="">Day</option>';
                    }
                else
                    {
                        echo '<select style="max-height: 120px; overflow-y: auto;" name="day" class="bg-gray-800 text-neutral-200 border '. $borderClass . ' border-r-gray-600 rounded-l-md px-3 py-2 flex-1">';
                        echo '<option selected disabled style="display:none" value="'. htmlspecialchars($_SESSION["register_data"]["day"]) . '">'. htmlspecialchars($_SESSION["register_data"]["day"]) . '</option>';
                    }
                }
            else
                {
                    echo '<select style="max-height: 120px; overflow-y: auto;" name="day" class="bg-gray-800 text-neutral-200 border border-gray-600 rounded-l-md px-3 py-2 flex-1">';
                    echo '<option selected disabled style="display:none" value="">Day</option>';
                }

            for($i = 1; $i <= 31; $i++)
            {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            echo '</select>';        
        
            if (isset($_SESSION["register_data"]["month"])) 
                {
                    $hasErrors = isset($_SESSION["errors_register"]["emptyDOB"]);
                    $borderClass = $hasErrors ? "border-red-500" : "border-green-500";
                    $borderClassPartERROR = $hasErrors ? "border-gray-600" : "border-green-500";

                if($hasErrors)
                    {    
                    echo '<select name="month" class="bg-gray-800 text-neutral-200 border '. $borderClassPartERROR . ' px-3 py-2 flex-1">';
                    echo '<option selected disabled style="display:none" value="">Month</option>';
                    }
                else
                    {
                    echo '<select name="month" class="bg-gray-800 text-neutral-200 border '. $borderClass . ' border-r-gray-600 border-l-gray-600  px-3 py-2 flex-1">';
                    echo '<option selected disabled style="display:none" value="'. htmlspecialchars($_SESSION["register_data"]["month"]) . '">'. htmlspecialchars($_SESSION["register_data"]["month"]) . '</option>';
                    }
                }
            else
                {
                    echo '<select name="month" class="bg-gray-800 text-neutral-200 border border-gray-600 px-3 py-2 flex-1">';
                    echo '<option selected disabled style="display:none" value="">Month</option>';
                }

            for($i = 1; $i <= 12; $i++)
            {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }

            echo '</select>';  

            if (isset($_SESSION["register_data"]["year"])) 
                {
                    $hasErrors = isset($_SESSION["errors_register"]["emptyDOB"]);
                    $borderClass = $hasErrors ? "border-gray-600" : "border-green-500";
                    $borderClassPartERROR = $hasErrors ? "border-gray-600" : "border-green-500";                    

                if($hasErrors)
                    {    
                        echo '<select name="year" class="bg-gray-800 text-neutral-200 border '. $borderClassPartERROR . ' rounded-r-md px-3 py-2 flex-1">';
                        echo '<option selected disabled style="display:none" value="">Year</option>';
                    }
                else
                    {
                        echo '<select name="year" class="bg-gray-800 text-neutral-200 border '. $borderClass . ' border-l-gray-600 rounded-r-md px-3 py-2 flex-1">';
                        echo '<option selected disabled style="display:none" value="'. htmlspecialchars($_SESSION["register_data"]["year"]) . '">'. htmlspecialchars($_SESSION["register_data"]["year"]) . '</option>';
                    }
                }
            else
                {
                    echo '<select name="year" class="bg-gray-800 text-neutral-200 border border-gray-600 rounded-r-md px-3 py-2 flex-1">';
                    echo '<option selected disabled style="display:none" value="">Year</option>';
                }

            for($i = 2025; $i >= 1900; $i--)
            {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }

            echo '</select>';  
            
            ?>
          </div>
          <?php
          if (
              (isset($hasErrors) && $hasErrors) ||
              (isset($_SESSION["errors_register"]["emptyDOB"]) && $_SESSION["errors_register"]["emptyDOB"])
          ) {
              check_dob_errors();
          }
          ?>
        </div>
        <label for="username" class="text-neutral-200 font-medium mt-5 mb-1">Username</label>
        <div class="relative mb-5">
            <?php
            

            if (isset($_SESSION["register_data"]["username"])) {
                $hasErrors = isset($_SESSION["errors_register"]["takenUsername"]) || isset($_SESSION["errors_register"]["invalidUsername"]);

                $borderClass = $hasErrors ? "border-red-500" : "border-green-500";
                echo '<input id="username" name="username" type="text" placeholder="JoaquimdaSilva_4" class="bg-gray-800 text-neutral-200 border ' . $borderClass . ' rounded-md px-3 py-2 w-full" required value="' . htmlspecialchars($_SESSION["register_data"]["username"]) . '">';

                if ($hasErrors) {
                    check_username_errors();
                }
            } else {
                echo '<input id="username" name="username" type="text" placeholder="JoaquimdaSilva_4" class="bg-gray-800 text-neutral-200 border border-gray-600 rounded-md px-3 py-2 w-full" required>';
            }
            ?>
        </div>
        <label for="email" class="text-neutral-200 font-medium mt-5 mb-1">Email</label>
        <div class="relative mb-5">
            <?php
            if (isset($_SESSION["register_data"]["email"])) {
                $hasErrors = isset($_SESSION["errors_register"]["takenEmail"]) || isset($_SESSION["errors_register"]["invalidEmail"]);
                $borderClass = $hasErrors ? "border-red-500" : "border-green-500";
                echo '<input id="email" name="email" type="email" placeholder="coolpokedex@hello.dot" class="bg-gray-800 text-neutral-200 border ' . $borderClass . ' rounded-md px-3 py-2 w-full" required value="' . htmlspecialchars($_SESSION["register_data"]["email"]) . '">';

                if ($hasErrors) {
                    check_email_errors();
                }
            } else 
            {
                echo '<input id="email" name="email" type="email" placeholder="coolpokedex@hello.dot" class="bg-gray-800 text-neutral-200 border border-gray-600 rounded-md px-3 py-2 w-full" required>';
            }
            ?>
        </div>

        <label for="pwd" class="text-neutral-200 font-medium mt-5 mb-1">Password</label>
        <div class="relative mb-5">
            <?php
            if(isset($_SESSION["errors_register"]))
            {   
                $hasErrors = isset($_SESSION["errors_register"]["notSafePwd"]);
                $borderClass = $hasErrors ? "border-red-500" : "border-green-500";

                echo '<input id="pwd" name="pwd" type="password" placeholder="Minimum of 8 characters" class="bg-gray-800 text-neutral-200 border ' . $borderClass . ' rounded-md px-3 py-2 w-full mb-5" required>';
                
                if ($hasErrors && !empty($_SESSION["errors_register"]["notSafePwd"])) {
                    check_pwd_errors();
                }
            }
            else
            {
                echo '<input id="pwd" name="pwd" type="password" placeholder="Minimum of 8 characters" class="bg-gray-800 text-neutral-200 border border-gray-600 rounded-md px-3 py-2 w-full mb-5" required>';
            }
            ?>
        </div>
        <button class="bg-gray-300 border rounded-md py-2 mt-2 cursor-pointer">Sign up</button>
        
    </form>
    <?php
    unset($_SESSION["register_data"]);
    unset($_SESSION["errors_register"]);
}

function checkIfFailedRegister()
{
    if (isset($_SESSION['errors_register'])) {
        $errors = $_SESSION['errors_register'];
        return 'error';
}
}
function printSucessfullRegister()
{
    if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo <<<HTML
        <div id="success-popup" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-xl font-bold px-8 py-4 rounded shadow-lg z-50">
            Signup was a success!
        </div>
        <script>
            setTimeout(() => {
                const popup = document.getElementById('success-popup');
                if (popup) {
                    popup.style.transition = 'opacity 0.5s';
                    popup.style.opacity = '0';
                    setTimeout(() => popup.remove(), 500);
                }
            }, 3000);
        </script>
        HTML;
    }
}
function check_email_errors()
{
    if (isset($_SESSION['errors_register'])) {
        $errors = $_SESSION['errors_register'];

        if (isset($errors["takenEmail"])) {
            echo <<<HTML
            <div class="absolute left-0 w-full text-red-500 text-sm font-bold mt-1 min-h-[1.5em]">
                {$errors["takenEmail"]}
            </div>
            HTML;
        } else {
            echo '<div class="absolute left-0 w-full min-h-[1.5em]"></div>';
        }
        if (isset($errors["invalidEmail"])) {
            echo <<<HTML
            <div class="absolute left-0 w-full text-red-500 text-sm font-bold mt-1 min-h-[1.5em]">
                {$errors["invalidEmail"]}
            </div>
            HTML;
        } else {
            echo '<div class="absolute left-0 w-full min-h-[1.5em]"></div>';
        }
    } else {
        echo '<div class="absolute left-0 w-full min-h-[1.5em]"></div>';
        echo '<div class="absolute left-0 w-full min-h-[1.5em]"></div>';
    }
}

function check_pwd_errors()
{
    if(isset($_SESSION['errors_register'])) {
        $errors = $_SESSION['errors_register'];

        if (isset($errors["notSafePwd"])) {
            echo <<<HTML
            <div class="absolute left-0 w-full text-red-500 text-sm font-bold mt-[-17px] min-h-[20px]">
                {$errors["notSafePwd"]}
            </div>
            HTML;
        } else {
            echo '<div class="absolute left-0 w-full min-h-[20px]"></div>';
        }
    } else {
        echo '<div class="absolute left-0 w-full min-h-[20px]"></div>';
    }
}

function check_username_errors()
{
    if (isset($_SESSION['errors_register'])) {
        $errors = $_SESSION['errors_register'];

        if (isset($errors["takenUsername"])) {
            echo <<<HTML
            <div class="absolute left-0 w-full text-red-500 text-sm font-bold mt-1 min-h-[1.5em]">
                {$errors["takenUsername"]}
            </div>
            HTML;
        } else {
            echo '<div class="absolute left-0 w-full min-h-[1.5em]"></div>';
        }
        if (isset($errors["invalidUsername"])) {
            echo <<<HTML
            <div class="absolute left-0 w-full text-red-500 text-sm font-bold mt-1 min-h-[1.5em]">
                {$errors["invalidUsername"]}
            </div>
            HTML;
        } else {
            echo '<div class="absolute left-0 w-full min-h-[1.5em]"></div>';
        }
    } else {
        echo '<div class="absolute left-0 w-full min-h-[1.5em]"></div>';
        echo '<div class="absolute left-0 w-full min-h-[1.5em]"></div>';
    }
}

function check_dob_errors()
{
    if (isset($_SESSION['errors_register'])) {
        $errors = $_SESSION['errors_register'];

        if (isset($errors["emptyDOB"])) {
            echo <<<HTML
            <div class="absolute left-0 w-full text-red-500 text-sm font-bold mt-11 min-h-[1.5em]">
                {$errors["emptyDOB"]}
            </div>
            HTML;
        } else {
            echo '<div class="absolute left-0 w-full min-h-[1.5em]"></div>';
        }
    } else {
        echo '<div class="absolute left-0 w-full min-h-[1.5em]"></div>';
    }
}

?>