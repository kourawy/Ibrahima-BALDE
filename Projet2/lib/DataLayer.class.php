<?php
// auteur: Ibrahima BALDE
spl_autoload_register(function ($className) {
    include ("{$className}.class.php");
});
Class DataLayer{
    private $connexion;

    // établit la connexion à la base en utilisant les infos de connexion des constantes DB_DSN, DB_USER, DB_PASSWORD
    // susceptible de déclencher une PDOException
    public function __construct(){
            $this->connexion = new PDO(
                       DB_DSN, DB_USER, DB_PASSWORD,
                       [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,     // déclencher une exception en cas d'erreur
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // chaque ligne du résultat sera une table associative
                       ]
                     );

    }

/**
* Fonction d'authentification dans la base de données
*/
    function authentifier($pseudo , $password){
      // Requete de selection de la table
     $sql = <<<EOD
     select *
     from projet2.s8_users
     where pseudo=:pseudo
EOD;
     $stmt = $this->connexion->prepare($sql); // préparation de la requête
     $stmt->bindValue(':pseudo' , $pseudo) ;
     $stmt->execute();                        // exécution de la requête
     $res = $stmt->fetch();                // récupération de la table résultat

     if ($res && crypt($password , $res['password']) == $res['password'] ) {
       return $res['pseudo'] ;
     }
     else {
       return NULL ;
     }
 }
// Creation d'un utilisateur

 function createUser($pseudo , $password , $nom , $prenom ,
                     $mail , $ville)
  {
   // Requete pour creer la table
  $sql = <<<EOD
  Insert into projet2.s8_users (pseudo , password , nom , prenom , mail , ville)
  Values(:pseudo , :password , :nom , :prenom , :mail , :ville)
EOD;
  $stmt = $this->connexion->prepare($sql); // préparation de la requête
  $stmt->bindValue(':pseudo' , $pseudo) ;
  $stmt->bindValue(':password' , password_hash($password , CRYPT_BLOWFISH)) ;
  $stmt->bindValue(':nom' , $nom) ;
  $stmt->bindValue(':prenom' , $prenom) ;
  $stmt->bindValue(':mail' , $mail) ;
  $stmt->bindValue(':ville' , $ville) ;
  try {
    $stmt->execute();
    $vrai =  $stmt->rowCount()==1;
  } catch (\Exception $e) {
    return false ;
  }

  // on met les données dans la table Utilisateur
  if ($vrai) {
    $sql = <<<EOD
    Insert into projet2.utilisateur (pseudo , mail , ville , nbposts , nbavis , total , nblike , nbnolike)
    Values(:pseudo , :mail , :ville , 0 ,0 , 0 ,0 , 0)
EOD;
    $stmt = $this->connexion->prepare($sql); // préparation de la requête
    $stmt->bindValue(':pseudo' , $pseudo) ;
    $stmt->bindValue(':mail' , $mail) ;
    $stmt->bindValue(':ville' , $ville) ;
    try {
      $stmt->execute();
      return $stmt->rowCount()==1;
    } catch (\Exception $e) {
      return false ;
    }
  }


}

// Fonction qui permet de stocker l'avatar

function storeAvatar($fileDesc , $pseudo)
 {
  // Requete pour creer la table
 $sql = <<<EOD
 Update  projet2.utilisateur
 Set (mimetype,avatar) = (:mimetype , :avatar)
 Where pseudo=:pseudo
EOD;
 $stmt = $this->connexion->prepare($sql); // préparation de la requête
 $stmt->bindValue(':pseudo' , $pseudo) ;
 $stmt->bindValue(':mimetype' , $fileDesc['mimetype']) ;
 $stmt->bindValue(':avatar' , $fileDesc['data'] , PDO::PARAM_LOB) ;

 try {
   $stmt->execute();
   return $stmt->rowCount()==1;
 } catch (\Exception $e) {
   return false ;
 }

}

function getAvatar( $pseudo)
 {
  // Requete pour creer la table
 $sql = <<<EOD
 Select mimetype , avatar
 From  projet2.utilisateur
 Where pseudo=:pseudo
EOD;
 $stmt = $this->connexion->prepare($sql); // préparation de la requête
 $stmt->bindValue(':pseudo' , $pseudo) ;
 $stmt->bindValue(':mimetype' , $mimeType) ;
 $stmt->bindValue(':avatar' , $flow , PDO::PARAM_LOB) ;

 try {
   $stmt->execute();
   $res = $stmt->fetch();
   if ($res) {
     return ['mimetype' => $mimeType , 'data' =>$flow] ;
   }
   else {
     return false ;
   }
 } catch (\Exception $e) {
   return false ;
 }

}

/* Fonction qui permet de trouver un utilisateur en donnant
 *en paramètre son pseudo et elle retourne l'utilisateur
*/
function getFindUtilisateur( $pseudo)
 {
  // Requete pour recuperer les infos du profil
 $sql = <<<EOD
 Select pseudo , mail , ville , description ,
        nbavis , total , nbposts , nblike , nbnolike
 From  projet2.utilisateur
 Where pseudo=:pseudo
EOD;
 $stmt = $this->connexion->prepare($sql); // préparation de la requête
 $stmt->bindValue(':pseudo' , $pseudo) ;
 $stmt->execute();
 $res = $stmt->fetch();
 if ($res) {
     $pseudo = $res['pseudo'] ;
     $mail = $res['mail'] ;
     $ville = $res['ville'] ;
     $description = $res['description'] ;
     $nbposts = $res['nbposts'] ;
     $nbavis = $res['nbavis'] ;
     $total = $res['total'] ;
     $nblike = $res['nblike'] ;
     $nbnolike = $res['nbnolike'] ;
     return new Utilisateur($pseudo , $mail ,$ville , $description,
                             $nbavis ,$total , $nbposts  , $nblike,
                            $nbnolike) ;
  }
  else {
     return false ;
  }

 }

 /**
 *function qui donne les 10 meilleurs stations
 */
 function getBestStations( )
  {
   // Requete pour recuperer les infos du profil
  $sql = <<<EOD
  SELECT *
  FROM projet2.stationsp2
  Where noteglobale!=0
  Order By noteglobale desc
  Limit 10
EOD;
  $stmt = $this->connexion->prepare($sql); // préparation de la requête
  $stmt->execute();
  $res = $stmt->fetch();
  if ($res) {
    $tab = [] ;
    while ($res) {
      $id = $res['id'] ;
      $marque = $res['marque'] ;
      $nom = $res['nom'] ;
      $latitude = $res['latitude'] ;
      $longitude = $res['longitude'] ;
      $adresse = $res['adresse'] ;
      $ville = $res['ville'] ;
      $cp = $res['cp'] ;
      $nbnotes = $res['nbnotes'] ;
      $noteglobale = $res['noteglobale'] ;
      $noteaccueil = $res['noteaccueil'] ;
      $noteprix = $res['noteprix'] ;
      $noteservice = $res['noteservice'] ;
      $tab[] = new Station($id  , $marque , $nom ,$latitude,
                $longitude , $cp , $ville , $nbnotes ,
                $noteglobale , $noteaccueil , $noteprix,
                $noteservice) ;
      $res = $stmt->fetch();
    }
    return $tab ;
  }


   else {
      return false ;
   }

  }
/**
* Fonction qui nous donne une station
* @param id l'identifiant de la station
*@return Station elle renvoie la station concernee
*/
function getStation($id){
    // Requete pour recuperer les infos du profil
   $sql = <<<EOD
   SELECT *
   FROM projet2.stationsp2
   Where id=:id
EOD;
   $stmt = $this->connexion->prepare($sql); // préparation de la requête
   $stmt->bindValue(':id' , $id) ;
   $stmt->execute();
   $res = $stmt->fetch();
   if ($res) {
       $id = $res['id'] ;
       $marque = $res['marque'] ;
       $nom = $res['nom'] ;
       $latitude = $res['latitude'] ;
       $longitude = $res['longitude'] ;
       $adresse = $res['adresse'] ;
       $ville = $res['ville'] ;
       $cp = $res['cp'] ;
       $nbnotes = $res['nbnotes'] ;
       $noteglobale = $res['noteglobale'] ;
       $noteaccueil = $res['noteaccueil'] ;
       $noteprix = $res['noteprix'] ;
       $noteservice = $res['noteservice'] ;

       return new Station($id  , $marque , $nom ,$latitude,
                 $longitude , $cp , $ville , $nbnotes ,
                 $noteglobale , $noteaccueil , $noteprix,
                 $noteservice) ;
   }
    else {
       return false ;
    }

   }
   /**
   * Fonction qui nous donne tous les posts d'une station donnée
   *@param $id l'identifiant de la station
   *@return array un tableau de post
   */
   function getPosts($id){
       // Requete pour recuperer les posts
      $sql = <<<EOD
      SELECT *
      FROM projet2.post
      Where station=:id
EOD;
      $stmt = $this->connexion->prepare($sql); // préparation de la requête
      $stmt->bindValue(':id' , $id) ;
      $stmt->execute();
      $res = $stmt->fetch();
      if ($res) {
        $tab = [] ;
        while ($res) {
          $id = $res['id'] ;
          $auteur = $res['auteur'] ;
          $station = $res['station'] ;
          $titre = $res['titre'] ;
          $contenu = $res['contenu'] ;
          $datecreation = $res['datecreation'] ;

          $tab[] = new Post($id , $auteur , $station ,$titre ,
                          $contenu , $datecreation , $nblike ,$nbnolike) ;
          $res = $stmt->fetch();
        }
        return $tab ;
      }
      else {
          return false ;
       }

     }
     /**
     * Fonction qui renvoie tous les posts de l'Utilisateur
     *@param $auteur le login de l'Utilisateur
     *@return array un tableau d'objet
     */
     function getMesPosts($auteur){
         // Requete pour recuperer les infos du profil
        $sql = <<<EOD
        SELECT *
        FROM projet2.post
        Where auteur=:auteur
        Order By datecreation desc
EOD;
        $stmt = $this->connexion->prepare($sql); // préparation de la requête
        $stmt->bindValue(':auteur' , $auteur) ;
        $stmt->execute();
        $res = $stmt->fetch();
        if ($res) {
          $tab = [] ;
          while ($res) {
            $id = $res['id'] ;
            $auteur = $res['auteur'] ;
            $station = $res['station'] ;
            $titre = $res['titre'] ;
            $contenu = $res['contenu'] ;
            $datecreation = $res['datecreation'] ;

            $tab[] = new Post($id , $auteur , $station ,$titre ,
                            $contenu , $datecreation , $nblike ,$nbnolike) ;
            $res = $stmt->fetch();
          }
          return $tab ;
        }
        else {
            return false ;
         }

       }

      /**
      * Function qui permet à un utilisateur de noter une station
      *
      */
      function memberNoteStation($login , $id , $noteglobale , $noteaccueil ,
                                 $noteprix , $noteservice){
           // On change d'abord les valeurs concernées dans station
          $sql = <<<EOD
          UPDATE projet2.stationsp2
          SET noteglobale =:noteglobale,
              noteaccueil =:noteaccueil,
              noteprix =:noteprix,
              noteservice=:noteservice ,
              nbnotes=nbnotes+1
          WHERE id=:id
EOD;
          $stmt = $this->connexion->prepare($sql); // préparation de la requête
          $stmt->bindValue(':id' , $id) ;
          $stmt->bindValue(':noteglobale' , $noteglobale) ;
          $stmt->bindValue(':noteaccueil' , $noteaccueil) ;
          $stmt->bindValue(':noteprix' , $noteprix) ;
          $stmt->bindValue(':noteservice' , $noteservice) ;
          try {
            $stmt->execute();
            $somme = $noteglobale+$noteaccueil+$noteprix+$noteservice;
            $passed = true ;

          } catch (\Exception $e) {
            return false ;
          }


          if ($passed) {
            // On modifie le nombre d'avis et le total de l'utilisateur
          $sql = <<<EOD
          UPDATE projet2.utilisateur
          SET nbavis=nbavis+1 , total=total+:tot
          WHERE pseudo=:pseudo
EOD;
          $stmt = $this->connexion->prepare($sql); // préparation de la requête
          $stmt->bindValue(':tot' , $somme) ;
          $stmt->bindValue(':pseudo' , $login) ;

          try {
            $stmt->execute();
            $passed = true ;
          } catch (\Exception $e) {
            return false ;
          }
          }
          //var_dump($passed) ;


          if ($passed) {
            // Requete pour afficher la station donnée
           $sql2 = <<<EOD
           Select *
           From projet2.stationsp2
           WHERE id=:id
EOD;
           $stmt = $this->connexion->prepare($sql2); // préparation de la requête
           $stmt->bindValue(':id' , $id) ;
           $stmt->execute();
           $res = $stmt->fetch();
          //var_dump($res);
          if ($res) {
              $id = $res['id'] ;
              $marque = $res['marque'] ;
              $nom = $res['nom'] ;
              $latitude = $res['latitude'] ;
              $longitude = $res['longitude'] ;
              $adresse = $res['adresse'] ;
              $ville = $res['ville'] ;
              $cp = $res['cp'] ;
              $nbnotes = $res['nbnotes'] ;
              $noteglobale = $res['noteglobale'] ;
              $noteaccueil = $res['noteaccueil'] ;
              $noteprix = $res['noteprix'] ;
              $noteservice = $res['noteservice'] ;

              return new Station($id  , $marque , $nom ,$latitude,
                        $longitude , $cp , $ville , $nbnotes ,
                        $noteglobale , $noteaccueil , $noteprix,
                        $noteservice) ;
          }
           else {
              return false ;
           }
         }
         else {
           return false ;
         }

         }

    function createPost($auteur , $station ,$titre , $contenu , $date){

          $sql = <<<EOD
          Insert into projet2.post (auteur , station , titre , contenu , nblike , nbnolike , datecreation)
          Values(:auteur , :station , :titre , :contenu , 0 , 0 , Now())
EOD;
          $stmt = $this->connexion->prepare($sql); // préparation de la requête
          $stmt->bindValue(':auteur' , $auteur) ;
          $stmt->bindValue(':station' , $station) ;
          $stmt->bindValue(':titre' , $titre) ;
          $stmt->bindValue(':contenu' , $contenu) ;
          try {
            $stmt->execute();
            $res = true ;
          } catch (\Exception $e) {
            return false ;
          }



          if ($res ) {
            $sql2 = "
            UPDATE projet2.utilisateur
            SET nbposts=nbposts+1
            WHERE pseudo=:auteur ";

            $stmt = $this->connexion->prepare($sql2);
            $stmt->bindValue(':auteur' , $auteur) ;
            try {
              $stmt->execute();
              $res = true ;

            } catch (\Exception $e) {
              return false ;
            }

            if ($res) {
              $sql3 = <<<EOD
              Select id FROM projet2.post
              WHERE ((auteur=:auteur) and (station=:station) and (titre=:titre))
EOD;
              $stmt = $this->connexion->prepare($sql3); // préparation de la requête
              $stmt->bindValue(':auteur' , $auteur) ;
              $stmt->bindValue(':station' , $station) ;
              $stmt->bindValue(':titre' , $titre) ;

              try {
                $stmt->execute();
                $res = $stmt->fetch();
                return $res['id'] ;

              } catch (\Exception $e) {
                return false ;

              }

            }else {
              return false ;
            }

          }
          else {
            return NULL ;
          }
      }

      function deletePost($id , $auteur){
             // Requete de selection de la table
            $sql = <<<EOD
            Select id
            From projet2.post
            Where id=:id and auteur=:auteur
EOD;
            $stmt = $this->connexion->prepare($sql); // préparation de la requête
            $stmt->bindValue(':id' , $id) ;
            $stmt->bindValue(':auteur' , $auteur) ;
            $stmt->execute();
            $res = $stmt->fetch();

            if ($res ) {
              $identifiant =  $res['id'] ;
            }
            else {
              return NULL ;
            }
            $sql = <<<EOD
            Delete
            From projet2.post
            Where id=:id and auteur=:auteur
EOD;
            $stmt = $this->connexion->prepare($sql); // préparation de la requête
            $stmt->bindValue(':id' , $id) ;
            $stmt->bindValue(':auteur' , $auteur) ;
            try {
              $stmt->execute();                        // exécution de la requête
              $res = true ;
            } catch (\Exception $e) {
              return false;
            }
            if ($res) {
              $sql2 = "
              UPDATE projet2.utilisateur
              SET nbposts=nbposts-1
              WHERE pseudo=:auteur ";

              $stmt = $this->connexion->prepare($sql2);
              $stmt->bindValue(':auteur' , $auteur) ;
              try {
                $stmt->execute();
                return $identifiant ;
              } catch (\Exception $e) {
                return false ;
              }

            }
            else {
              return NULL ;
            }

        }





        function notePost($id , $avis){
             // Requete pour modifier un post
            $sql = <<<EOD
            Select auteur
            From projet2.post
            WHERE id=:id
EOD;
            $stmt = $this->connexion->prepare($sql); // préparation de la requête
            $stmt->bindValue(':id' , $id) ;
            try {
              $stmt->execute();
              $res = $stmt->fetch();
              $passed =  $stmt->rowCount()==1;
            } catch (\Exception $e) {
              return false ;
            }

            // Si on selectionne l'id
            if ($passed) {
              // Requete pour ajouter les likes de l'utilisateur
              if ($avis ==='like') {
                $sql2 = <<<EOD
                UPDATE projet2.utilisateur
                SET nblike=nblike+1
                WHERE pseudo=:auteur
EOD;
              }
              elseif ($avis ==='nolike')
              {
                $sql2 = <<<EOD
                UPDATE projet2.utilisateur
                SET nbnolike=nbnolike+1
                WHERE pseudo=:auteur
EOD;
              }
              else {
                return false ;
              }

             $stmt = $this->connexion->prepare($sql2); // préparation de la requête
             $stmt->bindValue(':auteur' , $res['auteur']) ;
             try {
               $stmt->execute();
               //echo " test sql2";
             } catch (\Exception $e) {
               return NULL;
             }

             // Ajouter les likes du post
             if ($avis ==='like') {
               $sql3 = <<<EOD
               UPDATE projet2.post
               SET nblike=nblike+1
               WHERE id=:id
EOD;
             }
             elseif($avis ==='nolike') {
               $sql3 = <<<EOD
               UPDATE projet2.post
               SET nbnolike=nbnolike+1
               WHERE id=:id
EOD;
             }
             $stmt = $this->connexion->prepare($sql3); // préparation de la requête
             $stmt->bindValue(':id' , $id) ;
             try {
               $stmt->execute();
               $passed = true ;

             }
            catch (\Exception $e) {
             return NULL;
           }
           // affichage du post modifié
           if ($passed) {
             $sql4 = <<<EOD
             SELECT *
             FROM projet2.post
             Where id=:id
EOD;
             $stmt = $this->connexion->prepare($sql4); // préparation de la requête
             $stmt->bindValue(':id' , $id) ;
             $stmt->execute();
             $res = $stmt->fetch();
             //var_dump($res) ;
             if ($res) {
                 $id = $res['id'] ;
                 $auteur = $res['auteur'] ;
                 $station = $res['station'] ;
                 $titre = $res['titre'] ;
                 $contenu = $res['contenu'] ;
                 $datecreation = $res['datecreation'] ;
                 $nblike = $res['nblike'] ;
                 $nbnolike = $res['nbnolike'] ;
                 //echo "$id $auteur $station $titre $contenu $datecreation $nblike $nbnolike";
                 return new Post($id , $auteur , $station ,$titre ,
                                 $contenu , $datecreation , $nblike ,$nbnolike) ;
           }else {
             return false ;
           }

        }else {
           return false ;
        }

      }else {
        return false ;
      }
    }

      function getAdditionalInfo($id){

      $stmt = $this->connexion->prepare("select marque , nom , adresse , ville , cp  from projet2.stationsp2  where id=:id ;") ;
      $stmt->bindValue(':id' , $id) ;
      try{
      $stmt->execute() ;
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    catch(PDOException $e){
      return FALSE ;

    }
  }

  function updateProfil($pseudo ,$mail , $description , $ville ,$password){
         // Requete de selection de la table
        $sql = <<<EOD
        UPDATE projet2.s8_users
        SET mail=:mail,
            ville=:ville ,
            password=:password
        WHERE pseudo=:pseudo
EOD;
        $stmt = $this->connexion->prepare($sql); // préparation de la requête
        $stmt->bindValue(':mail' , $mail) ;
        $stmt->bindValue(':ville' , $ville) ;
        $stmt->bindValue(':password' , password_hash($password , CRYPT_BLOWFISH)) ;
        $stmt->bindValue(':pseudo' , $pseudo) ;
        try {
          $stmt->execute();
          $res = true ;
          //echo "sql1 ";
        } catch (\Exception $e) {
          //echo "sql1 error ";
          return NULL;
        }

        if ($res ) {
          $sql2 = <<<EOD
          UPDATE projet2.utilisateur
          SET mail=:mail,
              description=:description,
              ville=:ville
          WHERE pseudo=:pseudo
EOD;
          $stmt = $this->connexion->prepare($sql2); // préparation de la requête
          $stmt->bindValue(':mail' , $mail) ;
          $stmt->bindValue(':description' , $description) ;
          $stmt->bindValue(':ville' , $ville) ;
          $stmt->bindValue(':pseudo' , $pseudo) ;
          try {
            $stmt->execute();
            $res = true ;
            //echo " sql 2 ";
          } catch (\Exception $e) {
            //echo "sql 2 error";
            return NULL;
          }

          // Affichage du nouveau profil
          if ($res) {
            $sql4 = <<<EOD
            Select pseudo , mail , ville , description ,
                   nbavis , total , nbposts , nblike , nbnolike
            From  projet2.utilisateur
            Where pseudo=:pseudo
EOD;
            $stmt = $this->connexion->prepare($sql4); // préparation de la requête
            $stmt->bindValue(':pseudo' , $pseudo) ;
            $stmt->execute();
            $res = $stmt->fetch();
            //echo "sql 3 ";
            if ($res) {
                $pseudo = $res['pseudo'] ;
                $mail = $res['mail'] ;
                $ville = $res['ville'] ;
                $description = $res['description'] ;
                $nbposts = $res['nbposts'] ;
                $nbavis = $res['nbavis'] ;
                $total = $res['total'] ;
                $nblike = $res['nblike'] ;
                $nbnolike = $res['nbnolike'] ;
                return new Utilisateur($pseudo , $mail ,$ville , $description,
                                        $nbavis ,$total , $nbposts  , $nblike,
                                       $nbnolike) ;
             }
             else {
                return false ;
             }
          }else {
            return false ;
          }
        }
        else {
          return NULL ;
        }





    }



  }



 ?>
