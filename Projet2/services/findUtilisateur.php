<?php
// auteur: Ibrahima BALDE
set_include_path('..'.PATH_SEPARATOR);
spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
});
require_once ('lib/initDataLayer.php');
require_once ('lib/common_service.php');

$args = new RequestParameters();
$args->defineNonEmptyString('pseudo') ;

if ($args->isValid()) {
  $res = $data->getFindUtilisateur($args->pseudo) ;
  if ($res) {
    produceResult($res) ;

  }
  else {
    produceError("identifiant {$args->pseudo} inconnu");
  }

}
else{
  produceError('argument(s) invalide(s) --> '.implode(', ',$args->getErrorMessages()));
}


 ?>
