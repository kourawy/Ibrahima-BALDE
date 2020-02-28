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
  $res = $data->getStation($args->getValue('id')) ;
  if ($res) {
    produceResult($res) ;

  }
  else {
    produceError("Identifiant {$args->id} inconnu");
  }

}
else{
  produceError('argument(s) invalide(s) --> '.implode(', ',$args->getErrorMessages()));
}





 ?>
