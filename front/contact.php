

<?php require 'inc/connexion.php'; 




session_start();// à mettre dans toutes les pages de l'admin

if(isset($_SESSION['connexion_admin'])){// si on est connecté on récupère les variables de session
    $id_utilisateur=$_SESSION['id_utilisateur'];
    $email=$_SESSION['email'];
    $mdp=$_SESSION['mdp'];
    $nom=$_SESSION['nom'];

    // echo $id_utilisateur;
} else {// si on n'est pas connecté on ne peut pas accéder à l'index d'admin
    header('location:authentification.php');
}


// pour vider les variables de session on destroy
if(isset($_GET['quitter'])){

$_SESSION['connexion_admin']='';
$_SESSION['id_utilisateur']='';
$_SESSION['email']='';
$_SESSION['nom']='';
$_SESSION['mdp']='';

    unset($_SESSION['connexion_admin']); // unset détruit la variable connexion_admin
    session_destroy(); // on détruit la session

    header('location:../front/authentification.php');
}


// insertion d'un élément dans la base
if(isset($_POST['nom'])){// si on a reçu un nouvelle compétence
    if($_POST['nom']!='' && $_POST['email']!='' && $_POST['message']!=''){

        $nom = addslashes ($_POST['nom']);
        $email = addslashes ($_POST['email']);
        $message = addslashes ($_POST['message']);
        $pdoCV->exec(" INSERT INTO t_contact VALUES (NULL, '$nom', '$email', '$message', '$id_utilisateur') ");

        header("location: ../front/contact.php");
            exit();

    }// ferme le if n'est pas vide

}// fermeture du if isset





?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
    <?php require 'inc/liens.php'; ?>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body>
<?php require 'inc/navigation.php'; ?>

<link href="https://fonts.googleapis.com/css?family=Oswald:700|Patua+One|Roboto+Condensed:700" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<section id="contact" class="content-section text-center">
        <div class="contact-section">
            <div class="container">
              <h2>Contact Us</h2>
              <p>Feel free to shout us by feeling the contact form or visiting our social network sites like Fackebook,Whatsapp,Twitter.</p>
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label for="nom">Nom</label>
                      <input type="text" class="form-control" id="nom" placeholder="Jane Doe">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" placeholder="jane.doe@example.com">
                    </div>
                    <div class="form-group ">
                      <label for="message">Votre message</label>
                     <textarea  class="form-control" placeholder="Description"></textarea> 
                    </div>
                    <button type="submit" class="btn btn-default">Envoyer le message</button>
                  </form>

                  <hr>
                    <h3>Our Social Sites</h3>
                  <ul class="list-inline banner-social-buttons">
                    <li><a href="#" class="btn btn-default btn-lg"><i class="fa fa-twitter"> <span class="network-name">Twitter</span></i></a></li>
                    <li><a href="#" class="btn btn-default btn-lg"><i class="fa fa-facebook"> <span class="network-name">Facebook</span></i></a></li>
                    <li><a href="#" class="btn btn-default btn-lg"><i class="fa fa-youtube-play"> <span class="network-name">Youtube</span></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
        </div>
      </section>

<?php require 'inc/footer.php'; ?>


</body>
</html>

