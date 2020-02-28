<?php
// auteur: Ibrahima BALDE
spl_autoload_register(function ($className) {
    include ("lib/{$className}.class.php");
});

header('Content-type: application/json') ;
require_once ('../lib/watchdog_service.php');
require_once ('../lib/initDataLayer.php');
$pseudo = $_SESSION['identification']->pseudo ;
if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] !='') {
  $desc = $_FILES['image'] ;
  $flux = fopen($des['tmp_name'] ,'r') ;
  $res = $data->storeAvatar(['data'=>$flux , 'mimetype'=>$desc['type']] , $pseudo) ;
  if ($res) {
    $reponse = ['status'=>'ok'] ;
  }
  else {
    $reponse = ['status'=>'error' ,'message'=>'enregistrement impossible'] ;
  }

}
else{
  $reponse = ['status'=>'error' ,'message'=>'fichier non reçu'] ;
}






 ?>
