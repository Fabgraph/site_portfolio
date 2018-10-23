<?php require 'inc/connexion.php';
    // gestion mise à jour d'une information
    if(isset($_POST['titre_real'])){
        $titre = addslashes($_POST['titre_real']);
        $stitre = addslashes($_POST['stitre_real']);
        $dates = addslashes($_POST['dates_real']);
        $description = addslashes($_POST['description_real']);
        $id_realisation = $_POST['id_realisation'];

        $pdoCV->exec(" UPDATE t_realisations SET titre_real='$titre', stitre_real='$stitre', dates_real='$dates', description_real='$description' WHERE id_realisation='$id_realisation' ");
        header('location: ../admin/realisations.php');
    }

    // je récupère l'id de ce que je mets à jour
    $id_realisation = $_GET['id_realisation']; // par son id et avec GET
    $sql = $pdoCV->query(" SELECT * FROM t_realisations WHERE id_realisation='$id_realisation' ");
    $ligne_realisation = $sql->fetch(); // pour qu'il aille chercher 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour realisation</title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    
    <div class="container-fluid">
        <div class="container2">
            <h1 class="text-center text-white">Mise à jour d'une réalisation</h1>

            <!-- mise à jour formulaire -->
            <form action="modif_realisation.php" method="post">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div>
                                <label for="titre" class="text-white">Titre</label>
                                <input type="text" name="titre_real" value="<?php echo $ligne_realisation['titre_real']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div>
                                <label for="stitre" class="text-white">Sous-titre</label>
                                <input type="text" name="stitre_real" value="<?php echo $ligne_realisation['stitre_real']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div>
                                <label for="dates" class="text-white">Dates</label>
                                <input type="text" name="dates_real" value="<?php echo $ligne_realisation['dates_real']; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div> <!-- fin div row -->
                    <div>
                        <div>
                            <label for="description" class="text-white">Description</label>
                        </div>
                        <div>
                            <textarea type="text" class="form-control" name="description_real" id="description_real" cols="30" rows="10"><?php echo $ligne_realisation['description_real']; ?></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'description_real' );
                            </script>
                        </div>
                    </div>
        
        
                </div>
                <div>
                    <input type="hidden" name="id_realisation" value="<?php echo $ligne_realisation['id_realisation']; ?>">
                    <button type="submit" class="btn btn-info">MAJ</button>
                </div>

            </form>
        </div> <!-- fin div container2 -->
    </div>


<?php require 'inc/footer.php'; ?>
</body>
</html>