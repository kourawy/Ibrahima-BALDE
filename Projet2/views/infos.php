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
    <link rel="stylesheet" href="../css/profil.css">
    <script src="../js/fetchUtils.js"></script>
    <script src="../js/infos.js"></script>
    <title>profil</title>
    <style>
.tableau {
  width:70%;
  table-layout: fixed;
  border-collapse: collapse;
  margin-left: 100px;
}
.tableau caption {
  font-size:1.4rem;
  color:#ffffff;
  background-color: #5d625c;
 /* caption-side: bottom; // top|bottom|initial|inherit; */
}
.tableau th {
  background-color:#999690;
  color:#fff;
}
.tableau tfoot td {
  color:#fff;
  background-color:#999690;
  border-top:1px solid #5d625c;
  border-bottom:1px solid #5d625c;
}
.zebre tbody tr:nth-child(odd) {
  background-color: #d6d3ce;
  border-bottom:1px solid #ccc;
  color:#444;
}
.zebre tbody tr:nth-child(even) {
  background-color: #c6c3bd;
  border-bottom:1px solid #ccc;
  color:#444;
}
.zebre tbody tr:hover:nth-child(odd) {
  background-color: #999690;
  color:#ffffff;
}
.zebre tbody tr:hover:nth-child(even) {
  background-color: #999690;
  color:#ffffff;
}

/* La couleur ne fonctionne pas avec odd / even */
.tableau col:nth-child(1) {
  background-color:#d6d3ce;
}
.tableau col:nth-child(2) {
  background-color:#dddad4;width:auto;text-align: justify;
}
/*
.tableau col:nth-child(3) {
  background-color:#c6c3bd;color:#fff;width:100px;text-align:right;
}
*/

.tableau td:nth-child(2) {
  text-align:center;
}
/*
.tableau td:nth-child(3) {
  text-align:right;
}
*/
</style>
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
    <br>


    <div id="profil">
      <span id ="accueil"> <a href="profil.php">Accueil  </a> </span> <span id="informations"> <a href="#">Information personnel</a>  </span>
    </div>
     <br>
    <?php
    echo '<div id="mesInfos">'.$personne.'</div>';
    ?>






  </body>
</html>
