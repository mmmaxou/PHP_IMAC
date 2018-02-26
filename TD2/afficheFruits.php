<?php

if ( isset($_POST["fruits"])) {
  
  echo "J'adore les ";
  foreach ( $_POST["fruits"] as $fruit ) {
    echo $fruit.", ";
  }
  echo " mais je préfère la race.";
  
} else {
  echo "Je n'aime pas les fruits, sauf dans la race.";
}

?>
