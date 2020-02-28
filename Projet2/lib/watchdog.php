<?php
// auteur: Ibrahima BALDE
$login = filter_input(INPUT_GET,'login') ;
$password = filter_input(INPUT_GET,'password') ;
session_name('ibrahima_philippe') ;
session_start() ;
if (isset($_SESSION['identification'])) {
  return ; // Si tout se passe bien bien fin normal
}
if ($login == '' || $password =='') {
  $_SESSION['echec'] = true ;
  require ('views/pageLogin.php');
  exit() ; // Termine le script et on ramène l'utilisateur a la page de $login


}

require_once ('initDataLayer.php');
$person = $data->authentifier($login , $password) ;
if (! $person) {
  $_SESSION['echec'] = true ;
  require ('views/pageLogin.php');
  exit() ; // Termine le script et on ramène l'utilisateur a la page de $login
}

$_SESSION['identification'] = $person ;
unset($_SESSION['echec']) ;



 ?>
