<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Connexion to database */
require_once 'Classes/Cast.class.php';
require_once 'Views/Cast.view.php';
require_once 'src/Style.php';

$casts = Cast::getAll();
?>

<h1>Movies</h1>
<h2>Cast List</h2>

<?php
  displayCastList($casts);
?>

