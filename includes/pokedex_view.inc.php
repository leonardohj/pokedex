<?php
function show_pokedexs()
{

    if (!empty($_SESSION["pokedexs"])) {
        ?>
        <?php
        foreach($_SESSION["pokedexs"] as $pokedex) 
        {
            echo '<div class="transition hover:scale-[1.03] hover:bg-red-100 rounded-lg">';
            echo '<a href="#" class="block w-full px-4 py-2 text-gray-800 font-semibold rounded-lg hover:text-red-600 transition">' . htmlspecialchars($pokedex['name']) . '</a>';
            echo '</div>';
        }
        ?>
        <?php
    }
}

function create_pokedex_input()
{
    ?>

        
        <button onclick="showModal()" id="showModalButton" class="border border-red-500 bg-red-500 text-white text-bold rounded-lg p-1">New DEX</button>
        <div class="modal" id="modal">
            <script>
                document.getElementById("modal").style.display = "none";
            </script>
            <div style="background-color: rgba(0,0,0,0.4);"  class="modal-behind-background fixed inset-0 w-screen h-screen flex justify-center">
                <div>
                    <div class="modal-background relative bg-white rounded-xl shadow-lg flex flex-col items-center justify-center  top-[12.5%] min-w-100">
                        <div class="close-modal-div absolute top-2 left-2 flex flex-row">
                        <button onclick="closeModal()">
                            <img src="img\close.webp" class="h-7 cursor-pointer">
                        </button>
                        </div>
                        <div class="modal-background bg-white items-center justify-center p-8 min-w-[320px] max-w-xs">
                            <div class="flex flex-row justify-center text-center items-center">
                                <img src="img\pokedexKantoIMG.webp" class="h-9 relative top-[-8px]"><h1 class="text-2xl font-bold mb-4 text-center ml-1">New Pokedex</h1>
                            </div>
                            <div class="relative mt-[-10px] mb-[5%]">
                            <h3 class="text-red-500 font-bold flex text-sm justify-center text-center items-center">Create an new pokedex here!</h3>
                            </div>
                            <form action="includes/pokedex.inc.php" method="POST" class="w-full flex flex-col gap-3">
                                <div class="mb-[-10px]">
                                <label for="pokedexName" class="text-sm font-medium text-gray-700">Name</label>
                                </div>
                                <?php
                                if(isset($_SESSION["pokedex_data"]["pokedexName"]))
                                {
                                ?>
                                <script> document.getElementById("modal").style.display = "block" </script>
                                <?php

                                $hasErrors = isset($_SESSION["errors_pokedex"]);
                                $borderColor = $hasErrors ? "border-red-500" : "border-green-500";

                                
                                echo '<input type="text" name="pokedexName" placeholder="Name here" class="border '. $borderColor .' rounded-lg px-3 py-2 " >';
                                
                                if($hasErrors)
                                {
                                    check_pokedexName_errors();
                                }
                                
                                }
                                else
                                {
                                    echo '<input type="text" name="pokedexName" placeholder="Name here" class="border border-gray-300 rounded-lg px-3 py-2 " >';
                                }
                                ?>
                                
                                <button class="mt-4 border border-red-500 bg-red-500 text-white font-bold rounded-lg py-2 transition hover:bg-red-600">Create</button>
                            </form>
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

        if (isset($errors["emptyInput"])) {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold mt-[73px] break-normal">
                {$errors["emptyInput"]}
            </div>
            HTML;
        } 
        else if(isset($errors["usedPokedexName"]))
        {
            echo <<<HTML
            <div class="absolute w-full text-red-500 text-sm font-bold mt-[73px] break-normal">
                {$errors["usedPokedexName"]}
            </div>
            HTML;
        } else {
            echo '<div class="absolute left-0 w-full mt-1';
        }
    } else {
        echo '<div class="absolute left-0 w-full mt-1';
    }
    
    unset($_SESSION["pokedex_data"]);
    unset($_SESSION["errors_pokedex"]);

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