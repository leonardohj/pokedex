<?php

require_once 'includes/pokedex_view.inc.php';

function profile_page_view()
{
?>
<div class="flex flex-row gap-8 mt-35 mb-24">
        <div class="ml-5 bg-white w-fit py-12 px-12 pr-25 border border-gray-200 rounded-lg shadow-lg w-[30%]">
            <h2 class="text-xl font-bold pb-4 border border-b-gray-500 border-r-0 border-l-0 border-t-0"><?=$_SESSION['profileuser_username']?> Dex's</h2>
            <ul class="space-y-2">
                <?php
                
                show_pokedexs();

            ?>
            </ul>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg shadow-lg flex flex-col px-10 py-10 w-[70%] max-w-[70%] ">
            <?php
                show_pokedex_content();
            ?>
        </div>
    </div>
<?php
}
?>
