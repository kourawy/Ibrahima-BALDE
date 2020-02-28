<?php
/**
Exemple de classe permettant de vérifier et représenter 2 arguments reçus en mode GET : 
	- 'arg1' (obligatoire) qui doit être une chaîne non vide. Elle sera nettoyée (enlever balises html et caractères spéciaux)
	- 'arg2' (facultatif) qui doit être soit 'green' (par defaut) soit 'red'
	- 'cp' (obligatoire) : code postal
	
Une valeur incorrecte pour l'un ou l'autre des arguments est considérée comme un erreur

Cette classe est une évolution de celle de l'exercice précédent :
	- utilisation du filtrage (filter_input)
	- le type de transmission (GET/POST) est un attribut de la classe. Il est fixé à l'instanciation (GET, par défaut)
	   (intérêt : pouvoir changer le mode de transmission sans devoir retravailler le code)
	- les valeurs sont regroupées dans un seul attribut de type table associative : $this->values,
		ce qui facilite la factorisation du code


*/
class ArgumentSet {
	private $inputType;  			// INPUT_GET, INPUT_POST, ...
	private $errors = array(); // associative array (map) : key : arg name (string), value : "rejected" or "missing"
	private $values = array(); // associative array (map) : key : arg name (string), value : arg retained value
	
	
	/**
	 *	indicates validity of this arg set
	 */
	public function isValid(){
		return count($this->errors) < 3;
	}
	
	/**
	 *	return associative array (map) of errors : 
	 *	entry : key : arg name (string), value : "rejected" or "missing"
	 */
	public function getErrors(){
		return $this->errors;
	}
	
	public function __construct($inputType=INPUT_GET){	
	
		$this->inputType = $inputType;
		
	
		// arguments , mandatory. Should be non empty string. 
		// has to be to sanitized
		// Vérification de la validité des arguments	
		$args = array("nom", "localite", "activite");
		foreach($args as $arg){
			$name = $arg;
			$v = filter_input($this->inputType, $name, FILTER_SANITIZE_STRING);
			if (is_null($v))
				$this->errors[$name] = "missing";
			else if ($v === FALSE || $v == "")
				$this->errors[$name] = "rejected";
			else 
				$this->values[$name] = $v;
		}

		// arguments , optional. can be empty string.
		// has to be to sanitized 
		$name = "categorie";
		$v = filter_input($this->inputType, $name, FILTER_SANITIZE_STRING);
		if (is_null($v))
			$this->values[$name] = "";
		else if ($v === FALSE || !in_array($v, array("", "PME", "ETI", "GE")))
			$this->errors[$name] = "rejected";
		else
			$this->values[$name] = $v;
	
	}
	/**
	*	renvoies le nom
	*/	
	public function getNom(){
		if (isset($this->values['nom']))
			return $this->values['nom'];
		else 
			return NULL;
	}

	/**
	*	renvoies la localité
	*/	
	public function getLocalite(){
		if (isset($this->values['localite']))
			return $this->values['localite'];
		else 
			return NULL;
	}

	/**
	*	renvoies l'activité
	*/	
	public function getActivite(){
		if (isset($this->values['activite']))
			return $this->values['activite'];
		else 
			return NULL;
	}

	/**
	*	renvoies la catégorie
	*/	
	public function getCategorie(){
		if (isset($this->values['categorie']))
			return $this->values['categorie'];
		else 
			return NULL;
	}
}

?>
