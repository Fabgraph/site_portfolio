<?php require 'inc/connexion.php';
    // gestion mise à jour d'une information
    if(isset($_POST['titre_form'])){
        $titre = addslashes($_POST['titre_form']);
        $stitre = addslashes($_POST['stitre_form']);
        $dates = addslashes($_POST['dates_form']);
        $description = addslashes($_POST['description_form']);
        $id_formation = $_POST['id_formation'];

        $pdoCV->exec(" UPDATE t_formations SET titre_form='$titre', stitre_form='$stitre', dates_form='$dates', description_form='$description' WHERE id_formation='$id_formation' ");
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
    <!-- lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid bg-primary">
    <h1 class="text-center text-white">Mise à jour d'une formation</h1>

    <!-- mise à jour formulaire -->
    <form action="modif_formation.php" method="post">
        <div class="form-group">
            <div>
                <label for="titre" class="text-white">Titre</label>
                <input type="text" name="titre_form" value="<?php echo $ligne_formation['titre_form']; ?>" class="form-control" required>
            </div>
            <div>
                <label for="stitre" class="text-white">Sous-titre</label>
                <input type="text" name="stitre_form" value="<?php echo $ligne_formation['stitre_form']; ?>" class="form-control" required>
            </div>
            <div>
                <label for="dates" class="text-white">Dates</label>
                <input type="text" name="dates_form" value="<?php echo $ligne_formation['dates_form']; ?>" class="form-control" required>
            </div>
            <div>
                <div>
                    <label for="description" class="text-white">Description</label>
                </div>
                <div>
                    <textarea name="description_form" value="<?php echo $ligne_formation['description_form']; ?>" cols="30" rows="10"></textarea>
                </div>
            </div>
        
        
        </div>
        <div>
            <input type="hidden" name="id_formation" value="<?php echo $ligne_formation['id_formation']; ?>">
            <button type="submit" class="btn btn-info">MAJ</button>
        </div>
    </form>

    </div>


<?php require 'inc/footer.php'; ?>
</body>
</html>