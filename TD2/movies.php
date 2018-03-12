<?php

require_once("./research.php");
require_once("./data.movies.php");


$title = isset($_GET["title"]) ? $_GET["title"] : "";
$date = isset($_GET["date"]) ? $_GET["date"] : "";
$genre = isset($_GET["genre"]) ? $_GET["genre"] : "";
$director = isset($_GET["director"]) ? $_GET["director"] : "";
$query = array(
  "title" => $title,
  "date" => $date,
  "genre" => $genre,
  "director" => $director
);
$found = searchMovies($query, $movies);

function render_movie_list ( $movies, $genre, $nb_years) {
  $current_year = (int) date("Y");
  if ( empty($movies) ) {
    echo "<p class='warn'>Sorry, no movies found.</p>";
  } else {
    foreach ($movies as $movie) {

      $movie_year = new DateTime($movie["releaseDate"]);
      $movie_year = (int) $movie_year->format("Y");

      if ( $movie["genre"] == $genre ) {
        $class_genre = "red";
      } else {
        $class_genre = "";
      }
      if ( $current_year - $nb_years <= $movie_year ) {
        $class_year = "red";
      } else {
        $class_year = "";
      }



      echo <<<HTML
<li>$movie[title] ( <span class="$class_year">$movie_year</span> )
  <ul>
    <li>Genre : <span class="$class_genre">$movie[genre]</span></li>
    <li>Director : $movie[director]</li>
  </ul>
</li>
HTML;
    }
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

      .warn {
        color: orange;
        font-weight: bold;
      }

    </style>
  </head>

  <body>

    <h1>Movie List</h1>
    <ul>
      <?php 
      render_movie_list($found, "Science Fiction", 10);
      ?>
    </ul>

    <a href="./search.php">Retour</a>
  </body>

  </html>
