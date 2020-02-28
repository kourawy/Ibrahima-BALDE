<?php
// auteur: Ibrahima BALDE

/**
 * Class that describes price of carburant
 */
class Prix
{
  private $idCarburant ;
  private $libelleCarburant ;
  private $valeur  = array() ;
  private $date ;

  public function __construct( $idCarburant , $libelleCarburant , $valeur , $date )
  {
    $this->idCarburant = $idCarburant ;
    $this->libelleCarburant = $libelleCarburant;
    $this->valeur[] = $valeur ;
    $this->date = $date ;
  }

  function getIdCarburant()
  {
    return $this->idCarburant ;
  }

  function getLibelleCarburant()
  {
    return $this->libelleCarburant ;
  }

  function getValeur()
  {
    return $this->valeur ;
  }

  function getDate()
  {
     return $this->date ;
  }
}




 ?>
