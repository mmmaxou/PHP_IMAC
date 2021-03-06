<?php
require_once 'MyPDO.mpluchar_db.include.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Classe Genre
 */
class Genre {

	/***********************ATTRIBUTS***********************/
	
	// Identifiant
	private $id = null;
	// Nom
	private $name = null;


	/*********************CONSTRUCTEURS*********************/
	
	// Constructeur non accessible
	function __construct() {}

	/**
	 * Usine pour fabriquer une instance de Genre à partir d'un id (via la bdd)
	 * @param int $id identifiant du genre à créer (bdd)
	 * @return Genre instance correspondant à $id
	 * @throws Exception s'il n'existe pas cet $id dans a bdd
	 */
	public static function createFromId($id){
    $query = "SELECT * FROM Genre WHERE id=:id";
    $stmt = MyPDO::getInstance()->prepare($query);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Genre");
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
	 * Getter sur le nom
	 * @return string $name
	 */
	public function getName() {
    return $this->name;
	}

	/*******************GETTERS COMPLEXES*******************/

	/**
	 * Récupère tous les enregistrements de la table Genre de la bdd
	 * qui ont au moins un film associé au genre
	 * Tri par ordre alphabétique
	 * @return array<Genre> liste d'instances de Genre
	 */
	public static function getAll() {
    $query = "SELECT * FROM Movie
              INNER JOIN MovieGenre ON MovieGenre.idMovie = Movie.id
              INNER JOIN Genre ON MovieGenre.idGenre = Genre.id
              GROUP BY Genre.name
              ORDER BY name ASC";
    $stmt = MyPDO::getInstance()->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Genre");
    if (($object = $stmt->fetchAll()) !== false) {
      return $object;
    } else {
      throw new Exception("Erreur creation d'instance");
    }
	}

}
