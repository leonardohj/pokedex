<?php

function pokemon_input()
{
?>
<h2 id="#role" class="#role text-xl font-bold mb-5 mt-10">Create pokemons</h2>
<form action="includes/pokemon.inc.php" method="POST">
    <div class="flex flex-row gap-4">
        <div>
            <label for="pokemonName" class="text-sm font-medium text-gray-700">Pokemon name</label>
            <br>
            <div class="mb-1 mt-1">
            <?php
            if(isset($_SESSION["pokemon_data"]["pokemonName"]))
            {
                $hasErrors = isset($_SESSION["errors_pokemon"]["emptyName"]) || isset($_SESSION["errors_pokemon"]["duplicatePokemon"]);
                $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
                $value = htmlspecialchars($_SESSION["pokemon_data"]["pokemonName"]);
                echo '<input type="text" name="pokemonName" placeholder="name here..." class="border '. $borderColor .' rounded-lg px-3 py-2 text-sm" style="width: 200px; min-width: 200px; max-width: 200px;" value="'. $value .'">';

                if($hasErrors)
                {
                    check_pokemonName_errors();
                }
            }
            else
            {
                echo '<input type="text" name="pokemonName" placeholder="name here..." class="border border-gray-600 rounded-lg px-3 py-2 text-sm" style="width: 200px; min-width: 200px; max-width: 200px;">';
            }
            ?>
            </div>
        </div>
        <div>
            <label for="image" class="text-sm font-medium text-gray-700">Image</label>
            <div class="mt-1">
            <?php
            if(isset($_SESSION["pokemon_data"]["image"]))
            {
                $hasErrors = isset($_SESSION["errors_pokemon"]["emptyImage"]) || isset($_SESSION["errors_pokemon"]["imageNotLink"]);
                $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
                $value = htmlspecialchars($_SESSION["pokemon_data"]["image"]);
                echo '<input type="url" name="image" placeholder="image here..." class="border '. $borderColor .' rounded-lg px-3 py-2 text-sm" style="width: 200px; min-width: 200px; max-width: 200px;" value="'. $value .'">';

                if($hasErrors)
                {
                    check_image_errors();
                }
            }
            else
            {
                echo '<input type="url" name="image" placeholder="image here..." class="border border-gray-600 rounded-lg px-3 py-2 text-sm" style="width: 200px; min-width: 200px; max-width: 200px;">';
            }
            ?>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <label for="description" class="text-sm font-medium text-gray-700">Description</label>
        <br>
        <div class="mt-1">
        <?php
        if(isset($_SESSION["pokemon_data"]["description"]))
        {
            $hasErrors = isset($_SESSION["errors_pokemon"]["emptyDescription"]);
            $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
            $value = htmlspecialchars($_SESSION["pokemon_data"]["description"]);
            echo '<textarea name="description" id="description" cols="25" rows="5" class="border '. $borderColor .' rounded-lg px-3 py-2 text-sm" style="width: 420px; min-width: 420px; max-width: 420px; resize: none;">'. $value .'</textarea>';

            if($hasErrors)
            {
                check_description_errors();
            }
        }
        else
        {
            echo '<textarea name="description" id="description" cols="25" rows="5" class="border border-gray-600 rounded-lg px-3 py-2 text-sm" style="width: 420px; min-width: 420px; max-width: 420px; resize: none;"></textarea>';
        }
        ?>
        </div>
    </div>
    <div class="mt-4 mb-1">
        <label for="generation" class="text-sm font-medium text-gray-700">Generation</label>
        <div class="mt-1">
            <?php
                if(isset($_SESSION["pokemon_data"]["generation"]))
                {
                    $hasErrors = isset($_SESSION["errors_pokemon"]["emptyGen"]);
                    $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
                    $selectedGen = htmlspecialchars($_SESSION["pokemon_data"]["generation"]);
                    echo '<select name="generation" class="border '. $borderColor .' rounded-lg px-3 py-2 text-sm" style="width: 420px; min-width: 420px; max-width: 420px;">';
                    echo '<option selected  style="display:none" value="'. $selectedGen .'">'. $selectedGen .'</option>';
                }
                else
                {
                    echo '<select name="generation" class="border border-gray-600 rounded-lg px-3 py-2 text-sm" style="width: 420px; min-width: 420px; max-width: 420px;">';
                    echo '<option selected disabled style="display:none" value="">Choose generation</option>';
                }

                for($i = 1; $i <= 9; $i++)
                {
                    echo '<option value="'. $i .'">'. $i .'</option>';
                }
                echo '</select>';
            ?>
        </div>
        <?=check_generation_errors();?>
    </div>
    <div class="mt-5 mb-1">
        <button class="mt-3 px-3 border border-red-500 bg-red-500 text-white font-bold rounded-lg py-2 transition hover:bg-red-600 shadow">
            Create pokemon
        </button>
    </div>
</form>
<?php
    printSucessfullPokemon();
    
    unset($_SESSION["pokemon_data"]);
    unset($_SESSION["errors_pokemon"]);
}
function check_pokemonName_errors()
{
    if(isset($_SESSION['errors_pokemon']))
    {   
        $errors = $_SESSION['errors_pokemon'];

        if (isset($errors["emptyName"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold break-normal">
                {$errors["emptyName"]}
            </div>
            HTML;
        } 
        else if(isset($errors["duplicatePokemon"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold break-normal">
                {$errors["duplicatePokemon"]}
            </div>
            HTML;
        }
    }
}
function check_generation_errors()
{
    if(isset($_SESSION['errors_pokemon']))
    {   
        $errors = $_SESSION['errors_pokemon'];

        if (isset($errors["emptyGen"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold break-normal">
                {$errors["emptyGen"]}
            </div>
            HTML;
        }
    }
}
function check_description_errors()
{
    if(isset($_SESSION['errors_pokemon']))
    {   
        $errors = $_SESSION['errors_pokemon'];

        if (isset($errors["emptyDescription"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold break-normal">
                {$errors["emptyDescription"]}
            </div>
            HTML;
        }
    }
}
function check_image_errors()
{
    if(isset($_SESSION['errors_pokemon']))
    {   
        $errors = $_SESSION['errors_pokemon'];

        if (isset($errors["emptyImage"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold break-normal">
                {$errors["emptyImage"]}
            </div>
            HTML;
        } 
        else if(isset($errors["imageNotLink"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold break-normal">
                {$errors["imageNotLink"]}
            </div>
            HTML;
        }
    }
}

function printSucessfullPokemon()
{
    if (isset($_GET["pokemonCreated"]) && $_GET["pokemonCreated"] === "success")
    {
        echo <<<HTML
        <div id="success-popup" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-xl font-bold px-8 py-4 rounded shadow-lg z-50">
            The pokemon was created successfully!
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