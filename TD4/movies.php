<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Connexion to database */
require_once 'Classes/Movie.class.php';
require_once 'src/Style.php';

$movies = Movie::getAll();
?>

<h1>Movies</h1>
<h2>Movie List</h2>

<?php
echo "<ul>";
foreach( $movies as $m ) {
  echo "<li>";
  
  echo "<p><a href='movie.php?id=".$m->getId()."'>".$m->getTitle()." (".$m->getReleaseDate().")</a></p>";
  
  echo "</li>";
}
echo "</ul>";
?>

