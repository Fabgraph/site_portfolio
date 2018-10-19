<?php require 'inc/connexion.php';
    // gestion mise à jour d'une information
    if(isset($_POST['loisir'])){
        $loisir = addslashes($_POST['loisir']);
        $id_loisir = $_POST['id_loisir'];

        $pdoCV->exec(" UPDATE t_loisirs SET loisir='$loisir' WHERE id_loisir='$id_loisir' ");
        header('location: ../admin/loisirs.php');
    }
    // je récupère l'id de ce que je mets à jour
    $id_loisir = $_GET['id_loisir']; // par son id et avec GET
    $sql = $pdoCV->query(" SELECT * FROM t_loisirs WHERE id_loisir='$id_loisir' ");
    $ligne_loisir = $sql->fetch(); // va cherher 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour loisir</title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>

    <div class="container-fluid bg-primary">
        <div class="container2">
        <h1 class="text-center text-white">Mise à jour d'un loisir</h1>

        <!-- mise à jour formulaire -->
        <form action="modif_loisir.php" method="post">
            <div class="">
                <label for="loisir" class="text-white">Loisir</label>
                <input type="text" name="loisir" value="<?php echo $ligne_loisir['loisir']; ?>" class="form-control" required>
            </div>
            <div>
                <input type="hidden" name="id_loisir" value="<?php echo $ligne_loisir['id_loisir']; ?>">
                <button type="submit" class="btn btn-info">MAJ</button>
            </div>
        </form>
        </div> <!-- fin de la div container2 -->
    </div>

<?php require 'inc/footer.php'; ?>
</body>
</html>