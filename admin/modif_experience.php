<?php require 'inc/connexion.php';
    // gestion mise à jour d'une information
    if(isset($_POST['titre_exp'])){
        $titre = addslashes($_POST['titre_exp']);
        $stitre = addslashes($_POST['stitre_exp']);
        $dates = addslashes($_POST['dates_exp']);
        $description = addslashes($_POST['description_exp']);
        $id_experience = $_POST['id_experience'];

        $pdoCV->exec(" UPDATE t_experiences SET titre_exp='$titre', stitre_exp='$stitre', dates_exp='$dates', description_exp='$description' WHERE id_experience='$id_experience' ");
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

    <div class="container-fluid">
    <div class="container2">
    <h1 class="text-center text-white">Mise à jour d'une expérience</h1>

    <!-- mise à jour formulaire -->
    <form action="modif_experience.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div>
                        <label for="titre" class="text-white">Titre</label>
                        <input type="text" name="titre_exp" value="<?php echo $ligne_experience['titre_exp']; ?>" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div>
                        <label for="stitre" class="text-white">Sous-titre</label>
                        <input type="text" name="stitre_exp" value="<?php echo $ligne_experience['stitre_exp']; ?>" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div>
                        <label for="dates" class="text-white">Dates</label>
                        <input type="text" name="dates_exp" value="<?php echo $ligne_experience['dates_exp']; ?>" class="form-control" required>
                    </div>
                    <div>
                </div>
            </div> <!-- fin de la div row -->
            <br>
            <div class="descrip">
                <div>
                    <label for="description" class="text-white">Description</label>
                </div>
                <div>
                    <textarea name="description_exp" value="<?php echo $ligne_experience['description_exp']; ?>" cols="30" rows="10"></textarea>
                </div>
            </div>  <!-- fin de la div descrip -->
        
        
        </div>
        <br>
        <div>
            <input type="hidden" name="id_experience" value="<?php echo $ligne_experience['id_experience']; ?>">
            <button type="submit" class="btn btn-info">MAJ</button>
        </div>
    </form>
    </div>

    </div> <!-- fin div container2 --> 
    <?php require 'inc/footer.php'; ?>
</body>
</html>