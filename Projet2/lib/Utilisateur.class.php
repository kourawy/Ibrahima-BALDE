<?php
// auteurs: Ibrahima BALDE 
/**
 *
 */
class Utilisateur
{
  public $pseudo ;
  public $mail ;
  public $ville ;
  public $description ;
  public $nbavis;
  public $total ;
  public $nbposts;
  public $nblike;
  public $nbnolike ;

  public function __construct( $pseudo , $mail , $ville ,
                        $description ,$nbavis ,$total ,
                        $nbposts ,$nblike ,$nbnolike )
  {
    $this->pseudo = $pseudo ;
    $this->mail = $mail ;
    $this->ville = $ville ;
    $this->description = $description ;
    $this->nbavis = $nbavis ;
    $this->total = $total ;
    $this->nbposts = $nbposts ;
    $this->nblike = $nblike ;
    $this->nbnolike = $nbnolike ;
  }
}




 ?>
