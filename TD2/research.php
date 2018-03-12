<?php

require_once("./data.movies.php");

function searchMovies($movies, $query) {
  var_dump($movies);
  
  $found = array();
  foreach($movies as $movie){
    $valid = true;
    if (!empty($query["title"])) {
      $valid = $query["title"] == $movie["title"] ? false : $valid;
    }
    if (!empty($query["genre"])) {
      $valid = $query["genre"] == $movie["genre"] ? false : $valid;
    }
    if (!empty($query["person"])) {
      $valid = $query["person"] == $movie["person"] ? false : $valid;
    }
    echo $valid;
  }
  
}

?>
