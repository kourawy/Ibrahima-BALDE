<?php
// auteur: Ibrahima BALDE
session_name('ibrahima_philippe') ;
session_start();
$personne = $_SESSION['identification'] ;
//echo $_SESSION['identification'] ;
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/menu.css">
    <script src="../js/fetchUtils.js"></script>
    <script src="../js/pagePost.js"></script>
    <script src="../js/deletePost.js"></script>
    <title>mes posts</title>
    <style media="screen">
      .myposts{
        width: 60%;
        -moz-box-shadow:    inset 0 0 5px #000000;
        -webkit-box-shadow: inset 0 0 5px #000000;
          box-shadow:         inset 0 0 5px #000000;
          padding: 5px;
          margin-bottom: 3px;

      }

      #myPosts{
        margin-left: 100px;
      }

      #datesearch{
        text-align: right;
        text-shadow: inset 0 0 2px #000000;
      }
    </style>
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li class="titre">Carbadvisor      </li>
          <li> <a href="../index.php">Accueil</a> </li>
          <li> <a href="recherche.php">Station</a> </li>
          <li> <a href="#">Mes posts</a> </li>
          <li> <a href="profil.php">Mon profil</a> </li>
          <li> <a href="#">A propos</a> </li>
          <li> <a href="#">Contact</a> </li>
          <li class="droite"> <a href="#"> <img src="images/avatar.png" alt="avatar" height="30" width="30"> </a> </li>
          <li class="droite"> <a href="../services/logout.php"> logout </a> </li>
        </ul>
      </nav>

    </header>
    <h2>Mes posts</h2>

    <?php
    echo '<div id="myPosts">'.$personne.'</div>';
    ?>

    <div class="apres">
      <script type="text/javascript">
        myPseudo = document.getElementById('myPosts') ;

        var closeButton = document.getElementsByClassName('myPosts');
        //var lien = closeButton ;
        //closeButton[0][2].addEventListener("click",posts);
        var tableau = Array.from(closeButton) ;
        console.log(tableau);
        //console.log(myPseudo);
      </script>

    </div>

  </body>
</html>
