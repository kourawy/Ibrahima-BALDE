<?php
	require_once('lib/ArgumentSet.class.php');
	
	// defintion du proxy pour avoir l'acces direct
	$configContext = array( 'http' => array('proxy' => 'tcp://cache.univ-lille1.fr:3128', 'request_fulluri' => true)
		);
	stream_context_set_default($configContext);

	// lecture des données du formulaire
	$argSet = new ArgumentSet(INPUT_GET);

	if ($argSet->isValid()) {
		$nom = $argSet->getNom();
		$loc = $argSet->getLocalite();
		$act = $argSet->getActivite();
		$cat = $argSet->getCategorie();
		$url = "https://opendata.lillemetropole.fr/api/records/1.0/search/?dataset=base-sirene&rows=20&q=";
		//------------------------------FORMATION DE L'URL---------------------------------//
		$tabArgs = array($nom => "(nomen_long:", $loc => "(libcom:", $act => "(activite: ");
		foreach ($tabArgs as $arg => $value) {
			if(!is_null($arg) && $arg != "")
				$url.= $value.$arg.")+and+";
		}
		$url = substr($url, 0, -5);
		if($cat != "")
			$url.= "&refine.categorie=".$cat;
		//-----------------------------------------------------------------------------------//
		
		// lecture à distance des données de notre url
		$data = json_decode(file_get_contents ($url), TRUE);
		require('views/pageListEntreprises.php');
	}
 	else {
 		require('views/formulaireEntreprises.php');
	}
?>