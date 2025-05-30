<?php
    require_once 'includes/login_view.inc.php';
    require_once 'includes/config_session.inc.php';

    if(!isset($_SESSION["user_id"]))
    {
        header("Location: login.php");
    }


?>
<style>
    body {
        margin: 0px;
        padding: 0px;
    }
    .submenu.open-menu{
        max-height:400px;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="m-0 h-screen flex flex-col">
<header class="flex justify-center items-center flex-nowrap">
    <div class="absolute top-5 border border-gray-300 bg-white shadow-lg py-3 rounded-lg px-4 flex-nowrap flex items-center gap-4">
        <a href="index.php"><img src="img\pokedex3Dlogo.png" class="h-8 flex-shrink-0"></a>
        <a href="">Main Page</a>
        <a href="">Games</a>
        <?php
        if($_SESSION["user_role"] != "peasent")
        {
          echo '<a class="border-2 border-l-0 border-t-0 border-b-0 pr-4 border-r-gray-500" href="">Forum</a>';
          
        }
        else
        {
          echo '<a href="">Forum</a>';
        }

      if($_SESSION["user_role"] == "support" || $_SESSION["user_role"] == "admin")
      {
        echo '<a href="support.php">Support Options</a>';
      }
    ?>
    </div>
    <div class="absolute top-6 right-12">
        <a href="#" id="profile-btn" onclick="toggleMenu(event)" class="flex items-center justify-center">
            <img class="h-12 px-[0.58rem] transition-all duration-150 group-hover:border group-hover:border-gray-400 group-hover:rounded-full group-hover:bg-gray-100" src="img\user-not-login.webp" alt="">
        </a>
        <div id="subMenu" class="sub-menu flex flex-col text-center absolute left-1/2 top-18 transform -translate-x-1/2 rounded-full border border-gray-300 bg-black bg-cover bg-center w-37 h-37 items-center justify-center"
             style="background-image: url('img/pokebola.png'); display: none;">
            <a class="my-2 mb-[14px] hover:font-bold" href="user.php?user=<?=$_SESSION["user_username"]?>"><?=$_SESSION["user_username"]?></a>
            <a class="my-2 text-white flex flex-row hover:font-bold" href="">conㅤ<img class="h-7" src="img/cog.png">ㅤfigs</a>
            
            <form action="includes/logout.inc.php" method="POST"><a class="my-2 flex flex-row hover:font-bold" href=""><img src="img/logout.png" class="h-3 relative top-[7px] pr-[2px]"><button>logout</button></a></form>
        </div>
    </div>
</header>
</body>
<script>
  var userDiv = document.getElementById("subMenu");
  var profileBtn = document.getElementById("profile-btn");

  userDiv.style.display = "none";

  function toggleMenu(e) {
    e.preventDefault();
    if (userDiv.style.display === "flex") {
      userDiv.style.display = "none";
    } else {
      userDiv.style.display = "flex";
    }
  }

  document.addEventListener('click', function(e) {
    if (!userDiv.contains(e.target) && !profileBtn.contains(e.target)) {
      userDiv.style.display = "none";
    }
  });
</script>
</html>