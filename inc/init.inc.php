<?php

//  ========== CONNEXION BDD
$pdo = new PDO('mysql:host=localhost;dbname=boutique','root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// =========== SESSION
session_start();

// =========== CHEMIN
define("RACINE_SITE",$_SERVER['DOCUMENT_ROOT']."/PHP/boutique");
// Cette constante retourne le chemin physique du dossier boutique sur le serveur;
// echo '<pre>';print_r($_SERVER);'</pre>';
// echo RACINE_SITE;

define("URL", 'http://localhost/PHP/boutique/'); // Cette constante servira plus tard à enregistrer l'URL d'une photo/image dans la BDD, on ne conservera jamais la photo elle même, ce serait trop lours pour la BDD;

// =========== VRAIABLES
$content= '';


// =========== INCLUSIONS
require_once("fonction.inc.php");