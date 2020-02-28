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
  // n'oublie pas le post après
  $args = new RequestParameters();
  $args->defineInt('id') ;
  if ($args->isValid()) {
    $id = $args->id ;
    $res = $data->deletePost($id , $auteur) ;
    if ($res) {
      produceResult($res) ;

    }
    else {
      produceError("identifiant {$args->id} inconnu") ;
    }

  }
  else{
    produceError('argument id  invalide --> '.implode(', ',$args->getErrorMessages()));
  }


}else {
  produceError("Vous n'etes pas connecté ") ;
}






 ?>
