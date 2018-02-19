<?php  
require_once("data.movies.php");
date_default_timezone_set('Europe/Paris');
function render_movie_list ( $movies, $genre, $nb_years) {
  $current_year = (int) date("Y");
  foreach ($movies as $movie) {
    if ( $movie["genre"] == $genre ) {
      $class_genre = "red";
    } else {
      $class_genre = "";
    }
    if ( $current_year - $nb_years <= $movie["year"] ) {
      $class_year = "red";
    } else {
      $class_year = "";
    }



    echo <<<HTML
<li>$movie[title] ( <span class="$class_year">$movie[year]</span> )
  <ul>
    <li>Genre : <span class="$class_genre">$movie[genre]</span></li>
    <li>Director : $movie[director]</li>
  </ul>
</li>
HTML;
  } 
}
?>



<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Le Fil ROUGE</title>
    <style>
      .red {
        color: red;
        font-weight: bold;
      }
    </style>
  </head>
  <body>

    <h1>Movie List</h1>
    <ul>
      <?php 
      render_movie_list($movies, "Science Fiction", 10);
      ?>
    </ul>

  </body>
</html>
