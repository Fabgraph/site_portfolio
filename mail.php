<?php require 'inc/connexion.php'; // connexion à la BDD

if(isset($_POST['nom'])) {
    $nom=addslashes($_POST['nom']);
    $email=addslashes($_POST['email']);
    $message=addslashes($_POST['message']);

    // insertion dans la BDD des infos reçues par le formulaire
    $pdoCV->exec("INSERT INTO t_messages VALUES (NULL, '$nom', '$email', '$message')")

    // Pour fabriquer l'email que l'on reçoit

    $entete ="From: Page Contact<fabricedomoison@gmail.com>\r\n";
    $entete .="Reply-To: fabricedomoison@gmail.com\r\n";
    $entete .="MIME-version: 1.0\r\n";
    $entete .="Content-Type: text/html; charset=\"UTF-8\""."\n"; // pour avoir les accents dans le corps du mail et d'avoir de html
    $entete .="Content-Transfer-Encoding: 8bit";

    $corps="Nouveau message de : '.$nom.' depuis la page du CV.";
    $corps .="<br>Nom : ".$nom.'<br>';
    $corps .="<br>Courriel : ".$email.'<br>';
    $corps .="<br>Message : ".$message.'<br>';

    mail('fabricedomoison@gmail.com', 'Nouveau message de : '.$nom, $corps, $entete); // on fait un couriel pour nous avec le nom du visiteur dans l'objet


    header('location:../site_portfolio/index.php');
    exit();
} // fermeture du if isset

?>