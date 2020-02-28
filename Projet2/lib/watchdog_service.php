<?php
// auteur: Ibrahima BALDE
set_include_path('..'.PATH_SEPARATOR);
session_name('ibrahima_philippe') ;
session_start() ;

require_once ('lib/common_service.php');

if (isset($_SESSION['identification'])) {
  $connect = true ;
  return ; // Si tout se passe bien bien fin normal
}
elseif (!isset($_SESSION['identification'])) {
  if ($login == '' || $password =='') {
    $_SESSION['echec'] = true ;

    produceError("Parametres pseudo ou mot de passe nul(s) ") ;
    //echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
    exit() ; //Termine le script et on affiche le message d'erreur
  }

  else {
    require_once ('lib/initDataLayer.php');
    $person = $data->authentifier($login , $password) ;
    if (! $person) {
      $_SESSION['echec'] = true ;
      produceError("Echec de l authentification car parametres incorrects ") ;
      //cho "<p style='color:red'>Echec de l'authentification</p>";
      exit() ; // Termine le script et on affiche le message d'erreur
    }
    else {
      $_SESSION['identification'] = $person ;
      unset($_SESSION['echec']) ;
    }


  }

}







 ?>
