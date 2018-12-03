<?php require 'inc/connexion.php';
    // gestion mise à jour d'une information
    if(isset($_POST['titre_exp'])){
        $titre_exp = addslashes($_POST['titre_exp']);
        $stitre_exp = addslashes($_POST['stitre_exp']);
        $dates_exp = addslashes($_POST['dates_exp']);
        $description_exp = addslashes($_POST['description_exp']);
        $id_experience = $_POST['id_experience'];

        $pdoCV->exec(" UPDATE t_experiences SET titre_exp='$titre_exp', stitre_exp='$stitre_exp', dates_exp='$dates_exp', description_exp='$description_exp' WHERE id_experience='$id_experience' ");
        header('location: ../admin/experiences.php');
    }

    // je récupère l'id de ce que je mets à jour
    $id_experience = $_GET['id_experience']; // par son id et avec GET
    $sql = $pdoCV->query(" SELECT * FROM t_experiences WHERE id_experience='$id_experience' ");
    $ligne_experience = $sql->fetch(); // pour qu'il aille chercher 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour compétence</title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>

    <div class="container fond-container">
        <div class="row">
            <div class="col">
                <h1 class="text-center text-white">Mise à jour d'une expérience</h1>
            </div> <!-- fin row 1 -->
        </div>
        <div class="row">
            <div class="col-2"></div>
            <!-- mise à jour formulaire -->
            <form action="modif_experience.php" method="post" class="col-auto">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-sm-0 col-md-3 col-lg-3"></div>
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            <div>
                                <label for="titre_exp" class="text-white">Titre</label>
                                <input type="text" name="titre_exp" value="<?php echo $ligne_experience['titre_exp']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            <div>
                                <label for="stitre_exp" class="text-white">Sous-titre</label>
                                <input type="text" name="stitre_exp" value="<?php echo $ligne_experience['stitre_exp']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-2 col-lg-2">
                                <label for="dates_exp" class="text-white">Dates</label>
                                <input type="text" name="dates_exp" value="<?php echo $ligne_experience['dates_exp']; ?>" class="form-control" required>
                        </div>
                        <div class="col-sm-0 col-md-3 col-lg-3"></div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-0 col-md-3 col-lg-3"></div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="description_exp" class="text-white">Description</label>
                            <textarea name="description_exp" value="<?php echo $ligne_experience['description_exp']; ?>" cols="35" rows="10"></textarea>
                        </div>
                        <div class="col-sm-0 col-md-3 col-lg-3"></div>
                    </div>
                    
                </div> <!-- fin div form-group -->
                <input type="hidden" name="id_experience" value="<?php echo $ligne_experience['id_experience']; ?>">
                <button type="submit" class="btn btn-info marge-exp">Modification d'une expérience</button>
            </form>
            
        </div> <!-- fin de la div row 2 -->
        
        

    </div> <!-- fin de la div container --> 
    <?php require 'inc/footer.php'; ?>


<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>