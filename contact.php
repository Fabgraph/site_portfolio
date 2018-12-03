

<?php require 'admin/inc/connexion.php'; 

// insertion d'un élément dans la base
if(isset($_POST['nom'])){// si on a reçu un nouvelle compétence
    if($_POST['nom']!='' && $_POST['email']!='' && $_POST['message']!=''){

        $nom = addslashes ($_POST['nom']);
        $email = addslashes ($_POST['email']);
        $message = addslashes ($_POST['message']);
        $pdoCV->exec(" INSERT INTO t_contact VALUES (NULL, '$nom', '$email', '$message') ");

        header("location: contact.php");
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
    <!--- Include the above in your HEAD tag -->
</head>
<body>
<?php require 'inc/navigation.php'; ?>

<link href="https://fonts.googleapis.com/css?family=Oswald:700|Patua+One|Roboto+Condensed:700" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<section id="contact" class="content-section text-center">
        <div class="contact-section">
            <div class="container">
              <h2 class="titre2">Contact Us</h2>
              <p>Feel free to shout us by feeling the contact form or visiting our social network sites like Fackebook,Whatsapp,Twitter.</p>
              <div class="row">
                <div class="col-md-8 col-md-offset-2">

                  <form class="form-horizontal" action="mail.php" method="post">
                    <div class="form-group">
                      <label for="nom">Nom</label>
                      <input type="text" class="form-control" name="nom" id="nom" placeholder="Jane Doe">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="jane.doe@example.com">
                    </div>
                    <div class="form-group ">
                      <label for="message">Votre message</label>
                     <textarea  class="form-control" name="message" id="message" placeholder="Message"></textarea> 
                    </div>
                    <button type="submit" class="btn btn-default">Envoyer le message</button>
                  </form>

                  <hr>
                    <h3 class="titre3">Vos sites sociaux</h3>
                  <ul class="list-inline banner-social-buttons">
                    <li><a href="https://twitter.com/?lang=fr" class="btn btn-default btn-lg"><i class="fa fa-twitter"> <span class="network-name">Twitter</span></i></a></li>
                    <li><a href="https://fr-fr.facebook.com/" class="btn btn-default btn-lg"><i class="fa fa-facebook"> <span class="network-name">Facebook</span></i></a></li>
                    <li><a href="https://www.youtube.com/" class="btn btn-default btn-lg"><i class="fa fa-youtube-play"> <span class="network-name">Youtube</span></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
        </div>
      </section>

<?php require 'inc/footer.php'; ?>

<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>

