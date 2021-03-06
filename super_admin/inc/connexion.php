<?php 
// fichier de connexion à la BDD

$host= 'localhost';   // le chemin vers le serveur  de données
$database='site_portfolio';   // le nom de la base de données
$user='root';   // le nom de l'utilisateur pour se connecter
$password='';   // mot de passe de l'utilisateur local (sur PC)
// $password='root'; // mot de passe local (sur MAC)

$pdoCV = new PDO('mysql:host=' . $host .';dbname='.$database,$user,$password);  
// $pdoCV est le nom de la variable pour la connexion à la BDD qui nous sert partout où l'on doit se servir de cette connexion.
$pdoCV->exec("SET NAMES utf8");

define('RACINE_SITE', '/htdocs/site_portfolio/');

// Pour voir si l'internaute est connecté
function internauteEstConnecte(){
	if (isset($_SESSION['membre'])){ 
		return true;
	} else {
		return false;
	}
	return (isset($_SESSION['membre']));
}

function internauteEstConnecteEtAdmin(){
	if (internauteEstConnecte() && $_SESSION['membre']['value'] == 0) {
		return true;
	}else {
		return false;
	}
	return (internauteEstConnecte() && $_SESSION['membre']['value'] == 0);
}

function internauteEstConnecteEtSuperAdmin(){
	if (internauteEstConnecte() && $_SESSION['membre']['value'] == 1) {
		return true;
	}else {
		return false;
	}
	return (internauteEstConnecte() && $_SESSION['membre']['value'] == 1);
}

// Pour faciliter le executeRequete

function executeRequete($req,$param = array()){
	if(!empty($param)){ 
		foreach($param as $indice => $valeur){
			$param[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
		}
	}
	global $pdoCV;
	$result = $pdoCV->prepare($req);
	$result->execute($param);
	return $result;
}
?>








