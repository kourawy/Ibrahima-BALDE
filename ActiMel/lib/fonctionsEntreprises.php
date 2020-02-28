<?php

/**
* Permet de filtrer les informations utiles des données obtenues
* Informations filtrées:
*	- le nom de l'entreprise
*	- l'adresse
*	- l'activité
*	- la categorie
*	- la tranche d'effectif
*	- la nature juridique
*	- la localité
*	- la latitude et la longitude
* renvoie un tableau de chaque entreprise(representé par un tableau
* contenant les elements filtrés)
*/
function getMainInformation($data){
	$fields = array();
	$records = $data["records"];
	foreach ($records as $record) {
		$field = $record["fields"];
		$nom = $field["nomen_long"];
		$adresse = $field["l2_normalisee"];
		if( is_null($adresse))
			$adresse = $field["l6_normalisee"];
		$activite = $field["activite"];
		$categorie = $field["categorie"];
		$tranchEffectif = $field["libtefet"];
		$natJuridik = $field["libnj"];
		$latitude = $field["coordonnees"][0];
		$longitude = $field["coordonnees"][1];
		$localite = $field["libcom"];
		$fields[] = array("nom" => $nom, "adresse" => $adresse, "activite" => $activite, "categorie" => $categorie, "effectif" => $tranchEffectif, "natJuridik" => $natJuridik, "latitude" => $latitude, "longitude" => $longitude, "localite" => $localite);
	}
	return $fields;
}

/**
* renvoies le nombre d'entreprises trouvées sous forme HTML
*/
function nbFieldsToHTML($fields){
	$nbFields = count($fields);
	$res = "Nous avons obtenus " . $nbFields;
	if($nbFields > 1)
		$res.= " entreprises qui repondent à vos critères. Ce sont les suivantes :";
	else
		$res.= " entreprise qui repondent à vos critères.";
	return "<p> $res </p>";
}

/**
* Crée un attriut regroupant une donnée $name de valeur $value
*/
function createAttributeData($name, $value){
	return "data-".$name."=\"".$value."\" ";
}

/**
* renvoie un tableau HTML avec les elements de fields
* $fields doit être un tableau de tableau (le resultat de getMainInformation)
*/
function ListNamesToHTML($fields){
	$list = "<table>";
	if(count($fields) > 0)
		$list.="<thead><td> NOM DES ENTREPRISES </td><td> LOCALITES </td></thead>";
	foreach ($fields as $field){
		$attribut = "";
		foreach ($field as $name => $value)
			$attribut.= createAttributeData($name, $value);
		$nom = $field["nom"];
		$id = $field["longitude"];
		$localite = $field["localite"];
		$list.= "<tr><td $attribut class=\"field\"> <a href=\"#$id\">$nom </a></td> <td>$localite</td></tr>";
	}
	$list.= "</table>";
	return $list;
}
	


/**
* renvoie un code HTML regroupant les données filtrées(utile) de $data
* un texte puis un tableau HTML
*/
function dataToHTML($data){
	$fields = getMainInformation($data);
	return nbFieldsToHTML($fields) . ListNamesToHTML($fields);
}

?>