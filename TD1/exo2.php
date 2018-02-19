<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>HELLO WORLD en PHP</title>
  </head>
  <body>
    <?php 
    $prenom = "John";
    $nom = "Doe";
    $ville = "Champs-sur-schlague";
    $age = "1";

    $str = "<h1>Bonsoir, je m'appelle $prenom $nom, je viens de $ville et j'ai ". ($age == 1 ? $age." an" : $age." ans") . "</h1>";

    echo $str;

    $personne = [
      "prenom" => "Charles",
      "nom" => "de Beauregar",
      "ville" => "Richelieu",
      "age" => "23"
    ];

//    var_dump($personne);

    $str = "<h1>Bonsoir, je m'appelle $personne[prenom] $personne[nom], je viens de $personne[ville] et j'ai ". ($personne["age"] == 1 ? $personne["age"]." an" : $personne["age"]." ans") . " et j'adore le PHP <3</h1>";

    echo $str;
    
    $week = ["Lundi", "Mardi", "Mercredi", "Jeudimac", "VendRACEdi", "Race", "Recup"];
    
    foreach ($week as $day) {
      echo $day;
      echo '</br>';
    }
    
    ?>
  </body>
</html>