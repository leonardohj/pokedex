<title>Pokedex - HomePage</title>

<?php
    require_once 'includes\roll_view.inc.php';
    require_once 'includes/config_session.inc.php';
    include('header.php');

if(!isset($_SESSION["user_id"]))
{
    header("Location: login.php");
}
?>

<?php

printSucessfullRole();

?>
<main class="flex flex-col justify-center items-center text-center gap-4 font-mono text-lg h-full">
    <h1 class="text-2xl mt-4">
        Hai, welcome to the Pokedex WebSite!
    </h1>
    <h2 class="text-xl mt-2">
        This site was made to... you know... see pokemons!
    </h2>
    <h3 class="text-lg mt-2">
        Hope ya like it bbg😉
    </h3>
    <div class="mt-4">
        <img src="img/SnorlaxHomePage.gif" alt="Snorlax" class="mx-auto">
    </div>
    <div>
    <?php
    
    roll_input();

    ?>
    
</main>
<?php
include('footer.php');
?>