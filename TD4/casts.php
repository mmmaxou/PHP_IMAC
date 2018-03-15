<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Connexion to database */
require_once 'Classes/Cast.class.php';
require_once 'src/Style.php';

$fincher = Cast::createFromId(1);
//var_dump($fincher);

$cast = array();
$id = 1;
$cast = Cast::getAll();
?>

<h1>Movies</h1>
<h2>Cast List</h2>

<?php
echo "<ul>";
foreach( $cast as $c ) {
  echo "<li>";
  echo "<a href='cast.php?id=".$c->getId()."'>".$c->getFirstname()." ".$c->getLastname()."</a>";
  echo "</li>";
}
echo "</ul>";
?>

