<?php

function pokemon_input()
{
?>
<h2 id="pokemon" class="#role text-xl font-bold mb-5 mt-10">Create pokemons</h2>
<form action="includes/pokemon.inc.php" method="POST">
    <div class="flex flex-row gap-4">
        <div>
            <label for="pokemonName" class="text-sm font-medium text-gray-700">Name</label>
            <br>
            <div class="mb-5 mt-1 relative">
            <?php
            if(isset($_SESSION["pokemon_data"]["pokemonName"]))
            {
                $hasErrors = isset($_SESSION["errors_pokemon"]["emptyName"]) || isset($_SESSION["errors_pokemon"]["duplicatePokemon"]);
                $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
                $value = htmlspecialchars($_SESSION["pokemon_data"]["pokemonName"]);
                echo '<input type="text" name="pokemonName" placeholder="Name here..." class="border '. $borderColor .' rounded-lg pr-18 px-3 py-2 text-sm w-full" style="max-width:200px;" value="'. $value .'">';
                if($hasErrors)
                {
                    check_pokemonName_errors();
                }
            }
            else
            {
                echo '<input type="text" name="pokemonName" placeholder="Name here..." class="border border-gray-600 rounded-lg pr-18 px-3 py-2 text-sm w-full" style="max-width:200px;">';
            }
            ?>
            </div>
        </div>
        <div>
            <label for="image" class="text-sm font-medium text-gray-700">Image</label>
            <div class="mt-1 relative">
            <?php
            if(isset($_SESSION["pokemon_data"]["image"]))
            {
                $hasErrors = isset($_SESSION["errors_pokemon"]["emptyImage"]) || isset($_SESSION["errors_pokemon"]["imageNotLink"]);
                $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
                $value = htmlspecialchars($_SESSION["pokemon_data"]["image"]);
                echo '<input type="url" name="image" placeholder="Image here..." class="border '. $borderColor .' rounded-lg px-3 pr-18 py-2 text-sm w-full" style="max-width:200px;" value="'. $value .'">';
                if($hasErrors)
                {
                    check_image_errors();
                }
            }
            else
            {
                echo '<input type="url" name="image" placeholder="Image here..." class="border border-gray-600 rounded-lg px-3 pr-18 py-2 text-sm w-full" style="max-width:200px;">';
            }
            ?>
            </div>
        </div>
    </div>
        <div class="flex flex-row gap-4">
        <div>
            <label for="pokemontype1" class="text-sm font-medium text-gray-700">Type 1</label>
            <br>
            <div class="mb-1 mt-1 relative">
            <?php
            $types = [
                "Normal","Fire","Fighting","Water","Flying","Grass","Poison","Eletric","Ground","Psychic","Rock","Ice","Bug","Dragon","Ghost","Dark","Steel","Fairy","Stellar"
            ];
            if(isset($_SESSION["pokemon_data"]["type1"]))
            {
                $hasErrors = isset($_SESSION["errors_pokemon"]["emptyType1"]) || isset($_SESSION["errors_pokemon"]["duplicateType"]);
                $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
                $value = htmlspecialchars($_SESSION["pokemon_data"]["type1"]);
                echo '<select name="pokemontype1" class="border '. $borderColor .' rounded-lg px-3 w-50 py-2 text-sm" style="max-width:420px;">';
                echo '<option value=""'.($value == '' ? ' selected' : '').'>None</option>';
                
                foreach($types as $type) {
                    $selected = ($value == $type) ? ' selected' : '';
                    echo '<option value="'.$type.'"'.$selected.'>'.$type.'</option>';
                }
                echo '</select>';
                if($hasErrors)
                {
                    check_type1_errors();
                }
            }
            else
            {
                    echo '<select name="pokemontype1" class="border border-gray-600 rounded-lg px-3 w-50 py-2 text-sm" style="max-width:420px;">';
                echo '<option value="" selected>None</option>';
                foreach($types as $type) {
                    echo '<option value="'.$type.'">'.$type.'</option>';
                }
                echo '</select>';
            }
            ?>
            </div>
        </div>
        <div>
            <label for="pokemontype2" class="text-sm font-medium text-gray-700">Type 2</label>
            <div class="mt-1 relative">
            <?php
            $types = [
                "Normal","Fire","Fighting","Water","Flying","Grass","Poison","Eletric","Ground","Psychic","Rock","Ice","Bug","Dragon","Ghost","Dark","Steel","Fairy","Stellar"
            ];
            if(isset($_SESSION["pokemon_data"]["type2"]))
            {
                $hasErrors = isset($_SESSION["errors_pokemon"]["duplicateType"]);
                $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
                $value = htmlspecialchars($_SESSION["pokemon_data"]["type2"]);
                echo '<select name="pokemontype2" class="border '. $borderColor .' rounded-lg px-3 w-50 py-2 text-sm" style="max-width:420px;">';
                echo '<option value=""'.($value == '' ? ' selected' : '').'>None</option>';
                foreach($types as $type) {
                    $selected = ($value === $type) ? ' selected' : '';
                    echo '<option value="'.$type.'"'.$selected.'>'.$type.'</option>';
                }
                echo '</select>';
                if($hasErrors)
                {
                    check_type2_errors();
                }
            }
            else
            {
                echo '<select name="pokemontype2" class="border border-gray-600 rounded-lg px-3 w-50 py-2 text-sm" style="max-width:420px;">';
                echo '<option value="" selected>None</option>';
                foreach($types as $type) {
                    echo '<option value="'.$type.'">'.$type.'</option>';
                }
                echo '</select>';
            }
            ?>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <label for="pokedexEntry" class="text-sm font-medium text-gray-700">Pokedex Entry</label>
        <br>
        <div class="mt-1 relative">
        <?php
        if(isset($_SESSION["pokemon_data"]["pokedexEntry"]))
        {
            $hasErrors = isset($_SESSION["errors_pokemon"]["emptyPokedexEntry"]);
            $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
            $value = htmlspecialchars($_SESSION["pokemon_data"]["pokedexEntry"]);
            echo '<textarea name="pokedexEntry" id="pokedexEntry" cols="25" rows="5" class="border '. $borderColor .' rounded-lg px-3 py-2 text-sm w-full" style="max-width:420px;resize:none;">'. $value .'</textarea>';
            if($hasErrors)
            {
                check_pokedexEntry_errors();
            }
        }
        else
        {
            echo '<textarea name="pokedexEntry" id="pokedexEntry" cols="25" rows="5" class="border border-gray-600 rounded-lg px-3 py-2 text-sm w-full" style="max-width:420px;resize:none;"></textarea>';
        }
        ?>
        </div>
    </div>
    <div class="mt-4 mb-1">
        <label for="generation" class="text-sm font-medium text-gray-700">Generation</label>
        <div class="mt-1 relative">
            <?php
                if(isset($_SESSION["pokemon_data"]["generation"]))
                {
                    $hasErrors = isset($_SESSION["errors_pokemon"]["emptyGen"]);
                    $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
                    $selectedGen = htmlspecialchars($_SESSION["pokemon_data"]["generation"]);

                    echo '<select name="generation" class="border '. $borderColor .' rounded-lg px-3 py-2 text-sm w-full" style="max-width:420px;">';
                    echo '<option selected style="display:none" value="'.$selectedGen.'">' . $selectedGen == '' ? "Choose generation" : $selectedGen .'</option>';
                }
                else
                {
                    echo '<select name="generation" class="border border-gray-600 rounded-lg px-3 py-2 text-sm w-full" style="max-width:420px;">';
                    echo '<option selected disabled style="display:none" value="">Choose generation</option>';
                }

                for($i = 1; $i <= 9; $i++)
                {
                    echo '<option value="'. $i .'">'. $i .'</option>';
                }
                echo '</select>';
                if(isset($hasErrors) && $hasErrors)
                {
                    check_generation_errors();
                }
            ?>
        </div>
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
function check_type1_errors()
{
    if(isset($_SESSION['errors_pokemon']))
    {   
        $errors = $_SESSION['errors_pokemon'];

        if (isset($errors["emptyType1"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold break-normal">
                {$errors["emptyType1"]}
            </div>
            HTML;
        }
        elseif (isset($errors["duplicateType"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold break-normal">
                {$errors["duplicateType"]}
            </div>
            HTML;
        }
}
}
function check_type2_errors()
{
    if(isset($_SESSION['errors_pokemon']))
    {   
        $errors = $_SESSION['errors_pokemon'];

        if (isset($errors["duplicateType"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold break-normal">
                {$errors["duplicateType"]}
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
function check_pokedexEntry_errors()
{
    if(isset($_SESSION['errors_pokemon']))
    {   
        $errors = $_SESSION['errors_pokemon'];

        if (isset($errors["emptyPokedexEntry"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold break-normal">
                {$errors["emptyPokedexEntry"]}
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