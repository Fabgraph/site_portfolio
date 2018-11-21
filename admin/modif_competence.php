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
    <div class="container">
        <h1 class="text-center text-warning">Mise à jour d'une compétence</h1>
        <div class="container2 fond_container">
        <!-- mise à jour formulaire -->
        <form action="modif_competence.php" method="post">
        <div class="">
            <div class="row">
                
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <label for="competence" class="text-white">Compétence</label>
                        <input type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>" class="form-control" required>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <label for="niveau" class="text-white">Niveau</label>
                        <input type="text" name="niveau" value="<?php echo $ligne_competence['niveau']; ?>" class="form-control" required>
                    </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <label for="categorie" class="text-white categorie">Catégorie</label>
                        <select name="categorie">
                            <option value="Web"
                            <?php // pour ajouter selected="selected" à la balise option si c'est la categorie de la compétence.
                    
                                if (!(strcmp("Développement", $ligne_competence['categorie']))) {// strcmp compare deux chaînes de caractères
                                    echo "selected=\"selected\"";
                                }
                    
                            ?>>Web</option>
                            <option value="Print"
                            <?php 
                    
                                if (!(strcmp("Infographie", $ligne_competence['categorie']))) {
                                    echo "selected=\"selected\"";
                                }
                            ?>
                            >Print</option>
                        </select>
                </div>
        
                <br>
                <div>
                    <input type="hidden" name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
                    <br>
                    <button type="submit" class="btn btn-info">MAJ</button>
                </div>
        </form>
    </div>


    </div> <!-- fin div container2 -->
<?php require 'inc/footer.php'; ?>

<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>