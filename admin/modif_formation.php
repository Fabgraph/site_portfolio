<?php require 'inc/connexion.php';
    // gestion mise à jour d'une information
    if(isset($_POST['titre_form'])){
        $titre_form = addslashes($_POST['titre_form']);
        $stitre_form = addslashes($_POST['stitre_form']);
        $dates_form = addslashes($_POST['dates_form']);
        $description_form = addslashes($_POST['description_form']);
        $id_formation = $_POST['id_formation'];

        $pdoCV->exec(" UPDATE t_formations SET titre_form='$titre_form', stitre_form='$stitre_form', dates_form='$dates_form', description_form='$description_form' WHERE id_formation='$id_formation' ");
        header('location: ../admin/formations.php');

    }

    // je récupère l'id de ce que je mets à jour
    $id_formation = $_GET['id_formation']; // par son id et avec GET
    $sql = $pdoCV->query(" SELECT * FROM t_formations WHERE id_formation='$id_formation' ");
    $ligne_formation = $sql->fetch(); // pour qu'il aille chercher 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour formation</title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container fond-container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h1 class="text-center text-white">Mise à jour d'une formation</h1>
            </div>
        </div>
        <div class="row">
    
            <!-- mise à jour formulaire -->
            <form action="modif_formation.php" method="post" class="col-auto">
                <div class="form-group">
                    <div class="row pl-5">
                        <div class="col-sm-0 col-md-3 col-lg-3"></div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div>
                                <label for="titre_form" class="text-white">Titre</label>
                                <input type="text" name="titre_form" value="<?php echo $ligne_formation['titre_form']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div>
                                <label for="stitre_form" class="text-white">Sous-titre</label>
                                <input type="text" name="stitre_form" value="<?php echo $ligne_formation['stitre_form']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div>
                                <label for="dates_form" class="text-white">Dates</label>
                                <input type="text" name="dates_form" value="<?php echo $ligne_formation['dates_form']; ?>" class="form-control" required>
                            </div>
                        </div>
                    </div> <!-- fin div row -->
                    
                    <div class="row">
                        <div class="col-sm-0 col-md-3 col-lg-3"></div>
                        <div class="col-sm-12 col-md-9 col-lg-9 pl-5">
                            <label for="description_form" class="text-white">Description</label>
                            <textarea type="text" class="form-control" name="description_form" id="description_form" cols="60" rows="10"><?php echo $ligne_formation['description_form']; ?></textarea>
                        </div>
                        <div class="col-sm-0 col-md-0 col-lg-0"></div>
                    </div>
                </div>
                <div class="row mr-5 pr-5">
                    <div class="col-sm-0 col-md-4 col-lg-4"></div>
                    <div class="col-sm-12 col-md-5 col-lg-5">
                        <input type="hidden" name="id_formation" value="<?php echo $ligne_formation['id_formation']; ?>">
                        <button type="submit" class="btn btn-info">Modification d'une formation</button>
                    </div>
                    <div class="col-sm-0 col-md-3 col-lg-3"></div>
                </div>
            </form>
        </div>
            
    
        </div> <!-- fin div row -->
    </div> <!-- fin de la div container -->
<?php require 'inc/footer.php'; ?>


<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>