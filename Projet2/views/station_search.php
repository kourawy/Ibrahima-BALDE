<?php

$recherche_base = file_get_contents('http://webtp.fil.univ-lille1.fr/~balde/Projet2/services/findBestStations.php') ;
$recherche_json = json_decode($recherche_base , true) ;

//echo "$recherche_json";
//var_dump($recherche_json["result"]) ;

if(is_array($recherche_json["result"])){

foreach ($recherche_json["result"] as $key) {
    foreach ($key as $k => $value) {
      if($k == "id"){
        $tr = $tr . "<tr data-id=" . '"' . "$value" . '"'   ;
        $info_base = file_get_contents('http://webtp.fil.univ-lille1.fr/~clerbout/carburant/infoStation.php?id='. $value) ;
        $info_json = json_decode($info_base , true) ;

        //var_dump($info_json);
        $idcarburant = "" ;
        $libellecarburant = "" ;
        $price = "" ;
        foreach ($info_json["data"]["prix"] as $key_prix) {
          foreach ($key_prix as $key_info => $value_info) {
               if($key_info == "idcarburant"){
                 $idcarburant .=  $value_info  . " , "  ;
               }
               elseif($key_info == "libellecarburant"){
                 $libellecarburant .=  $value_info . " , "  ;
               }
               elseif($key_info == "valeur"){
                 $price .= $value_info . " , "  ;
               }

          }
        }
        $idcarburant = rtrim($idcarburant , " , ") ;
        $libellecarburant = rtrim($libellecarburant , " , ") ;
        $price = rtrim($price , " , ") ;
        $tr = $tr .  " data-idcarburant='" . $idcarburant . "'" . " data-libellecarburant='" . $libellecarburant . "'" . " data-prix='" . $price . "'" ;

        $services = "" ;
        if(is_array($info_json["data"]["services"])){
        foreach ($info_json["data"]["services"] as $key_service) {
          $services .= $key_service . " , " ;
        }
      }
       $services = str_replace("'" , " " , $services) ;
        $services = rtrim($services , " , ") ;
        $tr .= " data-services='" . $services . "'" ;
        //require_once ('lib/initDataLayer.php');
        require_once ("lib/db_parms.php") ;
        require_once ("lib/DataLayer.class.php") ;
        $data = new DataLayer() ;

        $value = str_replace('"', "'", $value);
        //var_dump($value);
        $add_info = $data->getAdditionalInfo($value) ;
        //var_dump($add_info);
       if($add_info != FALSE && is_array($add_info)){
          foreach ($add_info as $key_add => $value_add) {
            foreach ($value_add as $key_a => $value_a) {

              if($key_a== "nom"){
                if($value_a == null){
                  $tr = $tr . " data-nom='No Name'";
                }
                else{
                  $tr = $tr . " data-nom=" . '"' . "$value_a" . '"' ;
                }
              }
              if($key_a == "marque"){
                  $tr = $tr . " data-marque=" . '"' . "$value_a" . '"' ;
                }

                if($key_a == "cp"){
                  $tr = $tr . " data-cp=" . '"' . "$value_a" . '"' ;
                }
                if($key_a == "adresse"){
                  $tr = $tr . " data-adresse=" . '"' . "$value_a" . '"' ;
                }
                if($key_a == "ville"){
                  $tr = $tr . " data-ville=" . '"' . "$value_a" . '"' ;
              }
            }

          }

        }
        //var_dump($tr);
   }




      if($k == "latitude"){
          $tr = $tr . " data-lat=" . '"' . "$value"  . '"'  ;
        }
        if($k == "longitude"){
          $tr = $tr . " data-lon=" . '"' . "$value" . '" </tr>' ;
        }
        

   }
   //var_dump($tr);
 }
 //var_dump($tr);

 echo  "<table id='communes'> <thead> <tr> <th> </th></tr> </thead> <tbody> " . $tr . "</tbody> </table>" ;
}
else{

if($donne["message"] == "commune inexistante"){
    echo "<p id='notfound'>Commune Not found</p>" ;
  }
  else if($donne["message"] == "carburants : rejected"){
    echo "<p id='rejected'>You didn't choosed a Carburant</p>" ;
  }

}


 ?>
