<?php

class Personne {
  
  private $prenom;
  private $nom;
  private $age;
  private $ville;
  
  public function __construct($prenom, $nom, $age, $ville) {
    $this->prenom = (string) $prenom;
    $this->nom = (string) $nom;
    $this->age = (int) $age;
    $this->ville = (string) $ville;
  }
  
  public function afficher() {
    echo "Bijour, je m'appelle ".$this->prenom." ".$this->nom.", j'habite à ".$this->ville.", j'ai ".$this->age." ans, et j'adore la race.";
  }
}

?>
