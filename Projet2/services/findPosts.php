<?php
// auteur: Ibrahima BALDE
set_include_path('..'.PATH_SEPARATOR);
spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
});
require_once ('lib/initDataLayer.php');
require_once ('lib/common_service.php');

$args = new RequestParameters();
$args->defineNonEmptyString('id') ;

if ($args->isValid()) {
  $liste = $data->getPosts($args->getValue('id')) ;
  if ($liste) {
    date_default_timezone_set('Europe/Paris');
    $date = date('Y-M-D h:m:s');
    $result = new PostServices($date , $liste) ;
    produceResult($result) ;

  }
  else {
    produceError("Pas de post pour la station d'identifiant {$args->id} ") ;
  }

}
else{
  produceError('argument(s) invalide(s) --> '.implode(', ',$args->getErrorMessages()));
}





 ?>
