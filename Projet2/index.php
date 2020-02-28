<?php
// auteur: Ibrahima BALDE
session_name('ibrahima_philippe') ;
session_start();
//echo $_SESSION['identification'] ;
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/cartographie.css">
    <meta charset="utf-8">
    <script type="text/javascript" src = "js/scriptCarte.js"> </script>


    <link href='http://fonts.googleapis.com/css?family=Gudea' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Ubuntu+Mono&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
   integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
   crossorigin=""></script>
   <script src="js/fetchUtils.js"></script>
   <script src="js/design.js"></script>
   <script src="js/ListeEtoile.js"></script>

    <title></title>
  </head>

  <body >

 <?php
  if (isset($_SESSION['identification'])) {

    echo '<input id="connect" name="connection" type="hidden" value="'.$_SESSION['identification'].'">';
  }
  ?>

    <header>
      <nav>
        <ul>
          <li class="titre">Carbadvisor      </li>
          <li> <a href="#">Accueil</a> </li>
          <li> <a href="views/recherche.php">Station</a> </li>
          <li> <a href="#">A propos</a> </li>
          <li> <a href="#">Contact</a> </li>
          <li class="droite"> <a href="#"> <img src="images/avatar.png" alt="avatar" height="30" width="30"> </a> </li>
          <li class="droite"> <a href="views/pageLogin.php">Login</a> </li>
        </ul>
      </nav>

    </header>
    <br>
    <?php require_once ('views/station_search.php') ;?>

    <div id="stations">
      <!--
      <div id="form-search">
        <h2>Formulaire de recherche</h2>
      </div>
      -->
      <div id="cartecampus">
        <h2>carte</h2>

      </div>

    </div>

    <div id="best">
      <div id="info">
        <h2>Information</h2>
        <div class="information" id ="infos">
        </div>
        <div id = "identifiant"></div>
        <div id = "ville"></div>
        <div id = "cp"></div>
        <div id = "nom"></div>
        <div id = "adresse"></div>
        <div id = "marque"></div>
        <div id = "carburants"></div>
        <div id = "prix"></div>
        <div id = "services"></div>
      </div>

      <div id="remarque">
        <div id="avis">
          <h2 class="green">Vos avis</h2>

          <div id ="notation_station">
            <p class="right">  je donne mes notes </p>

            <div id="rangement-1">
              <span>Note Globale</span>
              <div id="noteGlobale">
                <script type="text/javascript">
                  CreateListeEtoile('noteGlobale',5);
                </script>
              </div>
            </div>

            <div id="rangement-2">
              <span>Note Accueil</span>
              <div id="noteAccueil">
                <script type="text/javascript">
                  CreateListeEtoile('noteAccueil',5);
                </script>
              </div>
            </div>

            <div id="rangement-3">
              <span>Note Prix</span>
              <div id="notePrix">
                <script type="text/javascript">
                  CreateListeEtoile('notePrix',5);
                </script>
              </div>
            </div>

            <div id="rangement-4">
              <span>Note Service</span>
              <div id="noteService">
                <script type="text/javascript">
                  CreateListeEtoile('noteService',5);
                </script>
              </div>
            </div>

            <button type="submit" id="valider_station">soumettre</button>


          </div>

          <span id="errorMessage"></span>
          <div id="notes">
            <p> note global : <span id="global" class="green"></span> </p>
            <p> Accueil : <span id="accueil"></span></p>
            <p> Prix : <span id="prix"></span></p>
            <p> Service : <span id="service"></span></p>
          </div>
          <div id="form-avis">

          </div>
        </div>

        <div id="post">
          <h2 class="green" >Vos posts</h2>
          <p class="right"> < je poste </p>
          <div id="forms_post">
            <form id="forms_post" name="form_post" action="" method="post">
              <fieldset style="width:360px;">
              <label for="title">Title</label><br/>
              <input type="text" id="title" value=""/><br/>
              <label for="content">Content</label><br/>
              <textarea id="content" name="post-content" rows="10" cols="50"></textarea>
              <input type="submit" value="valider"/>
              </fieldset>

            </form>
          </div>
          <div id="posts">

          </div>

        </div>

      </div>

    </div>
    <script >
      document.getElementById('valider_station').addEventListener('click',noteStation);
      document.forms.form_post.addEventListener('submit' , envoie);
    </script>
    <script src="js/menu.js"></script>
  <!--<script src="js/forms.js" charset="utf-8"></script>-->
  </body>
</html>
<?php  ?>
