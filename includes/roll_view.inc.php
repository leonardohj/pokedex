<?php

function roll_input()
{
?>
<p>Give roles</p>
    <form action="includes/roll.inc.php" method="POST">
        <label for="username">Username</label>
        <br>
        <?php
        
        if(isset($_SESSION["role_data"]["username"]))
        {
            $hasErrors = isset($_SESSION["errors_role"]["emptyUsername"]);
            $hasErrorsInvalidUser = isset($_SESSION["errors_role"]["invalidUser"]);
            if($hasErrors)
            {
                echo '<input  class="border border-red-500" name="username" type="text" placeholder="username here...">';
                echo '<div class=\'text-red-500 text-bold\'>' . $_SESSION["errors_role"]["emptyUsername"] . '</div>';
            }
            else if($hasErrorsInvalidUser)
            {
                echo '<input class="border border-red-500" name="username" type="text" placeholder="username here..." value="'. $_SESSION["role_data"]["username"] . '">';
                echo "<div class=\'text-red-500 text-bold\'>" . $_SESSION["errors_role"]["invalidUser"] . "</div>";
            }
            else
            {
                echo '<input class="border border-green-500" name="username" type="text" placeholder="username here..." value="'. $_SESSION["role_data"]["username"] . '">';
            }
        }
        else
        {
             echo '<input  class="border border-gray-600" name="username" type="text" placeholder="username here...">';
        }
        
        ?>
        <div></div>
        <label for="roles">Roles</label>
        <br>
            <?php        
            if(isset($_SESSION["role_data"]["roles"])) {
            $hasErrors = isset($_SESSION["errors_role"]["emptyRole"]);
            if($hasErrors)
            {
                echo '<select class="border border-red-500" name="roles">';
                echo '<option selected  style="display:none" value="">choose role</option>';
                echo '<option value="admin">admin</option>';
                echo '<option value="support">support</option>';
                echo '<option value="peasent">peasent</option>';
                echo '</select>';

                echo "<div class='text-red-500 text-bold'>" . $_SESSION["errors_role"]["emptyRole"] . "</div>";
            }
            else
            {
                echo '<select class="border border-green-500" name="roles">';
                echo '<option selected style="display:none" value="">choose role</option>';
                echo '<option value="admin">admin</option>';
                echo '<option value="support">support</option>';
                echo '<option value="peasent">peasent</option>';
                echo '</select>';
            }
            }
            else
            {
                echo '<select class="border border-gray-600" name="roles">';
                echo '<option selected style="display:none" value="">choose role</option>';
                echo '<option value="admin">admin</option>';
                echo '<option value="support">support</option>';
                echo '<option value="peasent">peasent</option>';
                echo '</select>';
            }
            ?>
            <div></div>
        <button>Give the role</button>
    </form>
    <?php
    
    unset($_SESSION["role_data"]);
    unset($_SESSION["errors_role"]);
    
    ?>
    </div>
<?php
}
function printSucessfullRole()
{
    if (isset($_GET["rolegiven"]) && $_GET["rolegiven"] === "success") {
        echo <<<HTML
        <div id="success-popup" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-xl font-bold px-8 py-4 rounded shadow-lg z-50">
            The roll was given sucessfully!
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
?>