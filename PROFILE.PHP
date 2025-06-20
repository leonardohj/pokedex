Got it! You want the **Pokédexs**, **Communities**, and **Recent Activity** sections to appear as tabs or sections *above* the main content area (above your current “My Pokédexes” box), not as a fixed navbar on top of the whole page.

Here’s the updated full code where these three are grouped as tabs (or clickable sections) on top inside the main content area, and clicking each shows the corresponding content below them — all **inside the main info panel**, above your current Pokédex content.

---

```php
<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/role_view.inc.php';
require_once 'includes/pokemon_view.inc.php';

include('header.php');
?>

<!-- Sidebar Trigger -->
<div class="fixed top-8 left-8 z-40">
    <button id="sidebarTrigger" aria-label="Open Sidebar">
        <img src="img/user-not-login.png" alt="User Icon" class="h-16 w-16 rounded-full border-4 border-red-400 shadow-lg object-cover cursor-pointer transition-transform hover:scale-105">
    </button>
</div>

<!-- Sidebar Backdrop -->
<div id="profileSidebarBackdrop" class="fixed inset-0 bg-black bg-opacity-30 z-40 hidden"></div>

<!-- Sidebar -->
<div id="profileSidebar" class="fixed top-0 left-0 h-full w-72 bg-gradient-to-b from-white to-red-50 border-r border-red-100 shadow-lg transform -translate-x-full transition-transform duration-300 z-50 flex flex-col items-center py-8">
    <button id="closeSidebarBtn" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-2xl font-bold focus:outline-none" aria-label="Close Sidebar">&times;</button>
    
    <a href="#" class="flex flex-col items-center mb-8 group">
        <div class="relative">
            <img src="img/user-not-login.png" alt="Profile Picture" class="h-20 w-20 rounded-full border-4 border-red-400 shadow-lg object-cover mb-2 transition-transform group-hover:scale-105">
            <span class="absolute bottom-1 right-1 bg-white rounded-full p-1 shadow border border-red-200">
                <svg class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle cx="12" cy="12" r="10" stroke-width="2" fill="none"/>
                    <path d="M8 12l2 2 4-4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
        </div>
        <span class="text-lg font-bold text-gray-800 group-hover:text-red-500 transition">RedTheLegend</span>
        <span class="text-xs text-gray-500 mt-1 bg-red-100 px-2 py-0.5 rounded-full">Pokémon Master</span>
    </a>

    <div class="w-full px-4">
        <h2 class="text-lg font-bold text-red-600 mb-4 text-center uppercase tracking-wide">Pokédexs</h2>
        <ul class="space-y-2">
            <?php
            $regions = [
                ['Kanto', 151, 'red'],
                ['Johto', 100, 'yellow'],
                ['Hoenn', 135, 'green'],
                ['Sinnoh', 107, 'blue'],
                ['Galar', 89, 'purple']
            ];
            foreach ($regions as [$region, $count, $color]) {
                echo <<<HTML
                <li>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg bg-white shadow hover:bg-{$color}-50 transition font-semibold text-gray-700">
                        <img src="img/pokeball_placeholder.png" alt="{$region} Pokéball" class="h-6 w-6"> {$region}
                        <span class="ml-auto text-xs bg-{$color}-100 text-{$color}-600 px-2 py-0.5 rounded-full">{$count}</span>
                    </a>
                </li>
HTML;
            }
            ?>
        </ul>
    </div>

    <div class="mt-auto w-full px-4 pb-6">
        <button class="w-full py-2 rounded-lg bg-red-500 text-white font-bold shadow hover:bg-red-600 transition flex items-center justify-center gap-2">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round"/></svg>
            New Pokédex
        </button>
    </div>
</div>
<!-- Main Section -->
<section class="bg-white py-30">
  <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row gap-10">

    <!-- Avatar + Info -->
    <div class="flex-shrink-0 w-full md:w-72 flex flex-col items-center md:items-start space-y-4">
      <!-- Avatar -->
      <div class="relative flex items-center justify-center">
        <span class="absolute inset-0 flex items-center justify-center">
          <span class="block h-64 w-64 rounded-full border-4 border-red-400"></span>
        </span>
        <img src="img/user-not-login.png"
             alt="User Avatar"
             class="h-64 w-64 rounded-full object-cover border-4 border-transparent relative z-10" 
             style="aspect-ratio: 1/1;">
      </div>

      <!-- Info -->
      <div class="text-center md:text-left space-y-2">
        <h1 class="text-3xl font-extrabold text-gray-900 flex items-center justify-center md:justify-start gap-2">
          Leonardo <span class="text-xl">👾</span>
        </h1>
        <p class="text-gray-500">@leonardohj · he/him</p>
        <p class="text-gray-700 italic">
          <span class="text-lg">💬</span> Curto mandar umas boas chapadas de código — 
          <span class="text-red-500 font-semibold">“ChatGPT” 2025</span>
        </p>
        <span class="inline-block text-sm text-gray-500 bg-red-100 px-3 py-1 rounded-full font-medium tracking-wide">🔥 Pokémon Master</span>

        <button class="mt-4 inline-flex items-center gap-2 border border-gray-300 px-4 py-2 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
          ✏️ Edit Profile
        </button>
      </div>
    </div>

    <!-- Info + Tabs -->
    <div class="flex-1 space-y-8">

      <!-- Tabs -->
      <div class="border-b border-gray-200 mb-6">
        <nav class="flex space-x-8" aria-label="Tabs" role="tablist">
          <button id="tab-overview" role="tab" aria-selected="true" aria-controls="panel-overview"
            class="text-red-600 border-b-2 border-red-600 pb-2 font-semibold focus:outline-none">
            Overview
          </button>
          <button id="tab-pokedexs" role="tab" aria-selected="false" aria-controls="panel-pokedexs"
            class="text-gray-500 hover:text-red-600 border-b-2 border-transparent hover:border-red-600 pb-2 font-semibold focus:outline-none">
            Pokédexs
          </button>
          <button id="tab-communities" role="tab" aria-selected="false" aria-controls="panel-communities"
            class="text-gray-500 hover:text-red-600 border-b-2 border-transparent hover:border-red-600 pb-2 font-semibold focus:outline-none">
            Communities
          </button>
        </nav>
      </div>

      <!-- Tab Panels -->
      <div>
<section id="panel-overview" role="tabpanel" tabindex="0" aria-labelledby="tab-overview">
  <div class="space-y-6">

    <!-- Pokédex Highlights (2x2 grid) -->
    <div>
      <h2 class="text-lg font-semibold text-gray-800 mb-4">📚 Pokédex Highlights</h2>
      <div class="grid grid-cols-2 gap-4">
        <?php
        $big_regions = [
          ['Kanto', 151, 'red'],
          ['Johto', 100, 'yellow'],
          ['Hoenn', 135, 'green'],
          ['Sinnoh', 107, 'blue'],
        ];
        foreach ($big_regions as [$region, $count, $color]) {
          echo <<<HTML
          <div class="flex items-center gap-3 bg-gray-50 rounded-lg p-3 shadow hover:bg-{$color}-50 cursor-pointer transition">
            <img src="img/pokeball_placeholder.png" alt="{$region} Pokéball" class="h-8 w-8">
            <span class="font-semibold text-gray-700">{$region}</span>
            <span class="ml-auto text-xs bg-{$color}-100 text-{$color}-600 px-2 py-0.5 rounded-full">{$count}</span>
          </div>
          HTML;
        }
        ?>
      </div>
    </div>

    <!-- Communities (horizontal row) -->
    <div>
      <h2 class="text-lg font-semibold text-gray-800 mb-4">🌐 Communities</h2>
      <div class="flex gap-4">
        <span class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full shadow cursor-pointer hover:bg-gray-200 transition">CP COMMUNITY</span>
        <span class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full shadow cursor-pointer hover:bg-gray-200 transition">PokéCoders</span>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">🕹️ Recent Activity</h2>
      <ul class="space-y-2 text-gray-700">
        <li>✅ Caught a <strong>Bulbasaur</strong> in Kanto Pokédex</li>
        <li>🏆 Completed the <strong>Johto Pokédex</strong></li>
        <li>🤝 Became friends with <strong>Misty</strong></li>
      </ul>
    </div>

  </div>
</section>


 <!-- Pokédexs panel -->
<section id="panel-pokedexs" role="tabpanel" tabindex="0" aria-labelledby="tab-pokedexs" hidden>
  <div class="bg-gray-50 rounded-xl p-5 shadow-sm">
    <h2 class="text-lg font-semibold text-gray-800 mb-3">📚 My Pokédexes</h2>
    <div class="flex flex-col gap-3">
      <?php
      $all_regions = [
        ['Kanto', 151, 'red'],
        ['Johto', 100, 'yellow'],
        ['Hoenn', 135, 'green'],
        ['Sinnoh', 107, 'blue'],
        ['Galar', 89, 'purple'],
      ];
      foreach ($all_regions as [$region, $count, $color]) {
        echo <<<HTML
        <div class="flex items-center gap-3 bg-white rounded-lg px-4 py-3 shadow cursor-pointer hover:bg-{$color}-50 transition">
          <img src="img/pokeball_placeholder.png" alt="{$region} Pokéball" class="h-8 w-8">
          <span class="font-semibold text-gray-700">{$region}</span>
          <span class="ml-auto text-xs bg-{$color}-100 text-{$color}-600 px-2 py-0.5 rounded-full">{$count}</span>
        </div>
        HTML;
      }
      ?>
    </div>
  </div>
</section>

<!-- Communities panel -->
<section id="panel-communities" role="tabpanel" tabindex="0" aria-labelledby="tab-communities" hidden>
  <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
    <h2 class="text-lg font-semibold text-gray-800 mb-3">🌐 Communities</h2>
    <div class="flex flex-col gap-3">
      <?php
      $communities = ['CP COMMUNITY', 'PokéCoders', 'Lisbon Trainers', 'Elite Four', 'Mystic Trainers'];
      foreach ($communities as $community) {
        echo <<<HTML
        <div class="bg-gray-100 text-gray-700 px-4 py-3 rounded-lg shadow cursor-pointer hover:bg-gray-200 transition">
          {$community}
        </div>
        HTML;
      }
      ?>
    </div>
  </div>
</section>

<script>
  // Tabs functionality
  const tabs = document.querySelectorAll('[role="tab"]');
  const tabPanels = document.querySelectorAll('[role="tabpanel"]');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      // Set all tabs to unselected
      tabs.forEach(t => {
        t.setAttribute('aria-selected', 'false');
        t.classList.remove('border-red-600', 'text-red-600');
        t.classList.add('border-transparent', 'text-gray-500');
      });

      // Hide all panels
      tabPanels.forEach(panel => panel.hidden = true);

      // Set clicked tab as selected
      tab.setAttribute('aria-selected', 'true');
      tab.classList.add('border-red-600', 'text-red-600');
      tab.classList.remove('border-transparent', 'text-gray-500');

      // Show related panel
      const panelId = tab.getAttribute('aria-controls');
      document.getElementById(panelId).hidden = false;
      document.getElementById(panelId).focus();
    });
  });
</script>