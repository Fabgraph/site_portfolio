<?php require 'admin/inc/connexion.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon profil</title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>

<?php require 'inc/navigation.php'; ?>

<div class="container container2 marges">

    <div class="card titre">
        <div class="card-body bg-info">
            <?php
                // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
                $sql = $pdoCV->prepare(" SELECT * FROM t_competences WHERE id_utilisateur = '1' ");
                $sql->execute();
                $nbr_competences = $sql->rowCount();
            ?>
            <h1 class="text-center text-warning">Compétences</h1>
        </div>
    </div>
    <br>
    <div class="row">
        
        <div class="col-sm-12 col-md-6 col-lg-6">
            <?php
                // requête pour selectionner un enum de categorie
                $categorie_web = $pdoCV->query(" SELECT DISTINCT categorie FROM competence ");
            ?>
            <h2 class="text-white"><?php echo $categorie_web ?></h2>
            
            <div>
                <?php
                    // requête pour selectionner une catégorie dans competence
                    $sql = $pdoCV->prepare(" SELECT * FROM t_competences WHERE categorie = 'Web ");
                    $sql->execute();
                    $competences_web = $sql->rowCount(); 

                    while($ligne_competence=$sql->fetch()) {
                ?>

                <h3 class="text-center text-warning"><?php echo $competences_web ?></h3>
                <h4 class="text-center text-warning"><?php echo $ligne_competence['competence'] ?></h4>
                <h5 class="text-info"><?php $ligne_competence['niveau'] ?></h5>
                <?php 
                    }
                ?>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <?php 
                // requête pour selectionner une catégorie dans competence
                $sql = $pdoCV->prepare(" SELECT * FROM t_competences WHERE categorie = 'Print' ");
                $sql->execute();
                $competences_print = $sql->rowCount(); 

                while($ligne_competence=$sql->fetch())
                {
            ?>
            <h2 class="text-info"><?php echo $ligne_competence['categorie'] ?></h2>
            <?php 
                }
            ?>
            <div>
                <?php while($ligne_competence=$sql->fetch())
                    {
                ?>
                <h3 class="text-center text-warning"><?php echo $competences_print ?></h3>
                <h4 class="text-center text-warning"><?php echo $ligne_competence['competence'] ?></h4>
                <h5 class="text-info"><?php echo $ligne_competence['niveau'] ?></h5>
                <?php 
                    }
                ?>
            </div>      
        </div>
        
    </div> <!-- fin div row -->
    <br>

    <div class="card titre">
        <div class="card-body bg-info">
            <?php
                // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
                $sql = $pdoCV->prepare(" SELECT DISTINCT * FROM t_formations WHERE id_utilisateur = '1'   ");
                $sql->execute();
                $nbr_formations = $sql->rowCount();
            ?>
            <h1 class="text-center text-warning">Formations</h1>
        </div>
    </div>
    <br>
    <div class="row text-white">
        <?php while($ligne_formation=$sql->fetch())
            {
        ?>
       <div class="col-sm-12 col-md-2 col-lg-2 text-center"><?php echo $ligne_formation['dates_form']; ?></div>
       <div class="col-sm-12 col-md-2 col-lg-2 text-center"><?php echo $ligne_formation['titre_form']; ?></div>
       <div class="col-sm-12 col-md-2 col-lg-2 text-center"><?php echo $ligne_formation['stitre_form']; ?></div>
       <div class="col-sm-12 col-md-6 col-lg-6 text-center"><?php echo $ligne_formation['description_form']; ?></div>
        <?php 
            }
        ?>
    </div> <!-- fin div row -->
    <br>

    <div class="card titre">
        <div class="card-body bg-info">
            <?php
                // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
                $sql = $pdoCV->prepare(" SELECT * FROM t_experiences WHERE id_utilisateur = '1' ");
                $sql->execute();
                $nbr_experiences = $sql->rowCount();
            ?>
            <h1 class="text-center text-warning">Expériences Professionnelles</h1>
        </div>
    </div>
    <br>
    <div class="row text-white">
        <?php while($ligne_experience=$sql->fetch())
            {
        ?>
       <div class="col-sm-12 col-md-2 col-lg-2 text-center"><?php echo $ligne_experience['dates_exp']; ?></div>
       <div class="col-sm-12 col-md-2 col-lg-2 text-center"><?php echo $ligne_experience['titre_exp']; ?></div>
       <div class="col-sm-12 col-md-2 col-lg-2 text-center"><?php echo $ligne_experience['stitre_exp']; ?></div>
       <div class="col-sm-12 col-md-6 col-lg-6 text-center"><?php echo $ligne_experience['description_exp']; ?></div>
        <?php 
            }
        ?>
    </div> <!-- fin div row -->
        <br>

    <div class="card titre">
        <div class="card-body bg-info">
            <?php 
                // requête pour une seule info
                $sql = $pdoCV->query(" SELECT * FROM t_loisirs WHERE id_utilisateur = '1' ");
                $ligne_loisir = $sql->fetch();
            ?>
            <h1 class="text-center text-warning">Centre d'intérêt et activités</h1>
        </div>
    </div>
    <br>
    <div class="row text-white">
        <?php while($ligne_loisir=$sql->fetch())
            {
        ?>
        <div class="col-sm-12 col-md-6 col-lg-6 text-center"><?php echo $ligne_loisir['loisir']; ?></div>
        <?php 
            }
        ?>
    </div>
    
</div> <!-- fin div container -->

















<?php require 'inc/footer.php'; ?> 
<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    
</body>
</html>