<?php 
require_once("./Movie.class.php");
require_once("./data.movies.php");

if ( isset($_GET["id"])) {
  foreach ($movies as $movie) {
    if ($movie["id"] == $_GET["id"] ) {
      $page_movie = new Movie(
        $movie["title"],
        $movie["releaseDate"],
        $movie["genre"],
        $movie["director"]);
    } 
  }
}
?>
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

  <h1>Movie</h1>
  <ul>
    <?php 
    if ( isset($page_movie)) {
      $page_movie->renderHTML();
    } else {
      echo "Please enter a movie ID in the Url :3";
    }
    ?>
  </ul>

  <a href="./search.php">Retour</a>
</body>

</html>
