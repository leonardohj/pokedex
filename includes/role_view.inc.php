<?php

function role_input()
{
?>
<h2 id="roles" class="#role text-xl font-bold mb-5">Give roles</h2>
<form action="includes/role.inc.php" method="POST">   
    <div class="mb-1">
        <label for="username" class="text-sm font-medium text-gray-700">Username</label>
        <br>
        <div class="relative" style="min-height:1.5em;">
        <?php
        $borderColor = "border-green-500";
        if(isset($_SESSION["role_data"]["username"]))
        {
            $hasErrors = isset($_SESSION["errors_role"]);
            $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
            echo '<input class="border '. $borderColor .' rounded-lg px-3 py-2 text-sm w-full" style="max-width:200px;" name="username" type="text" placeholder="username here...">';
            echo '<div class="w-full" style="min-height:1.5em;">';
            if($hasErrors)
            {
                check_username_errors();
            }
            echo '</div>';
        }
        else
        {
            echo '<input class="border border-gray-600 rounded-lg px-3 py-2 text-sm w-full" style="max-width:200px;" name="username" type="text" placeholder="username here...">';
            echo '<div class="w-full" style="min-height:1.5em;"></div>';
        }
        ?>
        </div>
    </div>
    <div class="mb-1">
        <label for="roles" class="text-sm font-medium text-gray-700">Roles</label>
        <br>
        <div class="relative" style="min-height:1.5em;">
        <?php        
        if(isset($_SESSION["role_data"]["roles"]))
        {
            $hasErrors = isset($_SESSION["errors_role"]);
            $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
            echo '<select class="border '. $borderColor .' rounded-lg px-3 text-sm py-2 w-full" style="max-width:200px;" name="roles">';
            echo '<option selected style="display:none" value="">choose role</option>';
            echo '<option value="admin">admin</option>';
            echo '<option value="support">support</option>';
            echo '<option value="peasent">peasent</option>';
            echo '</select>';
            echo '<div class="w-full" style="min-height:1.5em;">';
            if($hasErrors)
            {
                check_roles_errors();
            }
            echo '</div>';
        }
        else
        {
            echo '<select class="border border-gray-600 rounded-lg px-3 text-sm py-2 w-full" style="max-width:200px;" name="roles">';
            echo '<option selected style="display:none" value="">choose role</option>';
            echo '<option value="admin">admin</option>';
            echo '<option value="support">support</option>';
            echo '<option value="peasent">peasent</option>';
            echo '</select>';
            echo '<div class="w-full" style="min-height:1.5em;"></div>';
        }
        ?>
        </div>
    </div>
    <button class="mt-3 px-3 border border-red-500 bg-red-500 text-white font-bold rounded-lg py-2 transition hover:bg-red-600 shadow">
        Give the role
    </button>
</form>
<?php
    unset($_SESSION["role_data"]);
    unset($_SESSION["errors_role"]);
}

function printSucessfullRole()
{
    if (isset($_GET["rolegiven"]) && $_GET["rolegiven"] === "success")
    {
        echo <<<HTML
        <div id="success-popup" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-xl font-bold px-8 py-4 rounded shadow-lg z-50">
            The role was given sucessfully!
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

function check_username_errors()
{
    if(isset($_SESSION['errors_role']))
    {
        $errors = $_SESSION['errors_role'];

        if (isset($errors["emptyUsername"]))
        {
            echo <<<HTML
            <div class="text-red-500 text-sm font-bold break-normal">
                {$errors["emptyUsername"]}
            </div>
            HTML;
        } 
        else if(isset($errors["invalidUser"]))
        {
            echo <<<HTML
            <div class="text-red-500 text-sm font-bold break-normal">
                {$errors["invalidUser"]}
            </div>
            HTML;
        }
    }
}

function check_roles_errors()
{
    if(isset($_SESSION['errors_role']))
    {
        $errors = $_SESSION['errors_role'];

        if (isset($errors["emptyRole"]))
        {
            echo <<<HTML
            <div class="text-red-500 text-sm font-bold break-normal">
                {$errors["emptyRole"]}
            </div>
            HTML;
        }
    }
}
?>