<?php require 'connexion.php';
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
    <!-- lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <h1>Mise à jour d'un titre</h1>

    <!-- mise à jour formulaire -->
    <form action="modif_titre.php" method="post">
    <div class="">
        <label for="titre">Loisir</label>
        <input type="text" name="titre" value="<?php echo $ligne_titre['titre']; ?>" required>
    </div>
    <div class="">
        <label for="accroche">Accroche</label>
        <div>
            <textarea name="accroche" cols="30" rows="10"></textarea>
        </div>
    </div>
    <div>
    <input type="hidden" name="id_titre" value="<?php echo $ligne_titre['id_titre']; ?>">
        <button type="submit">MAJ</button>
    </div>
</form>
</body>
</html>