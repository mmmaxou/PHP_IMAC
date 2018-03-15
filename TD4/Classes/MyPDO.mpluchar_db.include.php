<?php
require_once 'Classes/MyPDO.class.php';

// TO DO : à modifier
// host=votre serveur (localhost si travail en local)
$host = "sqletud.u-pem.fr";
$dbname = "mpluchar_db";
$login = "mpluchar";
$mdp = "5dYciunii7";
MyPDO::setConfiguration("mysql:host=$host;dbname=$dbname;charset=utf8", $login, $mdp);
