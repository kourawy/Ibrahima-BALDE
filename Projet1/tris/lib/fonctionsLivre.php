<?php
// propriete d'un livre.
function property($line){
  if(strpos($line, " : ") != FALSE){
    $explode = explode(" : ", $line);
    $table = array("name" => trim($explode[0]), "value" => trim($explode[1]));
    return $table;
  }
  else{
    throw new Exception("Unexpected : ");
  }
}

/*
// lecture d'un livre: couverture, titre, serie, auteurs, annee, categories.
function readBook($file){
  $line = fgets($file);
  while($line != ""){
    $property = property($line);
    $table[$property["name"]] = $property["value"];
    $line = fgets($file);
  }
  return $table;
}
*/

function readBook($file){
  $line = fgets($file);
  if($line != ""){
    while($line != ""){
      while($line != "\r\n" && $line != ""){
        $property = property($line);
        $table[$property["name"]] = $property["value"];
        $line = fgets($file);
      }
      $line = fgets($file);
      $ttable[] = $table;
    }
    
    return $ttable;
  }
  else{ return FALSE; }
}

// renvoie une chaine contenant du code HTML d'un element de type elementType, class propName, contenu text
function elementBuilder($propName, $elementType, $text){
  $str = "<{$elementType} class = " . $propName . ">" . $text . "</{$elementType}>";
  return $str;
}

// cree le code HTML des auteurs
function authorsToHTML($authors){
  $explode = explode(' - ', $authors);
  return elementBuilder("", "span", implode("</span> - <span>", $explode));
}

/* une chaîne contenant le code HTML représentant l’image de couverture
* filename : l'images
*/
function coverToHTML($fileName){
  return "<img src='couvertures/{$fileName}' alt='images de couvertures'/>";
}

// renvoie une chaîne contenant le code HTML représentant la propriété
function propertyToHTML($propName, $propValue){
  if($propName == "titre"){
    return elementBuilder($propName, "h2", $propValue);
  }
  elseif($propName == "annee"){
    return elementBuilder($propName, "time", $propValue);
  }
  elseif($propName == "couverture"){
    return elementBuilder($propName, "div", coverToHTML($propValue));
  }
  elseif($propName == "auteurs"){
    return elementBuilder($propName, "div", authorsToHTML($propValue));
  }
  else{
    return elementBuilder($propName, "div", $propValue);
  }
}

// le résultat est une chaîne qui contient le code HTML correspondant (c’est à dire le code d’un élément article)
function bookToHTML($book){
  $couverture = propertyToHTML("couverture", $book["couverture"]);
  $descriptionValue = "";
  foreach($book as $key => $value){
    if($key != "couverture"){
      $descriptionValue = $descriptionValue . propertyToHTML($key, $value);
    }
  }
  $descriptionName = "description ".$book["catégorie"];
  $description = propertyToHTML("'$descriptionName'", $descriptionValue);
  return elementBuilder("'livre'", "article", $couverture . $description);
}

function libraryToHTML($file){
  $library = "";
  $ttable = readBook($file);
  foreach($ttable as $book){
    $library = $library . bookToHTML($book);
  }
  return $library;
}
?>
