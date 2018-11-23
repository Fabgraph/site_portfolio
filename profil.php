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
        <div class="card-body bg-dark">
            <?php
                // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
                $sql = $pdoCV->prepare(" SELECT * FROM t_competences WHERE id_utilisateur = '1' ");
                $sql->execute();
                $nbr_competences = $sql->rowCount();
            ?>

            <?php
                // requête pour une seule competence
                $une_competence_web = $pdoCV->query(" SELECT * FROM t_competences WHERE id_utilisateur = '1' AND categorie = 'Web' ");
                $ligne_competence = $une_competence_web->fetch();
            ?>
            <h1 class="text-center text-warning">Compétences</h1>
        </div>
    </div>
    <br>
    <div class="row">
        
        <div class="col-sm-12 col-md-6 col-lg-6">
            
            <?php
                // requête pour selectionner une catégorie dans competence
                $une_categorie_web = $pdoCV->query(" SELECT DISTINCT categorie FROM t_competences WHERE categorie = 'Web' ");
                $une_categorie_web->execute();
                /* $competences_web = $une_categorie_web->rowCount(); */
            ?>
            <?php
                while($ligne_competence=$une_categorie_web->fetch()) {
            ?>
            <h2 class="text-center text-success"><?php echo $ligne_competence['categorie']; ?></h2>
            <?php
                }
            ?>
            
                <?php 
                    while($ligne_competence=$une_competence_web->fetch()) {
                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="text-left  text-info"><?php echo $ligne_competence['competence']; ?></h3>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="text-right text-white"><?php echo $ligne_competence['niveau']; ?></h5>
                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                            <span class="sr-only">40% effectué (success)</span>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                ?>
            
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6  border border-top-0 border border-right-0 border border-left-1 border-primary border border-bottom-0">
            <?php 
                // requête pour selectionner une catégorie dans competence
                $une_categorie_print = $pdoCV->prepare(" SELECT DISTINCT categorie FROM t_competences WHERE categorie = 'Print' ");
                $une_categorie_print->execute();
               /*  $competences_print = $une_categorie_print->rowCount(); */
            ?>

            <?php
                // requête pour une seule competence
                $une_competence_print = $pdoCV->query(" SELECT * FROM t_competences WHERE id_utilisateur = '1' AND categorie = 'Print' ");
                $ligne_competence = $une_competence_print->fetch();
            ?>

            <?php
                while($ligne_competence=$une_categorie_print->fetch()) {
            ?>
            <h2 class="text-center text-success"><?php echo $ligne_competence['categorie'] ?></h2>
            <?php 
                }
            ?>
            <div class="row">
                <?php 
                    while($ligne_competence=$une_competence_print->fetch()) {
                ?>
                <div class="col-sm-6">
                    <h3 class="text-left text-info"><?php echo $ligne_competence['competence'] ?></h3>
                </div>
                <div class="col-sm-6">
                    <h5 class="text-right text-white"><?php echo $ligne_competence['niveau'] ?></h5>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                            <span class="sr-only">40% effectué (success)</span>
                        </div>
                    </div> 
                </div>
                <?php 
                    }
                ?>
            </div>      
        </div>
        
    </div> <!-- fin div row -->
    <br>

    <div class="card titre">
        <div class="card-body bg-dark">
            <?php
                // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
                $sql2 = $pdoCV->prepare(" SELECT DISTINCT * FROM t_formations WHERE id_utilisateur = '1'   ");
                $sql2->execute();
                $nbr_formations = $sql2->rowCount();
                
                // requête pour une seule info
                $une_formation = $pdoCV->query(" SELECT * FROM t_formations WHERE id_utilisateur = '1' ");
                $ligne_formation = $une_formation->fetch();
            ?>
            <h1 class="text-center text-warning">Formations</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <?php while($ligne_formation=$une_formation->fetch())
            {
        ?>
       <div class="col-sm-12 col-md-2 col-lg-2 text-center text-success"><?php echo $ligne_formation['dates_form']; ?></div>
       <div class="col-sm-12 col-md-2 col-lg-2 text-center text-white "><?php echo $ligne_formation['titre_form']; ?></div>
       <div class="col-sm-12 col-md-2 col-lg-2 text-center text-white"><?php echo $ligne_formation['stitre_form']; ?></div>
       <div class="col-sm-12 col-md-6 col-lg-6 text-center text-white"><?php echo $ligne_formation['description_form']; ?></div>
        <?php 
            }
        ?>
    </div> <!-- fin div row -->
    <br>

    <div class="card titre">
        <div class="card-body bg-dark">
            <?php
                // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
                $sql3 = $pdoCV->prepare(" SELECT * FROM t_experiences WHERE id_utilisateur = '1' ");
                $sql3->execute();
                $nbr_experiences = $sql3->rowCount();
            ?>
            <h1 class="text-center text-warning">Expériences Professionnelles</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <?php while($ligne_experience=$sql3->fetch())
            {
        ?>
       <div class="col-sm-12 col-md-2 col-lg-2 text-center text-success"><?php echo $ligne_experience['dates_exp']; ?></div>
       <div class="col-sm-12 col-md-2 col-lg-2 text-center text-white"><?php echo $ligne_experience['titre_exp']; ?></div>
       <div class="col-sm-12 col-md-2 col-lg-2 text-center text-white"><?php echo $ligne_experience['stitre_exp']; ?></div>
       <div class="col-sm-12 col-md-6 col-lg-6 text-center text-white"><?php echo $ligne_experience['description_exp']; ?></div>
        <?php 
            }
        ?>
    </div> <!-- fin div row -->
        <br>

    <div class="card titre">
        <div class="card-body bg-dark">
            <?php 
                // requête pour une seule info
                $un_loisir = $pdoCV->query(" SELECT * FROM t_loisirs WHERE id_utilisateur = '1' ");
                $ligne_loisir = $un_loisir->fetch();
            ?>
            <h1 class="text-center text-warning">Centre d'intérêt et activités</h1>
        </div>
    </div>
    <br>
    <div class="row text-white">
        <?php while($ligne_loisir=$un_loisir->fetch())
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