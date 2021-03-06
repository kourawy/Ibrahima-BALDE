<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Recherche entreprises</title>
		<meta title = "author" content = "Ibrahima BALDE" />
		<link rel="stylesheet" type="text/css" href="styles/formulaireEntreprises.css">
	</head>
	<body>
		<header>
			
		</header>
		<div id="principal">
			<h1> Recherche d'une entreprise </h1>
			<p> Cette application vous offre la possibilité de rechercher une entreprise dans la metropole lilloise.
			</p>
			<p>
				Vous avez la possibilité de rechercher par le nom de l'entreprise, la localité ou l'activité et aussi la categorie.
			</p>
			<p> 
				Pour ce faire veuillez remplir le formulaire suivant, veuillez saisir au moins le nom et/ou la localité et/ou l'activité l'un des trois suffira.
			</p>
			<section id="errorMessage">
				<?php
					$message = "L'un au moins des champs suivants doit être rempli : ";
				    foreach ($argSet->getErrors() as $name => $value)
				        $message = $message ."<span> $name </span>, ";
				    $message = substr($message, 0, strlen($message)-2) . ".";
				    echo "<p> $message </p>";
	    		?>
			</section>
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
		</div>
		<footer>
			<figure>
				<img src="couvertures/logo_FIL.png" alt="logo université lille1">
			</figure>
			<p><span id="source"> <a href="views/credit.html"> <abbr title="Les sources des images et autres"> Crédits</abbr></a> </span> Auteur: Balde Ibrahima </p>
		</footer>
	</body>
</html>

