<?php

function searchMovies($query, $movies) {
  
  if ( !empty($query["date"])) {
    $query_date = new DateTime($query["date"]);
  }
  
  $found = array();
  /* For each movie we check all the parameters of the query, and if atleast one is invalid, we don't send the movie. */
  foreach($movies as $movie){
    $valid = true;
    $empty = 0;
    
    /* Title checking */
    if (!empty($query["title"])) {
      $str1 = strtolower($movie["title"]);
      $str2 = strtolower($query["title"]);
      $valid = strpos($str1, $str2) !== false ? $valid : false;
    } else {
      $empty++;
    }
    
    /* Genre checking */
    if (!empty($query["genre"])) {
      /* Strategy : If there is atleast one genre that is the same as the movie, we accept it and therefore don't invalidate the movie */
      $genre_valid = false;
      foreach ($query["genre"] as $genre) {
         $genre_valid = $genre == $movie["genre"] ? true : $genre_valid;
      }
      $valid = $genre_valid ? $valid : false;
    } else {
      $empty++;
    }
    
    /* Person checking */
    if (!empty($query["director"])) {
      $str1 = strtolower($movie["director"]);
      $str2 = strtolower($query["director"]);
      $valid = strpos($str1, $str2) !== false ? $valid : false;
    } else {
      $empty++;
    }
    
    /* Date checking */
    if (!empty($query["date"])) {
      $movie_date = DateTime::createFromFormat("Y-m-d",$movie["releaseDate"]);
      $valid = $query_date < $movie_date ? $valid : false;
    } else {
      $empty++;
    }
    
    
    if ( $valid && $empty < 4 ) {
      $found[] = $movie;
    }
  }
  
  return $found;
  
}

?>
