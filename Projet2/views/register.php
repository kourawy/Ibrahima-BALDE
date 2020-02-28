
<?php  ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>

     <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />
  </head>
  <body>
    <di> <a href="../index.php"> Retour</a> </div>
    <h2>Bienvenue dans la page d'inscription</h2>
    <div id="container">
    <form method="POST" action="../services/createUtilisateur.php">
     <h1>Inscription</h1>
      <label for="pseudo">Login </label>
      <input type="text" name="pseudo" id="pseudo" required="required" autofocus/>

      <label for="password">Mot de passe </label>
      <input type="password" name="password" id="password" required="required" />

      <label for="nom">Nom </label>
      <input type="text" name="nom" id="nom" required="required"/>

      <label for="prenom">Prenom </label>
      <input type="text" name="prenom" id="prenom" required="required" />

      <label for="mail">email </label>
      <input type="text" name="mail" id="mail" required="required" />

      <label for="ville">Ville </label>
      <input type="text" name="ville" id="ville" required="required" />

      <input type="submit" id='submit' value='LOGIN' >

    </form>
  </div>
  </body>
</html>
