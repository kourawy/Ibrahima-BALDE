<?php
/*
  Si $_SESSION['echec'] est définie, un message d'erreur est affiché
  dans un paragraphe de classe 'message'
*/
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
     <meta charset="utf-8">
     <title>Identification</title>

      <link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />
  </head>
  <body>
    <di> <a href="../index.php"> Retour</a> </div>


<?php
 if (isset($_SESSION['echec']))
   echo "<p class='message'>Les login et mot de passe précédemment fournis étaient incorrects</p>";
?>

<div id="container">
    <!-- zone de connexion -->
<form method="POST" action="../services/login.php">
 <h1>Connexion</h1>
  <label for="login">Login </label>
  <input type="text" name="login" id="login" placeholder="entrez le login" required="required" autofocus/>
  <label for="password">Mot de passe </label>
  <input type="password" name="password" id="password" placeholder="entrez le mot de passe" required="required" />
  <input type="submit" id='submit' value='LOGIN' >

</form>
</div>
<p>Pas encore inscrit ? <a href="register.php">créez un compte.</a></p>
</body>
</html>

<?php
?>
