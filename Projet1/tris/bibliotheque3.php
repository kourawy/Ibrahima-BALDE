<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Bibliothèque</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="bibliotheque.css"/>
    </head>
    <body>
    	<header>
            <h2>
                <strong> Légende </strong>
                <span class = "science-fiction"> Science-fiction </span>
                <span class = "bandes-dessinées"> Bandes-dessinées </span>
                <span class = "fantasy"> Fantasy </span>
            </h2>
        </header>
        <section>
    	   <?php
    		  require_once("lib/fonctionsLivre.php");
          require_once("lib/fonctionsComparaison.php");

    		  $file = fopen("data/livres.txt", "r");
    		  $biblio = loadBiblio($file);
          try{
            $ordre = $_GET['ordre'];
            if(isset($ordre)){
              echo biblioToHTML($biblio, $ordre);
            }
            else{
              echo biblioToHTML($biblio);
            }
          }
          catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
          }
    	   ?>
        </section>
    </body>
</html>
