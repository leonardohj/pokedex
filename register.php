<?php
    require_once 'includes/register_view.inc.php';
    require_once 'includes/config_session.inc.php';

    if(isset($_SESSION["user_id"]))
    {
      header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
    <style>
    p, label {
      font-family: "Arial Black", Arial, sans-serif;
    }
    body {
      background: url('./img/backgroundRegister.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    .text-outline {
      text-shadow: 1px 1px 2px white, -1px -1px 2px white;
    }
  </style>
</head>
<body class="m-0 h-screen flex flex-col relative">
  <header class="relative">
    <div class="absolute top-9 right-8">
      <a href="login.php" class="bg-neutral-900 text-neutral-200 px-5 py-2 rounded hover:bg-neutral-800">Login</a>
    </div>
    <div class="flex flex-col items-center mb-[2%]">
      <img src="./img/pokedex3Dlogo.png" class="h-20" alt="Pokedex Logo">
      <p class="rainbow-text text-outline">A pokedex tracker website</p>
    </div>
    <?php
    
    printSucessfullRegister();

    ?>
  </header>

  <main class="flex justify-center">
    <div class="bg-neutral-900 border border-gray-600 rounded-lg px-6 py-7 max-w-md mb-[2%]">
        <?php
        register_input();
        ?>
    </div>
  </main>
    
  <?php
  include('footer.php');
  ?>

  
  
</body>
</html>