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
          <input type="text" name="title" value="Fight Club" />
        </div>
        <div>
          <label for="date">Date</label>
          <input type="date" name="date" />
        </div>
        <div>
          <label for="genre">Genre</label>
          <input type="text" name="genre" />
        </div>
        <div>
          <label for="person">Personne du cast</label>
          <input type="text" name="person" />
        </div>
        <br>
        <button type="submit">Send</button>
      </form>
    </fieldset>
  </body>
</hmtl>
