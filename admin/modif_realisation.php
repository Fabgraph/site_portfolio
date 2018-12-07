<?php require 'inc/connexion.php';
    // gestion mise à jour d'une information
    if(isset($_POST['titre_real'])){
        $titre_real = addslashes($_POST['titre_real']);
        $stitre_real = addslashes($_POST['stitre_real']);
        $dates_real = addslashes($_POST['dates_real']);
        $description_real = addslashes($_POST['description_real']);
        $id_realisation = $_POST['id_realisation'];

        $pdoCV->exec(" UPDATE t_realisations SET titre_real='$titre_real', stitre_real='$stitre_real', dates_real='$dates_real', description_real='$description_real' WHERE id_realisation='$id_realisation' ");
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
    
    <div class="container fond-container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h1 class="text-center text-white">Mise à jour d'une réalisation</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-0 col-md-2 col-lg-2"></div>
            <div class="col-sm-12 col-md-8 col-lg-8">
                <!-- mise à jour formulaire -->
                <form action="modif_realisation.php" method="post" class="col-auto">
                    <div class="form-group">
                        <div class="form-row pr-1">
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
                        </div> <!-- fin div form-row -->
                        <div class="form-group">
                                <div>
                                    <label for="description" class="text-white">Description</label>
                                </div>
                                <div>
                                    <textarea type="text" class="form-control" name="description_real" id="description_real" cols="22"  rows="10"><?php echo $ligne_realisation['description_real']; ?></textarea>
                                </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <input type="hidden" name="id_realisation" value="<?php echo $ligne_realisation['id_realisation']; ?>">
                        <button type="submit" class="btn btn-info">Modification d'une réalisation</button>
                    </div>
                    <div class="col-sm-0 col-md-8 col-lg-8"></div>
                </div>
            </form>
            </div>
        </div> <!-- fin div row -->
        
    </div>


<?php require 'inc/footer.php'; ?>


<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>