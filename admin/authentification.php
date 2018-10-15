<?php require 'inc/connexion.php';

session_start();// à mettre dans toutes les pages de l'admin
//traitement pour la connexion à l'admin
if(isset($_POST['connexion'])){// connexion est la name du button

    $email = addslashes($_POST['email']);
    $mdp = addslashes($_POST['mdp']);

    $sql= $pdoCV -> prepare (" SELECT * FROM t_utilisateurs WHERE email='$email' AND mdp='$mdp' ");
    // on vérifie email ET mot de passe

    $sql -> execute();
    $nbr_utilisateur = $sql -> rowCount();// on compte si il est dans la BDD; le compte répond 0 s'il n'y est pas et répond 1 s'il y est

    if($nbr_utilisateur == 0) {// il n'y est pas
        echo '<p>Erreur</p>';
    } else {// il y est
        // echo $nbr_utilisateur; 
        $ligne_utilisateur = $sql -> fetch();

        $_SESSION['connexion_admin'] = 'connecté'; // connexion pour l'admin

        $_SESSION['email'] = $ligne_utilisateur['email'];
        $_SESSION['nom'] = $ligne_utilisateur['nom'];
        $_SESSION['mdp'] = $ligne_utilisateur['mdp'];

        // echo $ligne_utilisateur['nom'];

        header('location:../admin/index.php');
    }
}

?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <!-- lien feuille de style CSS -->
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <title>Admin : authentification</title>
</head>
<body>
    <form action="authentification.php" method="post">

    <h1>Admin : authentification</h1>

    <label for="email">Votre email</label>
    <input type="email" name="email" placeholder="m.dupond@mail.fr" required>

    <label for="mdp">Mot de passe</label>
    <input type="password" name="mdp" placeholder="votre mot de passe" required>

    <button name="connexion" type="submit">Se connecter</button>

    </form>
    
    

<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>