<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Connexion to database */
require_once 'Classes/Cast.class.php';
require_once 'src/Style.php';

$casts = Cast::getAll();
?>

<h1>Movies</h1>
<h2>Cast List</h2>

<?php
echo "<ul>";
foreach( $casts as $c ) {
  echo "<li>";
  echo "<p><a href='cast.php?id=".$c->getId()."'>".$c->getFirstname()." ".$c->getLastname()."</a></p>";
  echo "</li>";
}
echo "</ul>";
?>

