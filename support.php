<?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/role_view.inc.php';
    require_once 'includes/pokemon_view.inc.php';
    
    include('header.php');
    ?>
    
    <div class="flex flex-row gap-8 mt-35 mb-24">
        <div class="bg-white w-fit py-12 px-12 pr-25 border border-gray-200 rounded-lg shadow-lg w-[30%]">
            <h2 class="text-xl font-bold pb-4 border border-b-gray-500 border-r-0 border-l-0 border-t-0">Support Menu</h2>
            <ul class="space-y-2">
                <li>
                    <a href="#" class="block px-4 mt-1 py-2 rounded hover:bg-gray-100 text-gray-800 font-medium">FAQ</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-800 font-medium">Contact Support</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-800 font-medium">Report a Bug</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-800 font-medium">Feature Request</a>
                </li>
            </ul>
            <?php
            if($_SESSION["user_role"] == "admin")
            {
            ?>
            <h2 class="text-xl font-bold pb-4 border border-b-gray-500 border-r-0 border-l-0 border-t-0 mt-4">Admin Menu</h2>
            
            <ul class="space-y-2">
                <li>
                    <a href="#role" class="block px-4 mt-1 py-2 rounded hover:bg-gray-100 text-gray-800 font-medium">Give roles</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-800 font-medium">Insert pokemons</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-800 font-medium">Logs</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-800 font-medium">placeholder</a>
                </li>
            </ul>
                <?php    
                }
                ?>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg shadow-lg flex flex-col px-10 py-10 w-[70%]">
            <?php
            role_input();            
            pokemon_input();
            ?>
        </div>
    </div>
    <?php
    include('footer.php');
?>