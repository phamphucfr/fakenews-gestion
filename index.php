<?php

// utilisation du chargement auto des classes
// plus besoin d'inclure les fichier lors d'instanciations
spl_autoload_register('my_autoloader');
// fonction custom lié à l'autoload
function my_autoloader($class) {
    include 'models/' . $class . '.php';
}
include("tools/authen.php");
// index.php - Main Controller
//AUTHENTIFICATION-CHECK
  

//CONTROLEUR PRINCIPAL-INDEX.PHP
include("tools/MaConnexion.php");

// Connexion - Une instance de PDO -
$cnx = MaConnexion::connect();

//Métier - Business
// which section? 
$section = "0"; //par défaut => actualités
if( isset($_GET["section"]) ){
	$section = $_GET["section"];
}
if( isset($_POST["section"]) ){
	$section = $_POST["section"];
}

// which action?
$action = "0";  // par défaut => listing des entités
if( isset($_GET["action"]) ){
	$action = $_GET["action"];
}
if( isset($_POST["action"]) ){
	$action = $_POST["action"];
}

// On dirige vers un controleur spécifique:
switch($section){
	case "1":
		include_once("controllers/controller_themes.php");
		break;
	case "2":
		include_once("controllers/controller_tags.php");
		break;	
	case "3":
		include_once("views/upload/formulaire.php");
		break;	
	case "0": default:
		include_once("controllers/controller_actualites.php");
		break;
}

// les sections:
// 0 ==> actus
// 1 ==> themes
// 2 ==> mot-clé
// 3 ==> upload

// les actions:
// 0 ==> listing
// 1 ==> création
// 2 ==> modification
// 3 ==> suppression



?>


