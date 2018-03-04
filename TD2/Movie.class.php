<?php

class Movie {
  
  private $id;
  private $title;
  private $releaseDate;
  private $genre;
  private $director;
  
  public function __construct($title, $releaseDate, $genre, $director) {
    $this->title = (string) $title;
    $this->releaseDate = (string) $releaseDate;
    $this->genre = (int) $genre;
    $this->director = (string) $director;
  }
  
  public function renderHTML() {
    echo "<li>$this->title ( $this->releaseDate )
  <ul>
    <li>Genre : $this->genre</li>
    <li>Director : $this->director</li>
  </ul>
</li>";
  }
}

?>
