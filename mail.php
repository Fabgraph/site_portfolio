<?php require 'inc/connexion.php'; // connexion PDO

if (isset($_POST['nom'])) {
	$nom=addslashes($_POST['nom']);
	$email=addslashes($_POST['email']);
	$message=addslashes($_POST['message']);

	$pdoCV->exec(" INSERT INTO t_messages VALUES (NULL, '$nom', '$email', '$message') ");
	//pour faire le courriel
        // EN-TETE
		$entete ="From: page fabgraph <fabricedomoison@gmail.com>\r\n"; 
		$entete.="Reply-To: fabricedomoison@gmail.com\r\n";
		$entete.="MIME-version: 1.0\r\n";
		$entete.="Content-Type: text/html; charset=\"UTF-8\""."\n"; //utf 8 pour avoir les accents
		$entete.="Content-Transfer-Encoding: 8bit";
        // CORPS du mail
		$corps='Nouveau message : '.$nom.' vient d\'écrire.  ';
		$corps.="<br>Nom : <strong>".$nom.'</strong><br> ' ;
		$corps.="Courriel : <em>".$email.'</em><br>';
        $corps.="Message. : ".$message.'<br>';
        
    mail('fabricedomoison@gmail.com','Message de : '.$nom, $corps, $entete);//on fait un courriel pour Christophe avec le nom du client dans l'objet
    
    $pourclient='Bonjour <br> Merci de votre message ! <br>';
    $pourclient.='Je vous contacte dans les meilleurs délais<br> A bientot !';
    $pourclient.='<br><a href=\"http://www.fabgraph.fr\">www.fabgraph.fr</a>';

    mail($email,'Depuis le site www.fabgraph.fr', $pourclient, $entete);

}

header("location: index.php");

			exit();

?>