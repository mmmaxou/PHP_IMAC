<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Connexion to database */
require_once 'Classes/Cast.class.php';
require_once 'Classes/Movie.class.php';
require_once 'Views/Menu.view.php';
require_once 'Views/Cast.view.php';
require_once 'src/Style.php';

if( isset($_GET["id"]) ) {
  try {    
    $c = Cast::createFromId($_GET["id"]);
    displayCast($c);
    
    $moviesFromDirector = Movie::getFromDirectorId($_GET["id"]);
    if ( !empty($moviesFromDirector) ) {
      echo "<h1>Movies as Director</h1>";
      foreach( $moviesFromDirector as $m ) {
        echo "<p><a href='movie.php?id=".$m->getId()."'>".$m->getTitle()." ( ".$m->getReleaseDate()." )</a></p>";
      }
    }
    
    $moviesFromActor = Movie::getFromActorId($_GET["id"]);
    if ( !empty($moviesFromActor) ) {
      echo "<h1>Movies as Actor</h1>";
      foreach( $moviesFromActor as $m ) {
        echo "<p><a href='movie.php?id=".$m->getId()."'>".$m->getTitle()." ( ".$m->name." )</a></p>";
      }
    }
    
  } catch (Exception $e) {
    echo "Exception : $e";
    echo "<h1>UNKNOW BOOIIIII</h1>";
  }
} else {
  echo "<h1>UNKNOW BOOIIIII</h1>";
}
?>

