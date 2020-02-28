<?php
// auteur: Ibrahima BALDE
set_include_path('..'.PATH_SEPARATOR);
spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
});



require_once ('lib/watchdog_service.php');
require_once ('lib/initDataLayer.php');
require_once ('lib/common_service.php');

if (isset($_SESSION['identification'])) {
  // n oublie pas le post
  $args = new RequestParameters();

  // Recuperation du mail
  $args->defineNonEmptyString('mail') ;
  $paramPassed = true ;
  if ($args->isValid()) {
    $mail = $args->getValue('mail') ;
  }
  else {
    $paramPassed = false ;
    produceError('argument mail  invalide --> '.implode(', ',$args->getErrorMessages()));
  }
  //Recuperation du mot de passe

  $args->defineNonEmptyString('password') ;
  //$paramPassed = true ;
  if ($args->isValid()) {
    $password = $args->getValue('password') ;
  }
  else {
    $paramPassed = false ;
    produceError('argument password  invalide --> '.implode(', ',$args->getErrorMessages()));
  }
  //Recuperation du nom

  $args->defineNonEmptyString('description') ;
  //$paramPassed = true ;
  if ($args->isValid()) {
    $description = $args->getValue('description') ;
  }
  else {
    $paramPassed = false ;
    produceError('argument description  invalide --> '.implode(', ',$args->getErrorMessages()));
  }


  //Recuperation de la ville

  $args->defineNonEmptyString('ville') ;
  //$paramPassed = true ;
  if ($args->isValid()) {
    $ville = $args->getValue('ville') ;
  }
  else {
    $paramPassed = false ;
    produceError('argument ville  invalide --> '.implode(', ',$args->getErrorMessages()));
  }

  $pseudo = $_SESSION['identification'] ;

  //echo "$pseudo ,$mail , $description , $ville ,$password ";
  if ($paramPassed) {
    $res = $data->updateProfil($pseudo ,$mail , $description , $ville ,$password);
    //echo "$res";
    if ($res) {

      //$_SESSION['identification'] = $pseudo ;
      produceResult($res) ;
      //echo "Vous avez bien modifié votre profil :)";

    }
    else {
      produceError('Paramètres inconnus') ;
    }

  }
  else{
    produceError('paramètres incorrects --> '.implode(', ',$args->getErrorMessages()));
  }
}else {
  produceError('Vous êtes deja connecté') ;
}



 ?>
