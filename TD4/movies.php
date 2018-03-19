<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Connexion to database */
require_once 'Classes/Movie.class.php';
require_once 'Classes/Genre.class.php';
require_once 'Views/Menu.view.php';
require_once 'src/Style.php';

if ( isset($_GET["query"])) {
  $movies = Movie::getAllFiltered();
} else {
  $movies = Movie::getAll();
}
$genres = Genre::getAll();
?>

<h1>Movies</h1>
<h2>Movie List</h2>

<?php
if (!empty($movies)) {
  echo "<ul>";
  foreach( $movies as $m ) {
    echo "<li>";

    echo "<p><a href='movie.php?id=".$m->getId()."'>".$m->getTitle()." (".$m->getReleaseDate().")</a></p>";

    echo "</li>";
  }
  echo "</ul>";
} else {
  echo "<h1> > Nothing found < </h1>";
}
?>

 <h1>Je suis un film ... trouves moi ! :3</h1>
    <fieldset>
      <form action="./movies.php" method="get">
        <div>
         <input type="hidden" value=true name="query" />
          <label for="title">Titre</label>
          <input type="text" name="title" />
        </div>
        <div>
          <label for="date">Date</label>
          <input type="date" name="date" />
        </div>
        <ul>
          <?php foreach ($genres as $g) {
            echo "<li>";
            echo "<label for='genre_".$g->getId()."'>".$g->getName()."</label>";
            echo "<input type='checkbox' name='genre[]' value='".$g->getName()."' />";
            echo "</li>";
          } ?>
        </ul>
        <div>
          <label for="director">Directeur</label>
          <input type="text" name="director" />
        </div>
        <br>
        <button type="submit">Send</button>
      </form>
    </fieldset>