<?php
// auteur: Ibrahima BALDE
spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
});

require_once ('lib/initDataLayer.php');
$args = new RequestParameters();
$args->defineNonEmptyString('pseudo') ;

if ($args->isValid()) {

  if ($args->size == "small")
 		$size = 48;
 	else
 		$size = 256;

 	try {
 		//$data = new DataLayer();
 		if ($imageSpec = $data->getAvatar($args->pseudo, $size)) {
 			$flux = $imageSpec["data"]; // le flux contenant l'image
 			header("Content-Type: ".$imageSpec["mimetype"]);
 			fpassthru($flux);
 			exit();
 		}
	 	else
	 		produceError('Aucun resultat(s) obtenu(s)');
 	} catch (PDOExcecption $e) {
 		produceError($e->getMessage());
 	}




}
else {
  $reponse = ['status'=> 'error' ,'message'=>"arguments invalides"] ;
}

header('Content-type: application/json') ;
echo "";





 ?>
