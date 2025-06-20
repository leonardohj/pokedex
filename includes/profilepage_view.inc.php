<?php

require_once 'includes/pokedex_view.inc.php';
require_once 'includes/pokemon_fav_view.inc.php';

function profile_page_view()
{
show_pokedex_content();
                if(isset($_GET['user']) && $_GET['user'] == $_SESSION['profileuser_username'] && !isset($_GET['pokedex']))
                {
                    show_profile_user_content();
                }
}

function show_profile_user_content()
{
    
    ?>
        <main>
        <section class="flex flex-row mt-25 flex justify-center">
            <div class="max-w-68">
                <div class="rounded-full w-fit border-5 <?=$_SESSION["colorRole"][$_SESSION["profileuser_role"]]?> ">
                    <img src="img/user-not-login.png" class="h-64 w-64 rounded full">
                </div>
                <h1 class="text-3xl mt-2 font-extrabold text-gray-900"><?=$_SESSION['profileuser_username']?></h1>
                <p class="text-gray-500 ">@<?=$_SESSION['profileuser_username']?> · he/him</p>
                <p class="text-gray-700 text-lg mt-1">placeholder bue de fixe yh</p>
                <?=insert_favorite_pokemon();?>
                <button class="mt-4 items-center gap-2 border border-gray-300 px-4 py-2 font-semibold rounded-lg text-sm font medium text-gray-700 hover:bg-gray-100 transition w-full">
                    ✏️ Edit profile
                </button>

            </div>
            <div class="flex flex-col justify-start ml-12">
                <div class="flex flex-row border-b border-gray-200 mb-6 h-fit min-w-200">
                    <nav class="ml-4" aria-label="Tabs" role="tablist">
                        <button id="tab-overview" role="tab" aria-selected="true" aria-controls="panel-overview" class="text-red-600 hover:text-red-600 border-b-2 border-red-600 hover:border-red-600 pb-2 px-4 font-semibold focus:outline-none">Overview</button>
                    </nav>
                    <nav class="ml-4" aria-label="Tabs" role="tablist">
                        <button id="tab-pokedexs" role="tab" aria-selected="false" aria-controls="panel-pokedexs" class="text-gray-500 hover:text-red-600 border-b-2 border-red-600 border-transparent hover:border-red-600 px-4 pb-2 font-semibold focus:outline-none">Pokedexs</button>
                    </nav>
                    <nav class="ml-4" aria-label="Tabs" role="tablist">
                        <button id="tab-communities" role="tab" aria-selected="false" aria-controls="panel-communities" class="text-gray-500 hover:text-red-600 border-b-2 border-red-600 border-transparent hover:border-red-600 px-4 pb-2 font-semibold focus:outline-none">Communities</button>
                    </nav>
                </div>
                <div class="flex flex-col">
                <section id="panel-overview" role="tabpanel" tabindex="0" aria-labelledby="tab-overview" class="focus:outline-none">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Most Used Pokédexes</h2>
                    <?php
                    if($_SESSION["howManyPokedexs"][0] != 1)
                    {
                        echo '<div class="grid grid-cols-2 gap-4">';
                    }
                    else
                    {
                        echo '<div class="grid grid-cols-1 gap-4">';
                    }
                    $count = 0;
                    foreach($_SESSION["pokedexs"] as $pokedex)
                    {
                        echo '<a href="user.php?user='. $_SESSION["profileuser_username"]. '&pokedex='. htmlspecialchars($pokedex['name']) .'">';
                        echo '<div class="flex items-center gap-3 bg-gray-50 rounded-lg p-3 shadow hover:bg-gray-100 cursor-pointer transition">';
                        echo '<span class="font-semibold text-gray-700">'. $pokedex['name'] .'</span>';
                        echo '<span class="ml-auto text-xs bg-gray-400 text-white px-2 py-0.5 rounded-full">'. $pokedex['id'] .'</span>';
                        echo '</div>';
                        echo '</a>'; 

                        $count++;

                        if($count >= 4)
                        {
                            break;
                        }
                    }
                    ?>
                    
                    </div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 mt-6">Communities</h2>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg p-3 shadow hover:bg-gray-100 cursor-pointer transition">
                            <span class="font-semibold text-gray-700">{$region}</span>
                        </div>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg p-3 shadow hover:bg-gray-100 cursor-pointer transition">
                            <span class="font-semibold text-gray-700">{$region}</span>
                        </div>
                </div>
                </section>
                <section id="panel-pokedexs" role="tabpanel" tabindex="0" aria-labelledby="tab-pokedexs" hidden>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">All Pokédexes</h2>
                    <?php
                    if($_SESSION["howManyPokedexs"][0] != 1)
                    {
                        echo '<div class="grid grid-cols-2 gap-4">';
                    }
                    else
                    {
                        echo '<div class="grid grid-cols-1 gap-4">';
                    }
                    if(!$_SESSION["howManyPokedexs"][0] < 1)
                    {
                    foreach($_SESSION["pokedexs"] as $pokedex)
                    {
                        echo '<a href="user.php?user='. $_SESSION["profileuser_username"]. '&pokedex='. htmlspecialchars($pokedex['name']) .'">';
                        echo '<div class="flex items-center gap-3 bg-gray-50 rounded-lg p-3 shadow hover:bg-gray-100 cursor-pointer transition">';
                        echo '<span class="font-semibold text-gray-700">'. $pokedex['name'] .'</span>';
                        echo '<span class="ml-auto text-xs bg-gray-400 text-white px-2 py-0.5 rounded-full">'. $pokedex['id'] .'</span>';
                        echo '</div>';
                        echo '</a>';    
                    }
                    }
                    ?>
                    </div>
                    <?=show_pokedexs();?>
                </section>
                <section id="panel-communities" role="tabpanel" tabindex="0" aria-labelledby="tab-communities" hidden>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">All Communities</h2>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg p-3 shadow hover:bg-gray-100 cursor-pointer transition">
                            <span class="font-semibold text-gray-700">{$region}</span>
                        </div>
                        <div class="flex items-center gap-3 bg-gray-50 rounded-lg p-3 shadow hover:bg-gray-100 cursor-pointer transition">
                            <span class="font-semibold text-gray-700">{$region}</span>
                        </div>
                </div>
                </section>                
        </section>
    </main>
<script>
  const tabs = document.querySelectorAll('[role="tab"]');
  const tabPanels = document.querySelectorAll('[role="tabpanel"]');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {

      tabs.forEach(t => {
        t.setAttribute('aria-selected', 'false');
        t.classList.remove('border-red-600', 'text-red-600');
        t.classList.add('border-transparent', 'text-gray-500');
      });

      tabPanels.forEach(panel => panel.hidden = true);

      tab.setAttribute('aria-selected', 'true');
      tab.classList.add('border-red-600', 'text-red-600');
      tab.classList.remove('border-transparent', 'text-gray-500');

      const panelId = tab.getAttribute('aria-controls');
      document.getElementById(panelId).hidden = false;
      document.getElementById(panelId).focus();
    });
  });
</script>

<?php
}
?>