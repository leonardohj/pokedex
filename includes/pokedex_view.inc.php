<?php
function show_pokedexs()
{

    if (!empty($_SESSION["pokedexs"])) {
        ?>
        
        <?php
        foreach($_SESSION["pokedexs"] as $pokedex) 
        {

            echo '<li class="transition hover:scale-[1.03] rounded-lg ">
                    <a href="#" class="block px-4 mt-1 py-2 rounded focus:bg-gray-100 hover:bg-gray-100 text-gray-800 font-medium transition">' . htmlspecialchars($pokedex['name']) . '</a>
                </li>';
        }

        create_pokedex_input();
        ?>
        
        <?php
    }
    else
    {
        if($_SESSION['profileuser_username'] == $_SESSION['user_username'])
        {
            echo '<div class="flex flex-col items-center justify-center text-center mt-4 w-65">';
            echo 'You dont have any pokedexs click <br> on the button below  to create one!';
            create_pokedex_input();
            echo '</div>';
        }
        else
        {
            echo '<div class="flex flex-col items-center justify-center text-center mt-4 w-65">';
            echo 'This user does not <br> have any pokedexs...';
            echo '</div>';
        }
    }
}

function create_pokedex_input()
{
    ?>

        
        <button onclick="showModal()" id="showModalButton" class="border border-red-500 bg-red-500 text-white text-bold rounded-lg p-1 mt-4">New DEX</button>
        <div class="modal" id="modal">
            <script>
                document.getElementById("modal").style.display = "none";
            </script>
            <div style="background-color: rgba(0,0,0,0.4);" class="modal-behind-background fixed inset-0 w-screen h-screen flex items-center justify-center">
                <div>
                    <div class="modal-background relative bg-white rounded-xl shadow-lg flex flex-col items-center justify-center top-0 min-w-100">
                        <div class="close-modal-div absolute top-2 left-2 flex flex-row">
                        <button onclick="closeModal()">
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
                                <div class="mb-[-10px]">
                                </div>
                                    <div class="flex flex-row gap-8 items-start">
                                        <div class="flex flex-col w-[320px]">
                                            <div class="flex flex-row items-center justify-between mb-2">
                                                <label for="pokedexName" class="text-sm font-medium text-gray-700">Name</label>
                                                <label for="generations" class="text-sm font-medium text-gray-700 ml-4 whitespace-nowrap absolute left-92">Generations</label>
                                            </div>
                                            
                                            
                                <?php
                                if(isset($_SESSION["pokedex_data"]["pokedexName"]))
                                {
                                ?>
                                <script> document.getElementById("modal").style.display = "block" </script>
                                <?php

                                $hasErrors = isset($_SESSION["errors_pokedex"]);
                                $borderColor = $hasErrors ? "border-red-500" : "border-green-500";

                                
                                echo '<input type="text" name="pokedexName" placeholder="Name here" class="border '. $borderColor .' rounded-lg px-3 py-2 mb-5" >';
                                
                                if($hasErrors)
                                {
                                    check_pokedexName_errors();
                                }
                                
                                }
                                else
                                {
                                    echo '<input type="text" name="pokedexName" placeholder="Name here" class="border border-gray-600 rounded-lg px-3 py-2 mb-5" style="width:320px;max-width:320px;min-width:320px;">';
                                }
                                ?>
                                <label for="description"  class="text-sm font-medium text-gray-700 text-left">Description</label>
                                <?php

                                if(isset($_SESSION["pokedex_data"]["description"]))
                                {

                                $borderColor = "border-green-500";

                                
                                echo '<textarea placeholder="Optional" name="description" id="description" cols="21" rows="6" class="border '. $borderColor.' rounded-lg px-3 py-2 text-sm w-full mt-2" style="width:320px;max-width:320px;min-width:320px;resize:none;"></textarea>';                                
                                
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

                                    ?>
                                        <div class="flex flex-row gap-8 w-[220px] mt-7">
                                            <div class="flex flex-col gap-2">
                                                <label class="inline-flex items-center">
                                                    
                                                    <input type="checkbox" name="generations[]" value="1" class="form-checkbox text-red-500" />
                                                    <span class="ml-2">Kanto</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="generations[]" value="2" class="form-checkbox text-red-500"/>
                                                    <span class="ml-2">Johto</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="generations[]" value="3" class="form-checkbox text-red-500"/>
                                                    <span class="ml-2">Hoenn</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="generations[]" value="4" class="form-checkbox text-red-500" />
                                                    <span class="ml-2">Sinnoh</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="generations[]" value="5" class="form-checkbox text-red-500" />
                                                    <span class="ml-2">Unova</span>
                                                </label>
                                            </div>
                                            <div class="flex flex-col gap-2 mt-0">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="generations[]" value="6" class="form-checkbox text-red-500" />
                                                    <span class="ml-2">Kalos</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="generations[]" value="7" class="form-checkbox text-red-500" />
                                                    <span class="ml-2">Alola</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="generations[]" value="8" class="form-checkbox text-red-500" />
                                                    <span class="ml-2">Galar</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="generations[]" value="9" class="form-checkbox text-red-500" />
                                                    <span class="ml-2">Paldea</span>
                                                </label>
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
                                <div class="flex flex-row gap-8 w-[220px] mt-7">
                                    <div class="flex flex-col gap-2">
                                        <label class="inline-flex items-center">            
                                            <input type="checkbox" name="generations[]" value="1" class="form-checkbox text-red-500" />
                                            <span class="ml-2">Kanto</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="generations[]" value="2" class="form-checkbox text-red-500"/>
                                            <span class="ml-2">Johto</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="generations[]" value="3" class="form-checkbox text-red-500"/>
                                            <span class="ml-2">Hoenn</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="generations[]" value="4" class="form-checkbox text-red-500" />
                                            <span class="ml-2">Sinnoh</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="generations[]" value="5" class="form-checkbox text-red-500" />
                                            <span class="ml-2">Unova</span>
                                        </label>
                                        </div>
                                    <div class="flex flex-col gap-2 mt-0">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="generations[]" value="6" class="form-checkbox text-red-500" />
                                            <span class="ml-2">Kalos</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="generations[]" value="7" class="form-checkbox text-red-500" />
                                            <span class="ml-2">Alola</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="generations[]" value="8" class="form-checkbox text-red-500" />
                                            <span class="ml-2">Galar</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="generations[]" value="9" class="form-checkbox text-red-500" />
                                            <span class="ml-2">Paldea</span>
                                        </label>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>

                            </form>
                            </div>
                            </div>
                            <?php
                            unset($_SESSION["pokedex_data"]);
                            unset($_SESSION["errors_pokedex"]);
                            ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?=printSuccessfullPokedexCreated();?>
            <script>
            var modalDiv = document.getElementById("modal");
            var modalDiv = 0;
            function showModal()
            {
               document.getElementById("modal").style.display = "block"; 
               modalDiv = 1;
            }

            function closeModal()
            {
                document.getElementById("modal").style.display = "none";
                modalDiv = 0;
            }

        </script>
<?php
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
    } else {
        echo '<div class="absolute left-0 w-full mt-1';
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
    } else {
        echo '<div class="absolute left-0 w-full mt-1';
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