<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Connexion to database */
require_once 'Classes/Movie.class.php';
require_once 'Classes/Cast.class.php';
require_once 'Views/Cast.view.php';
require_once 'Views/Menu.view.php';
require_once 'src/Style.php';

if( isset($_GET["id"]) ) {
  try {
    
    $m = Movie::createFromId($_GET["id"]);
    
    echo "<h1>".$m->getTitle()."</h1>";
    echo "<h3>Released in ".$m->getReleaseDate()."</h3>";
    
    $genres = $m->getGenres($_GET["id"]);
    echo "<h3>Genre(s) :</h3><ul>";
    foreach( $genres as $g ) {
      echo "<li>".$g->name."</li>";
    }
    echo "</ul>"; 
    
    $country = $m->getCountry($_GET["id"]);
    echo "<h3>Country :</h3><ul>";
    foreach( $country as $c ) {
      echo "<li>".$c->name."</li>";
    }
    echo "</ul>";
    
    $directors = Cast::getDirectorsFromMovieId($_GET["id"]);
    if ( !empty($directors) ) {
      echo "<h1>Director(s)</h1>";
      displayCastList($directors);
    }
    
    $actors = Cast::getActorsFromMovieId($_GET["id"]);
    if ( !empty($actors) ) {
      echo "<h1>Actor(s)</h1>";
      displayCastList($actors);
    }
    
  } catch (Exception $e) {
    echo "<h1>UNKNOW FILMMMMMM</h1>";
  }
} else {
  echo "<h1>UNKNOW FILMMMMMM</h1>";
}
?>

