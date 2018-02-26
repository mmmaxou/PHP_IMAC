<?php
require_once("Personne.class.php");
?>


<!DOCTYPE HTML>
<hmtl lang="fr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Personnes.td2.php</title>
  </head>

  <body>
    <h1>Testons la classe Personne</h1>
    <?php
        $max = new Personne("Max", "M.Imac", 21, "Noisiel");
        $nicolas = new Personne("Nicolas", "Seneschlague", 3.5, "Champs-sur-Marnes");
        $ph = new Personne("PASKALE", "ISSOU", 1000, "Champs-sur-Schlagues");
    
        $personnes = array($max, $nicolas, $ph);
        foreach($personnes as $personne) {
          $personne->afficher();
          echo "<br>";
        }
      ?>
      <p>Oups la question INTERACTION AVEC UN FORMULAIRE</p>
  </body>
</hmtl>
