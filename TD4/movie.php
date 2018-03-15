<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Connexion to database */
require_once 'Classes/Movie.class.php';
require_once 'src/Style.php';

if( isset($_GET["id"]) ) {
  try {
    
    $m = Movie::createFromId($_GET["id"]);
    
    echo "<h1>".$m->getTitle()."</h1>";
    echo "<h3>Released in ".$m->getReleaseDate()."</h3>";
    
  } catch (Exception $e) {
    echo "<h1>UNKNOW FILMMMMMM</h1>";
  }
} else {
  echo "<h1>UNKNOW FILMMMMMM</h1>";
}
?>

