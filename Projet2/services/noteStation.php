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
    produceError('Parametre identifiant incorrect --> '.implode(', ',$args->getErrorMessages()));
  }
  //echo "$id";
  //var_dump($id);echo "string";

  //Recuperation et filtrage du paramètre global
  $args->defineInt('global' , ['min_range'=>0 , 'max_range'=>5]) ;
  if ($args->isValid()) {
    $noteglobale = $args->getValue('global') ;
  }
  else {
    $paramPassed = false ;
    produceError('Parametre global incorrect --> '.implode(', ',$args->getErrorMessages()));
  }
  //echo "  $noteglobale";

  //Recuperation et filtrage du paramètre accueil
  $args->defineInt('accueil' , ['min_range'=>0 , 'max_range'=>5]) ;
  if ($args->isValid()) {
    $noteaccueil = $args->getValue('accueil') ;
  }
  else {
    $paramPassed = false ;
    produceError('Parametre accueil incorrect --> '.implode(', ',$args->getErrorMessages()));
  }
  //echo "  $noteaccueil";

  //Recuperation et filtrage du paramètre prix
  $args->defineInt('prix' , ['min_range'=>0 , 'max_range'=>5]) ;
  if ($args->isValid()) {
    $noteprix = $args->getValue('prix') ;
  }
  else {
    $paramPassed = false ;
    produceError('Parametre prix incorrect --> '.implode(', ',$args->getErrorMessages()));
  }
  //echo "  $noteprix";

  //Recuperation et filtrage du paramètre service
  $args->defineInt('service' , ['min_range'=>0 , 'max_range'=>5]) ;
  if ($args->isValid()) {
    $noteservice = $args->getValue('service') ;
  }
  else {
    $paramPassed = false ;
    produceError('Parametre service incorrect --> '.implode(', ',$args->getErrorMessages()));
  }
  //echo " $noteservice $paramPassed $login ";

  // Si tous les paramètres sont corrects
  if ($paramPassed) {
    $res = $data->memberNoteStation($login ,$id , $noteglobale , $noteaccueil ,
                               $noteprix , $noteservice) ;
    //echo "string ";
    //var_dump($res) ;
    if ($res) {
      produceResult($res);
    }
    else {
      produceError(" L'identifiant $id de la station est inconnu ");
    }

  }
  else{
    produceError('Parametres incorrects --> '.implode(', ',$args->getErrorMessages()));
  }
}else {
  produceError(" Vous n'etes pas connecté ");
}







 ?>
