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

  // Recuperation du pseudo de la session ouverte
  $login = $_SESSION['identification'] ;

  // n'oublie pas le post après
  $args = new RequestParameters();

  //Recuperation et filtrage du paramètre id
  $args->defineNonEmptyString('id') ;
  $paramPassed = true ;
  if ($args->isValid()) {
    $id = $args->getValue('id') ;
  }
  else {
    $paramPassed = false ;
    produceError('argument id  invalide --> '.implode(', ',$args->getErrorMessages()));
  }


  //Recuperation de l'avis
  $args->defineEnum('avis' , ['like' , 'nolike']) ;
  if ($args->isValid()) {
    $avis = $args->getValue('avis') ;
  }
  else {
    $paramPassed = false ;
    produceError('parametre avis  invalide --> '.implode(', ',$args->getErrorMessages()));
  }


  // Si tous les paramètres sont corrects
  if ($paramPassed) {
    $res = $data->notePost($id , $avis) ;
    //var_dump($res) ;
    if ($res) {
      produceResult($res) ;
    }
    else {

      produceError("identifiant {$args->id} inconnu") ;
    }

  }
  else{
    produceError('arguments invalides  --> '.implode(', ',$args->getErrorMessages()));
  }
}else {
  produceError("Vous n'etes pas connecté ") ;
}






 ?>
