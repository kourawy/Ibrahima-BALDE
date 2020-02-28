<?php
require_once("lib/fonctionsLivre.php");

/* compare de entiers en fonction de leur valeurs absolue
Param $i: un entier
param $j: un entiers
return: un entier positif si $i > $j, entier negatif si $i < $j ou 0 si $i == $j
*/
function compareAbs($i, $j){
  return abs($i) - abs($j);
}

/* compare deux chaines de caracteres en fonction de leur longueur
param $str1: une chaine de caractere
param $str2: une chaine de caractere
return: un entier positif si la longueur de $str1 > la longueur de $str2, un entier negatif si longueur de $str1 < la longueur de $str2 ou 0 si leur longueur sont égales
*/
function comparerChainesParLongueur($str1, $str2){
  $i = strlen($str1); $j = strlen($str2);
  return $i - $j;
}

/* compare deux chaines de caracteres en fonction de leur longueur et si elles sont egales ont l'ordre lexicographique inversé
param $str1: une chaine de caractere
param $str2: une chaine de caractere
return: un entier positif si la longueur de $str1 > la longueur de $str2, un entier negatif si longueur de $str1 < la longueur de $str2 ou 0 si leur longueur sont égales
*/
function comparerChainesParLongueurPlus($str1, $str2){
  $comp = comparerChainesParLongueur($str1, $str2);
  if($comp == 0){
    $comp = -(strcmp($str1, $str2));
  }
  return $comp;
}

/* compare deux livres par leur titre
param $livre1: un livre representé par un tableau
param $livre2: un livre representé par un tableau
return: 1, 0 ou -1 en fonction de si le titre de livre1 vient après, avant ou est le même que celui de livre2 suivant l'ordre lexicographique
*/
function compare2LivresParTitres($livre1, $livre2){
   return strcmp($livre1["titre"], $livre2["titre"]);
}

/* compare deux livres suivant leur categorie
param $livre1: un livre representé par un tableau
param $livre2: un livre representé par un tableau
*/
function compare2LivresParCategories($livre1, $livre2){
  $compCategorie = strcmp($livre1["catégorie"], $livre2["catégorie"]);
  if($compCategorie == 0){ // s'ils sont de même categorie
    $compAnnee = strcmp($livre1["année"], $livre2["année"]);
    if($compAnnee == 0){ // s'ils sont de même categorie et d'année
      return compare2LivresParTitres($livre1, $livre2); // alors je compare leur titre
    }
    else{
      return $compAnnee;
    }
  }
  else{
    return $compCategorie;
  }
}

/* renvoie une table qui contient des tables representant chacunes des livres
param $file: un fichier ouvert en lecture contenant les instructions d'un livre
return: une table qui contient des tables representant chacunes des livres
*/
function loadBiblio($file){
  $line = fgets($file);
  while($line != ""){
    while($line != "\r\n" && $line != ""){
      if(strpos($line, " : ") != FALSE){
        $explode = explode(" : ", $line);
        $property = array("name" => trim($explode[0]), "value" => trim($explode[1]));
      }
      else{
        throw new Exception("Unexpected : ");
      }
      $table[$property["name"]] = $property["value"];
      $line = fgets($file);
    }
    $line = fgets($file);
    $ttable[] = $table;
  }
  return $ttable;
}

/* renvoie une chaine contenant la representation HTML des livres de la liste passée en parametre dans l'ordre suivant $sort
param $liste: un tableau de livre
param $sort: l'ordre suivant lequel les livres sont triés
return: une chaine contenant la representation HTML des livres de la liste passée en parametre dans l'ordre suivant $sort
*/
function biblioToHTML($liste, $sort = "none"){
  if($sort == "titles"){
    usort($liste, "compare2LivresParTitres");
  }
  elseif($sort == "categories"){
    usort($liste, "compare2LivresParCategories");
  }
  elseif($sort != "none"){
    throw new Exception('Aucun tris de ce genre existant.');
  }
  $biblio = "";
  foreach($liste as $book){
    $biblio = $biblio . bookToHTML($book);
  }
  return $biblio;
}

 ?>
