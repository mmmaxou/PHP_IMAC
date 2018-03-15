<?php

function displayCastList($casts) {
  echo "<ul>";
  foreach( $casts as $c ) {
    echo "<li>";
    echo "<p><a href='cast.php?id=".$c->getId()."'>".$c->getFirstname()." ".$c->getLastname()."</a></p>";
    echo "</li>";
  }
  echo "</ul>";
}

function displayCast($c) {
  echo "<div><h4>".$c->getFirstname()." ".$c->getLastname()."</h4>";
  echo "<p>Born in ".$c->getBirthYear()."</p>";

  if ( $c->isAlive() == false ) {
    echo "<p>Died in ".$c->getDeathYear()."</p>";
  } else {
    echo "<p>And is still alive ... </p>";
  }
  echo "</div>";
}