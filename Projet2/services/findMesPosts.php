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

  $login = $_SESSION['identification'] ;

  $args = new RequestParameters();

  if ($args->isValid()) {
    $liste = $data->getMesPosts($login) ;
    if ($liste) {
      date_default_timezone_set('Europe/Paris');
      $date = date('Y-M-D h:m:s');
      $result = new PostServices($date , $liste) ;
      produceResult($result) ;

    }
    else {
      produceError("Pas de post pour  $login ");
    }

  }
  else{
    produceError('argument(s) invalide(s) --> '.implode(', ',$args->getErrorMessages()));
  }
}else {
  produceError(" Vous n'etes pas connecté ");
}






 ?>
