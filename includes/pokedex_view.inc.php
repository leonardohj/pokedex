<?php
require_once 'pokedex_model.inc.php';

function show_pokedexs()
{

    if (!empty($_SESSION["pokedexs"])) {
        ?>
        
        <?php
        if($_SESSION['profileuser_username'] == $_SESSION['user_username'])
        {
            create_pokedex_input();
        }
        
        ?>
        
        <?php
    }
    else
    {
        if($_SESSION['profileuser_username'] == $_SESSION['user_username'])
        {
            echo '<div class="flex flex-col justify-center items-center">';
            echo 'You dont have any pokedexs click <br> on the button below  to create one!';
            create_pokedex_input();

            echo '</div>';
        }
        else
        {
            echo '<div class="">';
            echo 'This user does not <br> have any pokedexs...';
            echo '</div>';
        }
    }
}

function create_pokedex_input()
{
    ?>
    <button onclick="showModal()" id="showModalButton" class="mt-4 items-center gap-2 border bg-red-200 border-red-200 px-4 py-3 font-semibold rounded-lg text-md font-medium text-gray-700 hover:bg-red-300 transition w-full">
        + Create Pokédex
    </button>

    <div class="modal" id="modal" style="display: none;">
        <div style="background-color: rgba(0,0,0,0.4);" class="modal-behind-background fixed inset-0 w-screen h-screen flex items-center justify-center z-[1000]">
            <div>
                <div class="modal-background relative bg-white rounded-xl shadow-lg flex flex-col items-center justify-center top-0 min-w-100 z-[1010]">
                    <div class="close-modal-div absolute top-2 left-2 flex flex-row">
                        <button type="button" onclick="closeModal()">
                            <img src="img\close.webp" class="h-7 cursor-pointer">
                        </button>
                    </div>
                    <div class="modal-background bg-white items-center justify-center rounded-lg p-8 min-w-[620px] max-w-xs">
                        <div class="flex flex-row justify-center text-center items-center">
                            <img src="img\pokedexKantoIMG.webp" class="h-9 relative top-[-8px]"><h1 class="text-2xl font-bold mb-4 text-center ml-1">New Pokedex</h1>
                        </div>
                        <div class="relative mt-[-10px] mb-[2%]">
                            <h3 class="text-red-500 font-bold flex text-sm justify-center text-center items-center">Create an new pokedex here!</h3>
                        </div>
                        <form action="includes/pokedex.inc.php" method="POST" class="w-full flex flex-col gap-3">
                            <div class="mb-[-10px]"></div>
                            <div class="flex flex-row gap-8 items-start">
                                <div class="flex flex-col w-[320px]">
                                    <div class="flex flex-row items-center justify-between mb-2">
                                        <label for="pokedexName" class="text-sm font-medium text-gray-700">Name</label>
                                        <label for="generations" class="text-sm font-medium text-gray-700 ml-4 whitespace-nowrap absolute left-92">Generations</label>
                                    </div>
                                    <?php
                                    if(isset($_SESSION["pokedex_data"]["pokedexName"]))
                                    {
                                        $_SESSION["pokedex_data"]["pokedexName"] = $_SESSION["pokedex_data"]["pokedexName"] == '' ? '' : $_SESSION["pokedex_data"]["pokedexName"];
                                        echo '<script>window.addEventListener("DOMContentLoaded",function(){document.getElementById(\'modal\').style.display="block";});</script>';
                                        $hasErrors = isset($_SESSION["errors_pokedex"]);
                                        $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
                                        echo '<input type="text" name="pokedexName" placeholder="Name here" class="border '. $borderColor .' rounded-lg px-3 py-2 mb-5" value="'. $_SESSION["pokedex_data"]["pokedexName"]. '">';
                                        if($hasErrors)
                                        {
                                            check_pokedexName_errors();
                                        }
                                    }
                                    else
                                    {
                                        echo '<input type="text" name="pokedexName" placeholder="Name here" class="border border-gray-300 rounded-lg px-3 py-2 mb-5" style="width:320px;max-width:320px;min-width:320px;">';
                                    }
                                    ?>
                                    <label for="description"  class="text-sm font-medium text-gray-700 text-left">Description</label>
                                    <?php
                                    if(isset($_SESSION["pokedex_data"]["description"]))
                                    {
                                        $borderColor = "border-green-500";
                                        $_SESSION["pokedex_data"]["description"] = $_SESSION["pokedex_data"]["description"] == 'No description' ? '' : $_SESSION["pokedex_data"]["description"];
                                        echo '<textarea placeholder="Optional" name="description" id="description" cols="21" rows="6" class="border '. $borderColor.' rounded-lg px-3 py-2 text-sm w-full mt-2" style="width:320px;max-width:320px;min-width:320px;resize:none;">'. htmlspecialchars($_SESSION["pokedex_data"]["description"]) .'</textarea>';                                
                                    }
                                    else
                                    {
                                        echo '<textarea placeholder="Optional" name="description" id="description" cols="21" rows="6" class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-full mt-2" style="width:320px;max-width:320px;min-width:320px;resize:none;"></textarea>';     
                                    }
                                    ?>
                                    <input type="submit" class="mt-4 w-138 border border-red-500 bg-red-500 text-white text font-bold rounded-lg py-2 transition hover:bg-red-600"></input>
                                </div>
                                <?php
                                if(isset($_SESSION["pokedex_data"]["generations"]))
                                {
                                    $hasErrors = isset($_SESSION["errors_pokedex"]);
                                    $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
                                    $selectedGens = isset($_SESSION["pokedex_data"]["generations"]) && is_array($_SESSION["pokedex_data"]["generations"]) ? $_SESSION["pokedex_data"]["generations"] : [];
                                    ?>
                                    <div class="flex flex-row gap-8 w-[220px] mt-7" id="generations-checkbox-group">
                                        <div class="flex flex-col gap-2">
                                            <?php
                                            $gens1 = [1,2,3,4,5];
                                            $labels = ["Kanto","Johto","Hoenn","Sinnoh","Unova"];
                                            foreach ($gens1 as $idx => $gen) {
                                                $checked = in_array((string)$gen, $selectedGens) ? 'checked' : '';
                                                echo '<label class="inline-flex items-center">';
                                                echo '<input type="checkbox" name="generations[]" value="'.$gen.'" class="form-checkbox text-red-500 generations-required" '.$checked.' />';
                                                echo '<span class="ml-2">'.$labels[$idx].'</span>';
                                                echo '</label>';
                                            }
                                            ?>
                                        </div>
                                        <div class="flex flex-col gap-2 mt-0">
                                            <?php
                                            $gens2 = [6,7,8,9];
                                            $labels2 = ["Kalos","Alola","Galar","Paldea"];
                                            foreach ($gens2 as $i => $gen) {
                                                $checked = in_array((string)$gen, $selectedGens) ? 'checked' : '';
                                                echo '<label class="inline-flex items-center">';
                                                echo '<input type="checkbox" name="generations[]" value="'.$gen.'" class="form-checkbox text-red-500 generations-required" '.$checked.' />';
                                                echo '<span class="ml-2">'.$labels2[$i].'</span>';
                                                echo '</label>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    if($hasErrors)
                                    {
                                        check_generations_errors();                        
                                    } 
                                }
                                else
                                {
                                ?>
                                <div class="flex flex-row gap-8 w-[220px] mt-7" id="generations-checkbox-group">
                                    <div class="flex flex-col gap-2">
                                        <?php
                                        $gens1 = [1,2,3,4,5];
                                        $labels = ["Kanto","Johto","Hoenn","Sinnoh","Unova"];
                                        foreach ($gens1 as $idx => $gen) {
                                            echo '<label class="inline-flex items-center">';
                                            echo '<input type="checkbox" name="generations[]" value="'.$gen.'" class="form-checkbox text-red-500 generations-required" />';
                                            echo '<span class="ml-2">'.$labels[$idx].'</span>';
                                            echo '</label>';
                                        }
                                        ?>
                                    </div>
                                    <div class="flex flex-col gap-2 mt-0">
                                        <?php
                                        $gens2 = [6,7,8,9];
                                        $labels2 = ["Kalos","Alola","Galar","Paldea"];
                                        foreach ($gens2 as $i => $gen) {
                                            echo '<label class="inline-flex items-center">';
                                            echo '<input type="checkbox" name="generations[]" value="'.$gen.'" class="form-checkbox text-red-500 generations-required" />';
                                            echo '<span class="ml-2">'.$labels2[$i].'</span>';
                                            echo '</label>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                
                                <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const form = document.querySelector('form[action="includes/pokedex.inc.php"]');
                            if(form) {
                                form.addEventListener('submit', function(e) {
                                    // Always get checkboxes inside the form on submit
                                    const checkboxes = form.querySelectorAll('.generations-required');
                                    let checked = false;
                                    checkboxes.forEach(cb => { if(cb.checked) checked = true; });
                                    if(!checked) {
                                        e.preventDefault();
                                        alert('Please select at least one generation.');
                                    }
                                });
                            }
                        });
                    </script>
                <?php
                ?>
            </div>
        </div>
    </div>
    <?=printSuccessfullPokedexCreated();?>
    <script>
        function showModal()
        {
            document.getElementById("modal").style.display = "block"; 
        }

        function closeModal()
        {
            document.getElementById("modal").style.display = "none";
        }
    </script>
<?php

}
function editModal($pokedex)
{
    $_SESSION["actual_pokedex_name"] = $pokedex['name'];
    ?>
    
    <button onclick="showEditModal()" id="showEditModalButton"><img src="img/pencilEdit.svg" class="ml-8 mr-2 h57 w-5"></button> 
    <form action="includes/pokedex_delete.inc.php" method="POST" onsubmit="return confirmDeletePokedex();">
        <button type="submit"><img src="img/trash.png" class="ml-2 h57 w-5"></button>
    </form>
    <div class="modal2" id="modal2" style="display: none;">
        <div style="background-color: rgba(0,0,0,0.4);" class="modal-behind-background fixed inset-0 w-screen h-screen flex items-center justify-center z-[1000]">
            <div>
                <div class="modal-background relative bg-white rounded-xl shadow-lg flex flex-col items-center justify-center top-0 min-w-100 z-[1010]">
                    <div class="close-modal-div absolute top-2 left-2 flex flex-row">
                        <button type="button" onclick="closeEditModal()">
                            <img src="img\close.webp" class="h-7 cursor-pointer">
                        </button>
                    </div>
                    <div class="modal-background bg-white items-center justify-center rounded-lg p-8 min-w-[620px] max-w-xs">
                        <div class="flex flex-row justify-center text-center items-center">
                            <img src="img\pokedexKantoIMG.webp" class="h-9 relative top-[-8px]"><h1 class="text-2xl font-bold mb-4 text-center ml-1">Edit Pokedex</h1>
                        </div>
                        <div class="relative mt-[-10px] mb-[2%]">
                            <h3 class="text-red-500 font-bold flex text-sm justify-center text-center items-center">Edit your pokedex here!</h3>
                        </div>
                        <form action="includes/pokedex_edit.inc.php" method="POST" class="w-full flex flex-col gap-3">
                            <div class="mb-[-10px]"></div>
                            <div class="flex flex-row gap-8 items-start">
                                <div class="flex flex-col w-[320px]">
                                    <div class="flex flex-row items-center justify-between mb-2">
                                        <label for="pokedexNameEdit" class="text-sm font-medium text-gray-700">Name</label>
                                        <label for="generationsEdit" class="text-sm font-medium text-gray-700 ml-4 whitespace-nowrap absolute left-92">Generations</label>
                                    </div>
                                    <?php
                                    if(isset($_SESSION["pokedex_data"]["pokedexNameEdit"]))
                                    {
                                        $_SESSION["pokedex_data"]["pokedexNameEdit"] = $_SESSION["pokedex_data"]["pokedexNameEdit"] == '' ? '' : $_SESSION["pokedex_data"]["pokedexNameEdit"];
                                        $hasErrors = isset($_SESSION["errors_pokedexEdit"]);
                                        $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
                                        echo '<input type="text" name="pokedexNameEdit" placeholder="Name here" class="border '. $borderColor .' rounded-lg px-3 py-2 mb-5" value="'. $_SESSION["pokedex_data"]["pokedexNameEdit"]. '">';
                                        if($hasErrors)
                                        {
                                            check_pokedexNameEdit_errors();
                                        }
                                    }
                                    else
                                    {
                                        echo '<input type="text" name="pokedexNameEdit" placeholder="Name here" class="border border-gray-600 rounded-lg px-3 py-2 mb-5" style="width:320px;max-width:320px;min-width:320px;" value="'. $pokedex['name'] . '">';
                                    }
                                    ?>
                                    <label for="descriptionEdit"  class="text-sm font-medium text-gray-700 text-left">Description</label>
                                    <?php
                                    if(isset($_SESSION["pokedex_data"]["descriptionEdit"]))
                                    {
                                        $borderColor = "border-green-500";
                                        $_SESSION["pokedex_data"]["descriptionEdit"] = $_SESSION["pokedex_data"]["descriptionEdit"] == 'No description' ? '' : $_SESSION["pokedex_data"]["descriptionEdit"];
                                        echo '<textarea placeholder="Optional" name="descriptionEdit" id="descriptionEdit" cols="21" rows="6" class="border '. $borderColor.' rounded-lg px-3 py-2 text-sm w-full mt-2" style="width:320px;max-width:320px;min-width:320px;resize:none;">'. htmlspecialchars($_SESSION["pokedex_data"]["descriptionEdit"]) .'</textarea>';                                
                                    }
                                    else
                                    {
                                        echo '<textarea placeholder="Optional" name="descriptionEdit" id="descriptionEdit" cols="21" rows="6" class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-full mt-2" style="width:320px;max-width:320px;min-width:320px;resize:none;">'.$pokedex['description'].'</textarea>';     
                                    }
                                    ?>
                                    <input type="submit" class="mt-4 w-138 border border-red-500 bg-red-500 text-white text font-bold rounded-lg py-2 transition hover:bg-red-600"></input>
                                </div>
                                <?php
                                if(isset($_SESSION["pokedex_data"]["generationsEdit"]))
                                {
                                    $hasErrors = isset($_SESSION["errors_pokedexEdit"]);
                                    $borderColor = $hasErrors ? "border-red-500" : "border-green-500";
                                    $selectedGens = isset($_SESSION["pokedex_data"]["generationsEdit"]) && is_array($_SESSION["pokedex_data"]["generationsEdit"]) ? $_SESSION["pokedex_data"]["generationsEdit"] : [];
                                    ?>
                                    <div class="flex flex-row gap-8 w-[220px] mt-7" id="generations-checkbox-group">
                                        <div class="flex flex-col gap-2">
                                            <?php
                                            $gens1 = [1,2,3,4,5];
                                            $labels = ["Kanto","Johto","Hoenn","Sinnoh","Unova"];
                                            $selectedGens = [];
                                            if (isset($pokedex['generations'])) {
                                                if (is_array($pokedex['generations'])) {
                                                    $selectedGens = $pokedex['generations'];
                                                } else {
                                                    $selectedGens = str_split($pokedex['generations']);
                                                }
                                            }
                                            foreach ($gens1 as $idx => $gen) {
                                                $checked = in_array((string)$gen, $selectedGens) ? 'checked' : '';
                                                echo '<label class="inline-flex items-center">';
                                                echo '<input type="checkbox" name="generationsEdit[]" value="'.$gen.'" class="form-checkbox text-red-500 generations-required" '.$checked.' />';
                                                echo '<span class="ml-2">'.$labels[$idx].'</span>';
                                                echo '</label>';
                                            }
                                            ?>
                                        </div>
                                        <div class="flex flex-col gap-2 mt-0">
                                            <?php
                                            $gens2 = [6,7,8,9];
                                            $labels2 = ["Kalos","Alola","Galar","Paldea"];
                                            foreach ($gens2 as $i => $gen) {
                                                $checked = in_array((string)$gen, $selectedGens) ? 'checked' : '';
                                                echo '<label class="inline-flex items-center">';
                                                echo '<input type="checkbox" name="generationsEdit[]" value="'.$gen.'" class="form-checkbox text-red-500 generations-required" '.$checked.' />';
                                                echo '<span class="ml-2">'.$labels2[$i].'</span>';
                                                echo '</label>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    if($hasErrors)
                                    {
                                        check_generationsEdit_errors();                        
                                    } 
                                }
                                else
                                {
                                ?>
                                    <div class="flex flex-row gap-8 w-[220px] mt-7" id="generations-checkbox-group">
                                        <div class="flex flex-col gap-2">
                                            <?php
                                            $gens1 = [1,2,3,4,5];
                                            $labels = ["Kanto","Johto","Hoenn","Sinnoh","Unova"];
                                            $selectedGens = [];
                                            if (isset($pokedex['generations'])) {
                                                if (is_array($pokedex['generations'])) {
                                                    $selectedGens = $pokedex['generations'];
                                                } else {
                                                    $selectedGens = str_split($pokedex['generations']);
                                                }
                                            }
                                            foreach ($gens1 as $idx => $gen) {
                                                $checked = in_array((string)$gen, $selectedGens) ? 'checked' : '';
                                                echo '<label class="inline-flex items-center">';
                                                echo '<input type="checkbox" name="generationsEdit[]" value="'.$gen.'" class="form-checkbox text-red-500 generations-required" '.$checked.' />';
                                                echo '<span class="ml-2">'.$labels[$idx].'</span>';
                                                echo '</label>';
                                            }
                                            ?>
                                        </div>
                                        <div class="flex flex-col gap-2 mt-0">
                                            <?php
                                            $gens2 = [6,7,8,9];
                                            $labels2 = ["Kalos","Alola","Galar","Paldea"];
                                            foreach ($gens2 as $i => $gen) {
                                                $checked = in_array((string)$gen, $selectedGens) ? 'checked' : '';
                                                echo '<label class="inline-flex items-center">';
                                                echo '<input type="checkbox" name="generationsEdit[]" value="'.$gen.'" class="form-checkbox text-red-500 generations-required" '.$checked.' />';
                                                echo '<span class="ml-2">'.$labels2[$i].'</span>';
                                                echo '</label>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    
                                
                                <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const modal2 = document.getElementById('modal2');
                            if (!modal2) return;
                            const form2 = modal2.querySelector('form[action="includes/pokedex_edit.inc.php"]');
                            if (!form2) return;
                            form2.addEventListener('submit', function(e) {
                                const checkboxes = form2.querySelectorAll('.generations-required');
                                let checked = false;
                                checkboxes.forEach(cb => { if(cb.checked) checked = true; });
                                if(!checked) {
                                    e.preventDefault();
                                    alert('Please select at least one generation.');
                                }
                            });
                        });
                    </script>
                <?php
                ?>
            </div>
        </div>
    </div>
    <?=printSuccessfullPokedexCreated();?>
    <script>
        function showEditModal()
        {
            document.getElementById("modal2").style.display = "block"; 
        }

        function closeEditModal()
        {
            document.getElementById("modal2").style.display = "none";
        }
        function confirmDeletePokedex()
        {
            return confirm("You sure you want to delete this pokedex?");
        }
    </script>
    <?php
    if(isset($_GET['edited']) && $_GET['edited'] === "wentwrong")
    {
        echo '<script>showEditModal();</script>';
    }

}
function show_pokedex_content()
{
    if (isset($_GET["pokedex"])) 
    {
        foreach($_SESSION["pokedexs"] as $pokedex) 
        {
            if($_GET["pokedex"] == $pokedex['name'])
            {
                $_SESSION["INpokedex"] = $pokedex['name'];
                echo '<div class="bg-white rounded-xl p-8 mb-6">';
                
                echo '<div class="flex items-center mb-2">';
                echo '<img src="img/pokedexKantoIMG.webp" class="h-8 w-8 mr-2" alt="Dex">';
                echo '<span class="text-2xl font-bold text-gray-800">'. htmlspecialchars($pokedex['name']) . '</span>';
                echo $_SESSION['profileuser_username'] == $_SESSION['user_username'] ? editModal($pokedex) : '';
                echo '</div>';
                
                if (!empty($pokedex['description'])) {
                    echo '<div class="text-gray-600 mb-2">'. htmlspecialchars($pokedex['description']) . '</div>';
                }
                
                echo '<div class="flex flex-row gap-8 text-sm text-gray-500 mb-4">';
                echo '<div><span class="font-semibold">Game:</span> <span>NOT DONE YET</span></div>';
                echo '<div><span class="font-semibold">Pokémon caught:</span> <span>NOT DONE YET</span></div>';
                echo '</div>';
                echo '<hr class="mb-5">';
                
                $gensPokedex = str_split($pokedex['generations']);
                $allGens = range(1, 9);
                foreach ($allGens as $g) {
                    if (in_array((string)$g, $gensPokedex)) {
                        echo '<div class="mb-6">';
                        echo '<div class="flex items-center mb-2">';
                        echo '<span class="text-lg font-semibold text-red-600">Generation '.  $g . '</span>';
                        echo '<hr class="flex-1 ml-3 border-t-2 border-red-200 w-[100px]">';
                        echo '</div>';
                        echo '<div class="flex flex-row flex-wrap gap-4 justify-start">';
                        show_pokemons_by_generation($g);
                        echo '</div>';
                        echo '</div>';
                    } 
                }
                echo '</div>';
                unsetdata($pokedex['name']);
            }
        }
    }
    else
    {
        $_SESSION["INpokedex"] = '';
    }
}

function show_pokemons_by_generation($g)
{

    if (!empty($_SESSION["pokemonsPokedex"][$g])) {
        foreach($_SESSION["pokemonsPokedex"][$g] as $pokemon) {
            echo '<div class="p-4 bg-white border border-gray-300 rounded-xl basis-1/7 max-w-[50%] min-w-[180px] h-70 max-h-70 min-h-70 text-wrap text-center flex flex-col items-center">';
            echo '<img src="' . htmlspecialchars($pokemon['image']) . '" class="h-30 w-30" />';
            echo htmlspecialchars($pokemon['name']);
            echo '<p class="mt-2">' . colors_type($pokemon) . '</p>';
            echo '</div>';
        }
    }
}
function unsetdata($typedata)
{
    if(!isset($_SESSION["errors_pokedex"]) || !$_SESSION["errors_pokedexEdit"])
    {
        unset($_SESSION["pokedex_data"]);
    }
    if($typedata === "edit")
    {
        unset($_SESSION["errors_pokedexEdit"]);
    }
    else if($typedata === "create")
    {
        unset($_SESSION["errors_pokedex"]);
    }
    if(!isset($_GET["pokedex"]) && $_GET["pokedex"] !== $typedata)
    {
        unset($_SESSION["errors_pokedexEdit"]);
        unset($_SESSION["pokedex_data"]);
    }
}
function colors_type($pokemon)
{
    $types = [
        "Normal"   => "bg-gray-300", 
        "Fire"     => "bg-[#F08030]", 
        "Fighting" => "bg-[#C03028]",  
        "Water"    => "bg-[#6890F0]", 
        "Flying"   => "bg-[#A890F0]", 
        "Grass"    => "bg-[#78C850]", 
        "Poison"   => "bg-[#A040A0]", 
        "Eletric"  => "bg-[#F8D030]", 
        "Ground"   => "bg-[#E0C068]",
        "Psychic"  => "bg-[#F85888]", 
        "Rock"     => "bg-[#B8A038]", 
        "Ice"      => "bg-[#98D8D8]", 
        "Bug"      => "bg-[#A8B820]", 
        "Dragon"   => "bg-[#7038F8]", 
        "Ghost"    => "bg-[#705898]", 
        "Dark"     => "bg-[#705848]", 
        "Steel"    => "bg-[#B8B8D0]", 
        "Fairy"    => "bg-[#EE99AC]", 
        "Stellar"  => "grad1"
    ];
    ?>
    <style>
        .grad1 {
            height: 28px;
            background: linear-gradient(90deg, #f00 0%, #ff0 100%);
        }
    </style>
    <?php
    foreach($types as $typename => $typecolor)
    {   
        if($typename == $pokemon['type1'])
        {
            ?>
            <div class="<?=$typecolor?> border rounded-lg w-18 h-7 flex items-center justify-center font-bold text-white"><?=$typename?></div>
            <?php
        }
        if($typename == $pokemon['type2'] && $pokemon['type2'] && $pokemon['type2'] != $pokemon['type1'])
        {
            ?>
            <div class="<?=$typecolor?> border rounded-lg w-18 h-7 flex items-center justify-center font-bold text-white"><?=$typename?></div>
            <?php
        }
    }
}
function check_pokedexName_errors()
{
    if(isset($_SESSION['errors_pokedex'])) {
        $errors = $_SESSION['errors_pokedex'];

        if (isset($errors["emptyInputName"])) {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold mt-[70px] break-normal">
                {$errors["emptyInputName"]}
            </div>
            HTML;
        } 
        else if(isset($errors["usedPokedexName"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold mt-[70px] break-normal">
                {$errors["usedPokedexName"]}
            </div>
            HTML;
        } else {
            echo '<div class="absolute left-0 w-full mt-1';
        }
    }
}
function check_pokedexNameEdit_errors()
{
    if(isset($_SESSION['errors_pokedexEdit'])) {
        $errors = $_SESSION['errors_pokedexEdit'];

        if (isset($errors["emptyInputNameEdit"])) {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold mt-[70px] break-normal">
                {$errors["emptyInputNameEdit"]}
            </div>
            HTML;
        } 
        else if(isset($errors["usedPokedexNameEdit"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold mt-[70px] break-normal">
                {$errors["usedPokedexNameEdit"]}
            </div>
            HTML;
        } else {
            echo '<div class="absolute left-0 w-full mt-1';
        }
    }
}
function check_generations_errors()
{
    if(isset($_SESSION['errors_pokedex'])) {
        $errors = $_SESSION['errors_pokedex'];

        if (isset($errors["emptyInputGen"])) {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold mt-[180px] ml-[350px] break-normal">
                {$errors["emptyInputGen"]}
            </div>
            HTML;
        } 
    } 
}
function check_generationsEdit_errors()
{
    if(isset($_SESSION['errors_pokedexEdit'])) {
        $errors = $_SESSION['errors_pokedexEdit'];

        if (isset($errors["emptyInputGenEdit"])) {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold mt-[180px] ml-[350px] break-normal">
                {$errors["emptyInputGenEdit"]}
            </div>
            HTML;
        } 
    } 
}

function printSuccessfullPokedexCreated()
{
    if (isset($_GET["created"]) && $_GET["created"] === "success") {
        echo <<<HTML
        <div id="success-popup" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white text-xl font-bold px-8 py-4 rounded shadow-lg z-50">
            Pokedex was created!
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