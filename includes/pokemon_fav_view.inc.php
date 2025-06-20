<?php
function insert_favorite_pokemon()
{
    $pokemonNames = array_map(fn($p) => htmlspecialchars($p['name']), $_SESSION["ALLpokemons"]);
    $jsonPokemonList = json_encode($pokemonNames);
?>
    <button onclick="showModalFavPokemon()" class="mt-4 w-full px-4 py-2 text-sm font-semibold text-gray-700 bg-red-100 border border-red-200 rounded-lg hover:bg-red-200 transition">
        + Add Your Favorite Pokémon!
    </button>

    <div id="modalFavPokemon" class="fixed inset-0 z-[1000] hidden items-center justify-center bg-black/40">
        <div class="bg-white w-full max-w-3xl rounded-2xl shadow-xl p-8 relative">

            <button onclick="closeModalFavPokemon()" class="absolute top-5 left-5">
                <img src="img/close.webp" alt="Close" class="w-6 h-6 hover:scale-110 transition" />
            </button>

            <div class="flex flex-col items-center text-center">
                <img src="img/pokemonFooterGen1.png" class="h-12 mb-2" />
                <h1 class="text-2xl font-bold text-gray-800">Favorite Pokémon</h1>
                <p class="text-red-500 text-sm font-medium mt-1">Which Pokémon is your favorite?</p>
            </div>

            <div class="mt-8 flex flex-col md:flex-row gap-6">
<div class="flex flex-1 flex-col md:flex-row gap-8 items-start">

    <div class="flex-1 flex justify-center">
    <form id="favPokemonForm" method="POST" action="save_favorite.php" autocomplete="off" class="w-full max-w-md space-y-6">
        <div class="relative">
            <label for="searchPokemon" class="block text-sm font-semibold text-gray-800 mb-2">Find Your Favorite Pokémon</label>
            <input 
                type="text" 
                id="searchPokemon" 
                name="pokemon" 
                placeholder="Start typing a Pokémon name..." 
                class="w-full px-4 py-3 text-base border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400 transition"
            />
            <ul id="dropdownList"
                class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-44 overflow-y-auto text-sm hidden"></ul>
        </div>

        <div>
            <label for="background-image" class="block text-sm font-semibold text-gray-800 mb-2">Choose Background Type</label>
            <select 
                name="background-image" 
                id="background-image" 
                class="w-full px-4 py-3 text-base border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-400 transition"
            >
                <?php
                $types = ["Normal", "Fire", "Fighting", "Water", "Flying", "Grass", "Poison", "Eletric", "Ground", "Psychic", "Rock", "Ice", "Bug", "Dragon", "Ghost", "Dark", "Steel", "Fairy", "Stellar"];
                foreach ($types as $type) {
                    echo "<option value=\"$type\">$type</option>";
                }
                ?>
            </select>
        </div>
    </form>
</div>
</div>


                <div class="w-full md:w-1/3 flex items-center justify-center border-l border-gray-200 pl-4">
                    <div id="previewBox" class="bg-red-500 text-white text-center font-bold text-lg uppercase px-18 py-32 rounded-xl shadow">
                        Preview
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <button type="submit" form="favPokemonForm"
                    class="w-full py-3 bg-red-500 text-white text-sm font-semibold rounded-lg hover:bg-red-600 transition">
                    Save
                </button>
            </div>
        </div>
    </div>

    <script>
        function showModalFavPokemon() {
            document.getElementById("modalFavPokemon").classList.remove("hidden");
            document.getElementById("modalFavPokemon").classList.add("flex");
        }

        function closeModalFavPokemon() {
            document.getElementById("modalFavPokemon").classList.add("hidden");
        }

        const pokemonList = <?php echo $jsonPokemonList; ?>;
        const input = document.getElementById("searchPokemon");
        const dropdown = document.getElementById("dropdownList");

        input.addEventListener("input", () => {
            const query = input.value.toLowerCase();
            dropdown.innerHTML = "";

            if (!query) {
                dropdown.classList.add("hidden");
                return;
            }

            const matches = pokemonList.filter(name => name.toLowerCase().includes(query)).slice(0, 10);
            if (matches.length === 0) {
                dropdown.classList.add("hidden");
                return;
            }

            matches.forEach(name => {
                const li = document.createElement("li");
                li.textContent = name;
                li.className = "px-3 py-2 cursor-pointer hover:bg-gray-100";
                li.onclick = () => {
                    input.value = name;
                    dropdown.classList.add("hidden");
                };
                dropdown.appendChild(li);
            });

            dropdown.classList.remove("hidden");
        });

        document.addEventListener("click", (e) => {
            if (!input.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add("hidden");
            }
        });
    </script>
<?php
}
?>
