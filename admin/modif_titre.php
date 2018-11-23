<?php require 'inc/connexion.php';
    // gestion mise à jour d'une information
    if(isset($_POST['titre'])){
        $titre = addslashes($_POST['titre']);
        $accroche = addslashes($_POST['accroche']);
        $id_titre = $_POST['id_titre'];

        $pdoCV->exec(" UPDATE t_titres SET titre='$titre', accroche='$accroche' WHERE id_titre='$id_titre' ");
        header('location: ../admin/titres.php');
    }
    // je récupère l'id de ce que je mets à jour
    $id_titre = $_GET['id_titre']; // par son id et avec GET
    $sql = $pdoCV->query(" SELECT * FROM t_titres WHERE id_titre='$id_titre' ");
    $ligne_titre = $sql->fetch(); // va cherher 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour titre</title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>

    <div class="container fond-container">
        <div class="row p-4">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h1 class="text-center text-white">Mise à jour d'un titre</h1>
            </div>
        </div>
        <div class="row p-4">
            <div class="col-sm-0 col-md-2 col-lg-2"></div>
            <div class="col-sm-12 col-md-8 col-lg-8">
                <!-- mise à jour formulaire -->
                <form action="modif_titre.php" method="post" class="col-auto">
                    <div class="form-row">
                        <div class="col-sm-12 col-md-12 col-lg-12"></div>
                        <label for="titre" class="text-white">Loisir</label>
                        <input type="text" name="titre" value="<?php echo $ligne_titre['titre']; ?>" class="form-control" required>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-0 col-md-3 col-lg-3"></div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div>
                                <label for="accroche" class="text-white">Accroche</label>
                            </div>
                            <div>
                                <textarea name="accroche" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-0 col-md-3 col-lg-3"></div>
                    </div>
                <div>
                    
                </div>
                </form>
            </div>
            <div class="col-sm-0 col-md-2 col-lg-2"></div>
        </div> <!-- fin div row -->
        <input type="hidden" name="id_titre" value="<?php echo $ligne_titre['id_titre']; ?>">
        <button type="submit" class="btn btn-info marge-titre">MAJ</button>
    </div> <!-- fin div container -->

<?php require 'inc/footer.php'; ?>


<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>