<?php

require_once("./research.php");

$title = isset($_GET["title"]) ? $_GET["title"] : "";
$date = isset($_GET["date"]) ? $_GET["date"] : "";
$genre = isset($_GET["genre"]) ? $_GET["genre"] : "";
$person = isset($_GET["person"]) ? $_GET["person"] : "";
$query = array(
  "title" => $title,
  "date" => $date,
  "genre" => $genre,
  "person" => $person
);
var_dump($query);
searchMovies($query);

?>
