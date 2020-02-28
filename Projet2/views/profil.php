<?php
session_name('ibrahima_philippe') ;
session_start();
//echo $_SESSION['identification'] ;
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/profil.css">
    <title>profil</title>
  </head>
  <body>
    <header>
      <nav>
        <ul>
        <li class="titre">Carbadvisor      </li>
                <li> <a href="../index.php">Accueil</a> </li>
                <li> <a href="recherche.php">Station</a> </li>
                <li> <a href="pagePost.php">Mes posts</a> </li>
                <li> <a href="#">Mon profil</a> </li>
                <li> <a href="#">A propos</a> </li>
                <li> <a href="#">Contact</a> </li>
          <li class="droite"> <a href="#"> <img src="../images/avatar.png" alt="avatar" height="30" width="30"> </a> </li>
          <li class="droite"> <a href="../services/logout.php"> logout </a> </li>
        </ul>
      </nav>

    </header>
    <?php
    echo '<h2 align="center">Bienvenue '.$_SESSION['identification']."</h2>" ;
    ?>

    <div id="profil">
      <span id ="accueil"> <a href="#">Accueil  </a> </span> <span id="informations"> <a href="infos.php">Information personnel</a>  </span>
    </div>
     <br>

    <div>
    <form>
  <div>
    <h1>Modifier mon profil :</h1>
    <label>
      <span>ville</span><input id="name" type="text" name="name" />
    </label>

    <label>
      <span>Email </span><input id="email" type="email" name="email" />
    </label>

    <label>
      <span>mot de passe</span><input id="password" type="password" name="password" />
    </label>

    <label>
      <span>Photo Profil</span><input id="image" type="file" name="image" />
    </label>
    <label>
      <span>description</span><textarea id="feedback" name="feedback"></textarea>
      <input type="button" value="Submit Form" />
    </label>

  </div>
</form>

    </div>



  </body>
</html>
