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

        header('location:../super_admin/authentification.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require 'inc/liens.php'; ?>

    <?php 
        // requête pour une seule info
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
        $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Accueil : <?php echo $ligne_utilisateur['prenom'] ?></title>
</head>
<body>

<?php require 'inc/navigation.php'; ?>


    <div class="jumbo">
        <div class="jumbotron jumbotron-fluid bg-info pb-5">
            <h1 class="text-center text-warning">Bienvenue : <?php echo $ligne_utilisateur['pseudo'] ?></h1>
            <?php
                // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
                $sql = $pdoCV->prepare(" SELECT * FROM t_competences WHERE id_utilisateur = '$id_utilisateur' ");
                $sql->execute();
                $nbr_competences = $sql->rowCount();
            ?>
            <div class="container">
                <div class="row" id="a">
                    <div class="col-sm-12">

                        <!-- SLIDER -->
                        <div id="demo" class="carousel slide" data-ride="carousel">

                                <!-- Indicators -->
                                <ul class="carousel-indicators">
                                <li data-target="#demo" data-slide-to="0" class="active"></li>
                                <li data-target="#demo" data-slide-to="1"></li>
                                <li data-target="#demo" data-slide-to="2"></li>
                                </ul>

                                <!-- The slideshow -->
                                <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="img/img_code.jpg" alt="Los Angeles" class="taille_img">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/img_resultat.jpg" alt="Chicago" class="taille_img">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/dessin.jpg" alt="New York" class="taille_img">
                                </div>
                                </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                </a>
                                <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                </a>

                        </div>

                    </div> <!-- fin de la div col -->
                    <!-- FIN SLIDER -->


                </div> <!-- fin de la div row -->
            </div> <!-- fin de la div container -->
        </div> 
    </div> <!-- fin jumbotron -->
<div class="container bg-primary">
    <br>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h2 class="text-center text-warning">Bienvenue sur mon site portfolio</h2>
            <p class="text-center text-warning">Je me présente en quelques mots. Je suis développeur-intégrateur web et graphiste print. Voici mon premier site, réalisé avec Bootstrap. Il présente mes compétences dans le but de touver un futur employeur.</p>
        </div>


        <div class="col-sm-12 col-md-6 col-lg-6">
            <table class="table">
            <caption class="text-white">La liste des compétences : <?php echo $nbr_competences; ?></caption>
                <thead>
                    <tr>
                        <th class="table-dark text-info">Compétences</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($ligne_competence=$sql->fetch()) 
                        {
                    ?>
                    <tr class="table-warning">
                        <td class="text-info">
                            <?php echo $ligne_competence['competence']; ?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>

    

    </div>




</div> <!-- fin de la div container -->
<?php require 'inc/footer.php'; ?>


<!-- lien js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>