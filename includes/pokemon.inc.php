<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $pokemonName = $_POST["pokemonName"];
    $generation = $_POST["generation"];
    $image = $_POST["image"];
    $pokedexEntry = $_POST["pokedexEntry"];
    $type1 = $_POST["pokemontype1"];
    $type2 = $_POST["pokemontype2"] == '' ? 'None' : $_POST["pokemontype2"];

    try {
        require_once 'dbh.inc.php';
        require_once "pokemon_model.inc.php";
        require_once "pokemon_view.inc.php";
        require_once "pokemon_contr.inc.php";
        require_once "config_session.inc.php";

        $errors = [];

        if (isInputEmpty($pokemonName)) {
            $errors["emptyName"] = "Fill in all fields!";
        }
        if (isInputEmpty($type1)) {
            $errors["emptyType1"] = "Type one cant be empty!";
        }
        if (AreTypesTheSame($type1, $type2)) {
            $errors["duplicateType"] = "Duplicate types!";
        }
        if (isInputEmpty($generation)) {
            $errors["emptyGen"] = "Fill in all fields!";
        }
        if (isInputEmpty($image)) {
            $errors["emptyImage"] = "Fill in all fields!";
        }
        if (isInputEmpty($pokedexEntry)) {
            $errors["emptyPokedexEntry"] = "Fill in all fields!";
        }
        if (doesPokemonAlreadyExist($pokemonName, $pdo)) {
            $errors["duplicatePokemon"] = htmlspecialchars($pokemonName) . "is already registered!";
        }
        if(isImageInputNotAnLink($image))
        {
            $errors["imageNotLink"] = "This site only supports link images!";
        }

        if ($errors) {
            $_SESSION["errors_pokemon"] = $errors;
            $_SESSION["pokemon_data"] = [
                "pokemonName" => $pokemonName,
                "generation" => $generation,
                "image" => $image,
                "pokedexEntry" => $pokedexEntry,
                "type1" => $type1,
                "type2" => $type2
            ];
            header("Location: ../support.php");
            die();
        }

        create_pokemon($pokemonName, $generation, $image, $pokedexEntry, $type1, $type2, $pdo);

        $_SESSION["pokemonsPokedex"] = update_fetchAllPokemons($pdo);

        header("Location: ../support.php?pokemonCreated=success");

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}