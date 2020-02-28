<?php
// Ibrahima Balde
/**
 * Class that describes a station Service
 */
class Station
{
  public $id ;
  public $nom ;
  public $marque ;
  public $latitude ;
  public $longitude ;
  public $adresse ;
  public $cp ;
  public $ville ;
  public $nbnotes ;
  public $noteglobale ;
  public $noteaccueil ;
  public $noteprix;
  public $noteservice ;


  public function __construct($id , $marque , $nom ,$latitude,
            $longitude , $cp , $ville , $nbnotes ,
            $noteglobale , $noteaccueil , $noteprix,
            $noteservice)
  {
    $this->id = $id ;
    $this->nom = $nom ;
    $this->marque = $marque ;
    $this->latitude = $latitude ;
    $this->longitude = $longitude ;
    $this->adresse = $adresse ;
    $this->cp = $cp ;
    $this->ville = $ville ;
    $this->nbnotes = $nbnotes ;
    $this->noteglobale = $noteglobale ;
    $this->noteaccueil = $noteaccueil ;
    $this->noteprix = $noteprix ;
    $this->noteservice = $noteservice ;
  }


}




 ?>
