<?php
require_once 'MyPDO.mpluchar_db.include.php';

/**
 * Classe Country
 */
class Country {

	/***********************ATTRIBUTS***********************/
	
	// Identifiant
	private $code = null;
	// Nom
	private $name = null;


	/*********************CONSTRUCTEURS*********************/
	
	// Constructeur non accessible
	function __construct() {}

	/**
	 * Usine pour fabriquer une instance de Country à partir d'un id (via la bdd)
	 * @param int $id identifiant du Country à créer (bdd)
	 * @return Country instance correspondant à $id
	 * @throws Exception s'il n'existe pas cet $id dans a bdd
	 */
	public static function createFromId($code){
    $query = "SELECT * FROM Country WHERE code=:code";
    $stmt = MyPDO::getInstance()->prepare($query);
    $stmt->bindValue(":code", $code);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Country");
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
	public function getCode() {
    return $this->code;
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
	 * Récupère tous les enregistrements de la table Country de la bdd
	 * qui ont au moins un film associé au Country
	 * Tri par ordre alphabétique
	 * @return array<Country> liste d'instances de Country
	 */
	public static function getAll() {
    $query = "SELECT Country.* FROM Country 
              INNER JOIN Movie ON Movie.idCountry = Country.code
              WHERE count(Movie.id) >= 1";
    $stmt = MyPDO::getInstance()->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Country");
    if (($object = $stmt->fetch()) !== false) {
      return $object;
    } else {
      throw new Exception("Erreur creation d'instance");
    }
	}
}
