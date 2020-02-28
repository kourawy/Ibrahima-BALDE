<?php
// auteur: Ibrahima BALDE 
set_include_path('..'.PATH_SEPARATOR);
spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
});

session_name('ibrahima_philippe') ;
session_start() ;

require_once ('lib/initDataLayer.php');
require_once ('lib/common_service.php');

if (!isset($_SESSION['identification'])) {
  // n oublie pas le post
  $args = new RequestParameters('post');
  // Recuperation du pseudo
  $args->defineNonEmptyString('pseudo') ;
  $paramPassed = true ;
  if ($args->isValid()) {
    $pseudo = $args->getValue('pseudo') ;
  }
  else {
    $paramPassed = false ;
    produceError('argument pseudo  invalide --> '.implode(', ',$args->getErrorMessages()));
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

  $args->defineNonEmptyString('nom') ;
  //$paramPassed = true ;
  if ($args->isValid()) {
    $nom = $args->getValue('nom') ;
  }
  else {
    $paramPassed = false ;
    produceError('argument nom  invalide --> '.implode(', ',$args->getErrorMessages()));
  }
  //Recuperation du prenom

  $args->defineNonEmptyString('prenom') ;
  //$paramPassed = true ;
  if ($args->isValid()) {
    $prenom = $args->getValue('prenom') ;
  }
  else {
    $paramPassed = false ;
    produceError('argument prenom  invalide --> '.implode(', ',$args->getErrorMessages()));
  }
  //Recuperation du  mail

  $args->defineNonEmptyString('mail') ;
  $paramPassed = true ;
  if ($args->isValid()) {
    $mail = $args->getValue('mail') ;
  }
  else {
    $paramPassed = false ;
    produceError('argument mail  invalide --> '.implode(', ',$args->getErrorMessages()));
  }
  //Recuperation de la ville

  $args->defineNonEmptyString('ville') ;
  $paramPassed = true ;
  if ($args->isValid()) {
    $ville = $args->getValue('ville') ;
  }
  else {
    $paramPassed = false ;
    produceError('argument ville  invalide --> '.implode(', ',$args->getErrorMessages()));
  }



  if ($paramPassed) {
    $res = $data->createUser($pseudo , $password , $nom , $prenom ,
                        $mail , $ville) ;

    if ($res) {
      $_SESSION['identification'] = $pseudo ;
      produceResult($res) ;
      //echo "Vous avez bien crée votre compte :)";

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
