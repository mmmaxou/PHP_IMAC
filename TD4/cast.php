<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Connexion to database */
require_once 'Classes/Cast.class.php';
require_once 'Views/Cast.view.php';
require_once 'src/Style.php';

if( isset($_GET["id"]) ) {
  try {
    
    $c = Cast::createFromId($_GET["id"]);
    displayCast($c);
    
  } catch (Exception $e) {
    echo "<h1>UNKNOW BOOIIIII</h1>";
  }
} else {
  echo "<h1>UNKNOW BOOIIIII</h1>";
}
?>

