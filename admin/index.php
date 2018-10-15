<?php require 'inc/connexion.php'; 

session_start();// à mettre dans toutes les pages de l'admin

if(isset($_SESSION['connexion_admin'])){// si on est connecté on récupère les variables de session
    $email=$_SESSION['email'];
    $mdp=$_SESSION['mdp'];
    $nom=$_SESSION['nom'];
    // echo $nom;
} else {// si on n'est pas connecté on ne peut pas accéder à l'index d'admin
    header('location:authentification.php');
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
    <link rel="stylesheet" href="css/style.css" />
    <title>Accueil</title>
</head>
<body>

<?php require 'inc/navigation.php'; ?>

<div class="container-fluid bg-info">
    <div class="jumbo">
        <div class="jumbotron jumbotron-fluid bg-secondary pb-5">
            <h1 class="text-center text-white">Fabgraph</h1>
            <?php
                // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
                $sql = $pdoCV->prepare(" SELECT * FROM t_competences ");
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
            </div> <!-- fin de la div row -->
        </div> <!-- fin jumbotron -->
    </div>

    <div class="row">
        <div class="col-sm-9">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, cupiditate! Animi mollitia ut nihil id illo! Repellat illum earum voluptate laboriosam cupiditate neque impedit incidunt, soluta dolores, voluptatum laborum? Adipisci?</p>
        </div>

        <div class="col-sm-3">

            <div class="">
                <table class="table">
                <caption class="text-white">La liste des compétences : <?php echo $nbr_competences; ?></caption>
                    <thead>
                        <tr>
                            <th class="table-primary">Compétences</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while($ligne_competence=$sql->fetch()) 
                            {
                        ?>
                        <tr class="table-info">
                            <td>
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

    </div>




</div>
<?php require 'inc/footer.php'; ?>


<!-- lien js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>