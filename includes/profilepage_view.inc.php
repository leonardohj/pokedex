<?php

require_once 'includes/pokedex_view.inc.php';

function profile_page_view()
{
?>
    <div class="absolute top-30 left-10">
    <div class="relative">
        <div class="bg-white pl-5 border rounded-lg border-gray-100 shadow-lg w-full max-w-xs">
        <div>
            <h2 class="text-xl font-bold text-gray-900 tracking-tight"><?=$_SESSION['profileuser_username']?> Dex's<h2>
            <hr class="w-30 mb-2">
        </div>
        <?php
        show_pokedexs();

        if($_SESSION['profileuser_username'] == $_SESSION['user_username'])
        {
        create_pokedex_input();
        }
?>        
       </div> 
    </div>
</div>
<?php
}
?>
