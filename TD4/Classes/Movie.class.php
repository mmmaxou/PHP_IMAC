<?php
require_once 'MyPDO.mpluchar_db.include.php'; 

/**
 * Classe Movie
 */
class Movie {

	/***********************ATTRIBUTS***********************/
	
	// Identifiant
	private $id = null;
	// Titre
	private $title = null;
	// Date de sortie
	private $releaseDate = null;
	//Identifiant du pays
	private $idCountry = null;

	/*********************CONSTRUCTEURS*********************/
	
	// Constructeur non accessible
	function __construct() {}

	/**
	 * Usine pour fabriquer une instance de Movie à partir d'un id (via la bdd)
	 * @param int $id identifiant du film à créer (bdd)
	 * @return Movie instance correspondant à $id
	 * @throws Exception s'il n'existe pas cet $id dans a bdd
	 */
	public static function createFromId($id){
    $query = "SELECT * FROM Movie WHERE id=:id";
    $stmt = MyPDO::getInstance()->prepare($query);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Movie");
    if (($object = $stmt->fetch()) !== false) {
      return $object;
    } else {
      throw new Exception("Erreur creation d'instance");
    }
	}

	/********************GETTERS SIMPLES********************/
	
	/**
	 * Getter sur l'identifiant
	 * @return int $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Getter sur le titre
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Getter sur la date de sortie
	 * @return string $releaseDate
	 */
	public function getReleaseDate() {
		return $this->releaseDate;
	}

	/**
	 * Getter sur l'identifiant du pays
	 * @return string $idCountry
	 */
	public function getIdCountry() {
		return $this->idCountry;
	}

	/*******************GETTERS COMPLEXES*******************/

	/**
	 * Récupère tous les enregistrements de la table Movie de la bdd
	 * Tri par ordre décroissant sur la date de sortie
	 * puis par ordre alphabétique sur le titre
	 * @return array<Movie> liste d'instances de Movie
	 */
	public static function getAll() {
    $query = "SELECT * FROM Movie ORDER BY releaseDate DESC, title ASC";
    $stmt = MyPDO::getInstance()->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Movie");
    if (($object = $stmt->fetchAll()) !== false) {
      return $object;
    } else {
      throw new Exception("Erreur creation d'instance");
    }
	}
  
	/**
	 * Récupère les enregistrements de la table Movie de la bdd
   * Dont les champs correspondent à la recherche
	 * Tri par ordre décroissant sur la date de sortie
	 * puis par ordre alphabétique sur le titre
	 * @return array<Movie> liste d'instances de Movie
	 */
	public static function getAllFiltered() {
    $and = false;
    $where = false;
    $query = "SELECT DISTINCT * FROM Movie
              INNER JOIN MovieGenre ON Movie.id = MovieGenre.idMovie
              INNER JOIN Genre ON Genre.id = MovieGenre.idGenre
              INNER JOIN Country ON Movie.idCountry = Country.code
              INNER JOIN Director ON Movie.id = Director.idMovie
              INNER JOIN Cast ON Cast.id = Director.idDirector
              ";
  
    if (!empty($_GET["date"])) {
      $date = $_GET["date"];
      if ( !$where ) { 
        $query .= " WHERE ";
        $where = true;
      }
      $query .= "YEAR(Movie.releaseDate) = :date";
      $and = true;
    }

    if (!empty($_GET["title"])) {
      $title = strtolower($_GET["title"]);
      if ( !$where ) { 
        $query .= " WHERE ";
        $where = true;
      }
      if ( $and ) $query .= " AND ";
      $query .= "Movie.title LIKE :title";
      $and = true;
    }

    if (!empty($_GET["genre"])) {
      if ( !$where ) { 
        $query .= " WHERE ";
        $where = true;
      }
      if ( $and ) $query .= " AND ";
      $query .= "Genre.name IN (''";
      foreach($_GET["genre"] as $g) {
        $query .= ",'".$g."'";
      }
      $query .= ")";
      $and = true;
    }

    /* Person checking */
    if (!empty($_GET["director"])) {
      $director = strtolower($_GET["director"]);
      if ( !$where ) { 
        $query .= " WHERE ";
        $where = true;
      }
      if ( $and ) $query .= " AND ";
      $query .= "LOWER(CONCAT(firstname, ' ', lastname)) LIKE :director";
      $and = true;
    }    
    
    $stmt = MyPDO::getInstance()->prepare($query);
    
    if (isset($date)) $stmt->bindValue(":date", $date);
    if (isset($title)) $stmt->bindValue(":title", "%".$title."%");
    if (isset($director)) $stmt->bindValue(":director", "%".$director."%");
    
    $query .= " GROUP BY Movie.title, Cast.id, Genre.id";
    
    echo "<pre>";
    echo $query;
    echo "</pre>";
    
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Movie");
    if (($object = $stmt->fetchAll()) !== false) {
      return $object;
    } else {
      throw new Exception("Erreur creation d'instance");
    }
	}

	/**
	 * Récupère tous les films du réalisateur/de la réalisatrice
	 * Tri par ordre décroissant sur la date de sortie
	 * puis par ordre alphabétique sur le titre sur le titre
	 * @param int $idDirector identifiant du réalisateur/de la réalisatrice
	 * @return array<Movie> liste d'instances de Movie
	 */
	public static function getFromDirectorId($idDirector){
    $query = "SELECT Movie.id, title, releaseDate FROM Movie
              JOIN Director ON Movie.id = Director.idMovie
              JOIN Cast ON Cast.id = Director.idDirector
              WHERE idDirector = :idDirector
              ORDER BY releaseDate DESC, title ASC";
    $stmt = MyPDO::getInstance()->prepare($query);
    $stmt->bindValue(":idDirector", $idDirector);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Movie");
    if (($object = $stmt->fetchAll()) !== false) {
      return $object;
    } else {
      throw new Exception("Erreur creation d'instance");
    }    
  }

	/**
	 * Récupère tous les films de l'act.eur.rice avec son rôle pour chaque
	 * Tri par ordre décroissant sur la date de sortie
	 * puis dans l'ordre alphabétique sur le titre
	 * @param int $idActor identifiant l'act.eur.rice
	 * @return array<Movie> liste d'instances de Movie
	 */
	public static function getFromActorId($idActor){
    $query = "SELECT Movie.id, title, name FROM Movie
              JOIN Actor ON Movie.id = Actor.idMovie
              JOIN Cast ON Cast.id = Actor.idActor
              WHERE idActor = :idActor
              ORDER BY releaseDate DESC, title ASC";
    $stmt = MyPDO::getInstance()->prepare($query);
    $stmt->bindValue(":idActor", $idActor);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Movie");
    if (($object = $stmt->fetchAll()) !== false) {
      return $object;
    } else {
      throw new Exception("Erreur creation d'instance");
    }    
	}

	/**
	 * Récupère les genres du film courant ($this)
	 * Tri par ordre alphabétique
	 * @return array<Genre> liste d'instances de Genre
	 */
	public function getGenres() {
    $query = "SELECT Genre.* FROM Movie
              JOIN MovieGenre ON Movie.id = MovieGenre.idMovie
              JOIN Genre ON Genre.id = MovieGenre.idGenre
              WHERE idMovie = :idMovie
              ORDER BY releaseDate DESC, title ASC";
    $stmt = MyPDO::getInstance()->prepare($query);
    $stmt->bindValue(":idMovie", $this->id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Movie");
    if (($object = $stmt->fetchAll()) !== false) {
      return $object;
    } else {
      throw new Exception("Erreur creation d'instance");
    }  
	}

	/**
	 * Récupère les pays du film courant ($this)
	 * Tri par ordre alphabétique
	 * @return array<Country> liste d'instances de Genre
	 */
	public function getCountry() {
    $query = "SELECT Country.* FROM Movie
              JOIN Country ON Movie.idCountry = Country.code
              WHERE Movie.id = :idMovie";
    $stmt = MyPDO::getInstance()->prepare($query);
    $stmt->bindValue(":idMovie", $this->id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Movie");
    if (($object = $stmt->fetchAll()) !== false) {
      return $object;
    } else {
      throw new Exception("Erreur creation d'instance");
    }  
	}
}
