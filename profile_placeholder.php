<?php
function insert_favorite_pokemon()
{
    $pokemonNames = array_map(fn($p) => htmlspecialchars($p['name']), $_SESSION["ALLpokemons"]);
    $jsonPokemonList = json_encode($pokemonNames);
    ?>
    <button onclick="showModalFavPokemon()" class="mt-4 items-center gap-2 border border-red-100 bg-red-100 px-4 py-2 font-semibold rounded-lg text-sm font-medium text-gray-700 hover:bg-red-200 transition w-full">
        + Add Your Favorite Pokémon!
    </button>

<div class="modalFavPokemon" id="modalFavPokemon" style="display: none;">
    <div style="background-color: rgba(0,0,0,0.4);" class="fixed inset-0 z-[1000] flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl flex flex-col w-full max-w-2xl p-6 relative overflow-hidden">

            <!-- Close Button -->
            <button type="button" onclick="closeModalFavPokemon()" class="absolute top-4 left-4 z-50">
                <img src="img/close.webp" alt="Close" class="h-6 w-6 hover:scale-110 transition">
            </button>

            <!-- Header -->
            <div class="flex flex-col justify-center text-center items-center mt-2">
                <img src="img\pokemonFooterGen1.png" class="h-12 mr-2">
                <h1 class="text-xl font-bold text-gray-800 mt-[-30px]"><br>Favorite Pokémon</h1>
            </div>
            <h3 class="text-red-500 font-bold text-sm text-center mt-1 mb-3">Which pokemon is your favorite!?</h3>

            <!-- Form -->
            <form method="POST" action="save_favorite.php" autocomplete="off" class="space-y-5 px-4">
                <!-- Search -->
                <div class="relative">
                    <label for="searchPokemon" class="block mb-2 text-sm font-semibold text-gray-700">Search Pokémon:</label>
                    <input type="text" id="searchPokemon" name="pokemon" placeholder="Type to search..."
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 transition" />
                    <ul id="dropdownList"
                        class="absolute left-0 right-0 mt-1 z-[9999] bg-white border border-gray-300 rounded-lg shadow max-h-40 overflow-y-auto text-sm hidden"></ul>
                </div>

                <!-- Background Type -->
                <div>
                    <label for="background-image" class="block mb-2 text-sm font-semibold text-gray-700">Background Type:</label>
                    <select name="background-image" id="background-image"
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 transition">
                        <?php
                        $types = [
                            "Normal","Fire","Fighting","Water","Flying","Grass","Poison","Eletric","Ground",
                            "Psychic","Rock","Ice","Bug","Dragon","Ghost","Dark","Steel","Fairy","Stellar"
                        ];
                        foreach($types as $type) {
                            echo '<option value="'.$type.'">'.$type.'</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- Preview Label Only -->

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-red-500 text-white font-semibold py-2 rounded-lg hover:bg-red-600 transition">
                    Save
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function showModalFavPokemon() {
        document.getElementById("modalFavPokemon").style.display = "block";
    }

    function closeModalFavPokemon() {
        document.getElementById("modalFavPokemon").style.display = "none";
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
            li.className = "px-3 py-2 cursor-pointer hover:bg-red-100";
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
