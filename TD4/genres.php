<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Connexion to database */
require_once 'Views/Menu.view.php';
require_once 'Classes/Genre.class.php';
require_once 'src/Style.php';

$genres = Genre::getAll();

echo "<h1>Genres :</h1>";
echo "<ul>";
foreach ( $genres as $g ) {
  echo "<li>".$g->getName()."</li>";
}
echo "</ul>";
?>

