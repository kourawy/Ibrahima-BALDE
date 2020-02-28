<?php
// auteur: Ibrahima BALDE
set_include_path('..'.PATH_SEPARATOR);
spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
});


$args = new RequestParameters('post');
// Recuperation du login
$args->defineNonEmptyString('login') ;
$paramPassed = true ;
if ($args->isValid()) {
  $login = $args->getValue('login') ;
}
else {
  $paramPassed = false ;
  $res .= "Paramètre incorrect. " . $args->getErrorMessages();
}
// Recuperation du mot de passe
$args->defineNonEmptyString('password') ;
$paramPassed = true ;
if ($args->isValid()) {
  $password = $args->getValue('password') ;
}
else {
  $paramPassed = false ;
  $res .= "Paramètre incorrect. " . $args->getErrorMessages();
}



require_once ('lib/watchdog_service.php');
if ($person) {
  //global $connection = $_SESSION['identification'] ;
  //echo '<input id="connect" name="connection" type="hidden" value="'.$person.'">';
  //echo "<p style='color:white ;background:#459A7D'> $person s'est bien connecté :) </p> ";
  produceResult($person) ;
  header('Location: ../index.php');
  exit() ;


}
if ($connect) {
  $person = $_SESSION['identification'] ;
  produceError("$person est dejà connecté :) ") ;
  //echo "<p style='color:white ;background:#459A7D'> $person est dejà connecté :) </p> ";
}






 ?>
