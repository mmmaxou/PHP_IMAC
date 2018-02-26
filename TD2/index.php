<?php

echo "Hello World <br>";
if ( isset($_GET["int"]) ){
  for ( $i=1; $i<=10; $i++ ) {
    echo $i."*".$_GET["int"]." = ".$i*$_GET["int"];
    echo "<br>";
  }
} 

?>
  <!DOCTYPE HTML>
  <hmtl lang="fr">

    <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Oups.td2.php</title>
    </head>

    <body>
      <h1>Formulaire 101</h1>
      <form action="./index.php" method="get">
        <input type="number" name="int" value=15>
        <button type="submit">Send</button>
      </form>
    </body>
  </hmtl>
