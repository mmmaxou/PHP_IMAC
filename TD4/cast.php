<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Connexion to database */
require_once 'Classes/Cast.class.php';
require_once 'src/Style.php';

if( isset($_GET["id"]) ) {
  try {
    
    $c = Cast::createFromId($_GET["id"]);
    
    echo "<h1>".$c->getFirstname()." ".$c->getLastname()."</h1>";
    echo "<h3>Born in ".$c->getBirthYear()."</h3>";
    
    if ( $c->isAlive() == false ) {
      echo "<h3>Died in ".$c->getDeathYear()."</h3>";
    } else {
      echo "<h3>And is still alive ... </h3>";
    }
    
  } catch (Exception $e) {
    echo "<h1>UNKNOW BOOIIIII</h1>";
  }
} else {
  echo "<h1>UNKNOW BOOIIIII</h1>";
}
?>

