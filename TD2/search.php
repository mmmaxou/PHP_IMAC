<?php 
require_once("./data.movies.php");
?>


<!DOCTYPE HTML>
<hmtl lang="fr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FilRouge.td2.php</title>
  </head>

  <body>
    <h1>Je suis un film ... trouves moi ! :3</h1>
    <fieldset>
      <form action="./movies.php" method="get">
        <div>
          <label for="title">Titre</label>
          <input type="text" name="title" />
        </div>
        <div>
          <label for="date">Date</label>
          <input type="date" name="date" />
        </div>
        <ul>
          <?php foreach ($genres as $genre) {
            echo <<<HTML
<li>
  <label for="genre_$genre">$genre</label>
  <input type="checkbox" name="genre[]" value="$genre"" />
</li>
HTML;
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
  </body>
</hmtl>
