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

  $auteur = $_SESSION['identification'] ;

  // N'oublie pas le post après
  $args = new RequestParameters('post');

  // Recuperation du parametre station
  $args->defineNonEmptyString('station') ;
  $paramPassed = true ;
  if ($args->isValid()) {
    $station = $args->getValue('station') ;
  }
  else {
    $paramPassed = false ;
    produceError('Parametre station incorrect --> '.implode(', ',$args->getErrorMessages()));
  }

  // Recuperation du paramètre titre
  $args->defineNonEmptyString('titre') ;
  //$paramPassed = true ;
  if ($args->isValid()) {
    $titre = $args->getValue('titre') ;
  }
  else {
    $paramPassed = false ;
    produceError('Parametre titre incorrect --> '.implode(', ',$args->getErrorMessages()));
  }

  $args->defineNonEmptyString('contenu') ;
  //$paramPassed = true ;
  if ($args->isValid()) {
    $contenu = $args->getValue('contenu') ;
  }
  else {
    $paramPassed = false ;
    produceError('Parametre contenu incorrect --> '.implode(', ',$args->getErrorMessages()));
  }

  date_default_timezone_set('Europe/Paris');
  $date = date('Y-M-D h:m:s');


  if ($paramPassed) {
    $res = $data->createPost($auteur , $station ,$titre , $contenu , $date) ;
    if ($res) {
      produceResult($res);

    }
    else {
      produceError('Error requete ');
    }

  }
  else{
    produceError('Parametres incorrects --> '.implode(', ',$args->getErrorMessages()));
  }
}else {
  produceError(" Vous n'etes pas connecté ");
}






 ?>
