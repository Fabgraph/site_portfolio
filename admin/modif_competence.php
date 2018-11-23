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
    <div class="container fond-container p-4 ">
        <div class="row p-4">
            <div class="col">
                <h1 class="text-center">Mise à jour d'une compétence</h1>
            </div>
        </div> <!-- fin de la row 1 -->
        <div class="row p-4">
            <div class="col-2"><i class="fas fa-highlighter"></i></div>
            <div class="col-8">
                <!-- mise à jour formulaire -->
                <form action="modif_competence.php" method="post" class="col-auto">
                    <div class="form-row">
                
                        <div class="col">
                            <label for="competence" class="">Compétence</label>
                            <input type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="niveau" class="">Niveau</label>
                            <input type="text" name="niveau" value="<?php echo $ligne_competence['niveau']; ?>" class="form-control" required>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="categorie" class="">Catégorie</label>
                                <select name="categorie" class="form-control">
                                    <option value="Print" <?php // pour ajouter selected="selected" à la balise option si c'est la cat. de la compétence
                                    if (!(strcmp("Print", $ligne_competence['categorie']))) {//strcmp compare deux chaînes de caractères
                                    echo "selected=\"selected\"";
                                    }
                                    ?>>Print</option>
                                    <option value="Web" <?php
                                    if (!(strcmp("Web", $ligne_competence['categorie']))) {
                                    echo "selected=\"selected\"";   
                                    }
                                    ?>>Web</option>
                                </select>
                            </div>
                        </div>
                    </div> <!-- fin form-row -->
                    <input type="hidden" name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
                    <button type="submit" class="btn btn-success">MAJ</button>
                </form>
            </div>
            <div class="col fond-col-vide"></div>
        </div> <!-- fin row 2 -->
    </div> <!-- fin div container -->

    <?php require 'inc/footer.php'; ?>

<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>