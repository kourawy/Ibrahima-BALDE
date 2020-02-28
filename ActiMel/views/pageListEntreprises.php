<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Recherche entreprises</title>
		<meta title = "author" content = "Ibrahima BALDE" />
		<link rel="stylesheet" type="text/css" href="styles/pageListEntreprises.css">
		<link rel="stylesheet" type="text/css" href="styles/formulaireEntreprises.css">
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
		<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
		<script src="script/scriptCarte.js"></script>
	</head>
	<body>
		<header>
		</header>
		<div id="principal">
			<h1> Recherche d'une entreprise </h1>
			<form action = "listEntreprises.php" method = "get">
				<fieldset>
					<legend>Informations sur l'entreprise</legend>
					<label for = "nom">Nom : </label><input type="text" name="nom" id="nom" size="30" maxlength="256" placeholder="Ex: decathlon" /> <br><br>
					<label for = "localite">Localite : </label><input type="text" name="localite" id="localite" size="30" maxlength="256" placeholder="Ex: lille"/><br><br>
					<label for = "activite">Activite : </label><input type="text" name="activite" id="activite" size="30" maxlength="256" placeholder="Ex: informatique"/><br><br>
					<label> Categorie :</label>
					<select name="categorie" id="categorie" optional>
						<option value="PME"> Petite et moyenne entreprise</option>
						<option value="ETI"> Entreprise de taille intermediaire</option>
						<option value="GE"> Grande entreprise</option>
						<option value="" selected> Choisir ...</option>
					</select><br><br>
					<button type="reset" id="reset">Annuler</button>
					<button type="submit" id="submit">Rechercher</button>
				</fieldset>
			</form>
			<h1>
				Entreprises trouvées
			</h1>
			<?php
				require_once("lib/fonctionsEntreprises.php");
				//header('Content-type: text/plain;charset=utf8');
				echo dataToHTML($data);
			?>
			<div id="map">
		</div>
		</div>
		
		<footer>
			<figure>
				<img src="couvertures/logo_FIL.png" alt="logo université lille1">
			</figure>
			<p><span id="source"> <a href="views/credit.html"> <abbr title="Les sources des images et autres"> Crédits</abbr></a> </span> Auteur: Balde Ibrahima </p>
		</footer>
	</body>
</html>