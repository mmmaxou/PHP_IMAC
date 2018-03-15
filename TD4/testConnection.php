<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

/* Connexion to database */
require_once 'Classes/MyPDO.mpluchar_db.include.php';

$PDO = MyPDO::getInstance();
$stmt = $PDO->prepare(<<<SQL
	SELECT *
	FROM Cast
	ORDER BY lastname, firstname
SQL
);
$stmt->execute();

while (($row = $stmt->fetch()) !== false) {
	echo "<div>{$row['lastname']}</div>";
}