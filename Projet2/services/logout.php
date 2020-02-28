<?php
// auteur: Ibrahima BALDE
set_include_path('..'.PATH_SEPARATOR);
spl_autoload_register(function ($className) {
     include ("lib/{$className}.class.php");
 });

 //require_once ('lib/watchdog_service.php');
 session_name('ibrahima_philippe') ;
 session_start() ;

 require_once ('lib/common_service.php');

 if (isset($_SESSION['identification'])) {
   $resultat = $_SESSION['identification'] ;
   unset($_SESSION['identification']) ;
   session_destroy() ;


 ?>
 <!DOCTYPE html>
 <html lang="fr" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <p>Vous êtes deconnecté</p>
     <?php
        produceResult($resultat) ;
        header('Location: ../index.php');
        exit() ;
      }
      else {
        produceError("Vous pouvez pas vous deconnecter sans etre connecter ") ;
      }
      ?>

   </body>
 </html>
