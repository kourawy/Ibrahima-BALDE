<?php
// auteur: Ibrahima BALDE
/**
 *
 */
class Post
{
  public $id ;
  public $auteur ;
  public $station ;
  public $titre ;
  public $contenu ;
  public $datecreation ;
  public $nblike ;
  public $nbnolike ;

  public function __construct($id , $auteur , $station ,$titre ,
                              $contenu , $datecreation , $nblike ,$nbnolike)
  {
    $this->id = $id ;
    $this->auteur = $auteur ;
    $this->station = $station ;
    $this->titre = $titre ;
    $this->contenu = $contenu ;
    $this->datecreation = $datecreation ;
    $this->nblike = $nblike ;
    $this->nbnolike = $nbnolike ;
  }
}





 ?>
