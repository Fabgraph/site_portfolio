<?php require 'inc/connexion.php';
    // gestion mise à jour d'une information
    if(isset($_POST['competence'])){
        $competence = addslashes($_POST['competence']);
        $niveau = addslashes($_POST['niveau']);
        $categorie = addslashes($_POST['categorie']);
        $id_competence = $_POST['id_competence'];

        $pdoCV->exec(" UPDATE t_competences SET competence='$competence', niveau='$niveau', categorie='$categorie' WHERE id_competence='$id_competence' ");
        header('location: ../admin/competences.php');
    }

    // je récupère l'id de ce que je mets à jour
    $id_competence = $_GET['id_competence']; // par son id et avec GET
    $sql = $pdoCV->query(" SELECT * FROM t_competences WHERE id_competence='$id_competence' ");
    $ligne_competence = $sql->fetch(); // pour qu'il aille chercher 

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
        <h1 class="text-center text-white">Mise à jour d'une compétence</h1>
        <!-- mise à jour formulaire -->
        <form action="modif_competence.php" method="post">
        <div class="">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div>
                        <label for="competence" class="text-white">Compétence</label>
                        <input type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div>
                        <label for="niveau" class="text-white">Niveau</label>
                        <input type="text" name="niveau" value="<?php echo $ligne_competence['niveau']; ?>" class="form-control" required>
                    </div>
                </div>
            </div> <!-- fin div row -->
            <br>
            <div class="">
                <label for="categorie" class="text-white">Catégorie</label>
                <select name="categorie">
                    <option value="Développement"
                    <?php // pour ajouter selected="selected" à la balise option si c'est la categorie de la compétence.
                    
                        if (!(strcmp("Développement", $ligne_competence['categorie']))) {// strcmp compare deux chaînes de caractères
                            echo "selected=\"selected\"";
                        }
                    
                        ?>>Developpement</option>
                    <option value="Infographie"
                    <?php 
                    
                        if (!(strcmp("Infographie", $ligne_competence['categorie']))) {
                            echo "selected=\"selected\"";
                        }
                    ?>
                    >Infographie</option>
                    <option value="Front"
                    <?php
                    
                        if (!(strcmp("Front", $ligne_competence['categorie']))) {
                            echo "selected=\"selected\"";
                        }
                    ?>
                    >Front</option>
                    <option value="Back"
                    <?php
                    
                        if (!(strcmp("Back", $ligne_competence['categorie']))) {
                            echo "selected=\"selected\"";
                        }
                    ?>
                    >Back</option>
                </select>
            </div>
        
            </div>
            <br>
            <div>
            <input type="hidden" name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
                <button type="submit" class="btn btn-info">MAJ</button>
            </div>
        </form>
    </div>


    </div> <!-- fin div container2 -->
<?php require 'inc/footer.php'; ?>
</body>
</html>