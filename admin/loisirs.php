<?php require 'connexion.php';

    // insertion d'un loisir
    if(isset($_POST['loisir'])){// si on a reçu un nouveau loisir
        if($_POST['loisir']!=''){

            $loisir = addslashes ($_POST['loisir']);
            $pdoCV->exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '1') ");

            header("location: ../admin/loisirs.php");
                exit();

        }// ferme le if n'est pas vide

    }// fermeture du if isset

    // suppression d'un loisir de la BDD
    if(isset($_GET['id_loisir'])){  // on récupère le loisir dans l'url par son id

        $efface = $_GET[id_loisir];  // je passe l'id dans une variable $efface

        $sql = " DELETE FROM t_loisirs WHERE id_loisir = '$efface' ";  // delete de la base
        $pdoCV->query($sql);  // on peut le faire avec exec également

        header("location: ../admin/loisirs.php");
    }  // ferme le if isset pour la suppression
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- lien feuille de style CSS -->
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <title>Admin : les  loisirs</title>
    <!-- lien Bootstarp -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <h1>Les loisirs et insertion de nouveaux loisirs</h1>

    <?php
        // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
        $sql = $pdoCV->prepare(" SELECT * FROM t_loisirs  ");
        $sql->execute();
        $nbr_loisirs = $sql->rowCount();
    ?>
    <div class="">
        <table class="table">
        <caption>La liste des loisirs : <?php echo $nbr_loisirs; ?></caption>
            <thead>
                <tr>
                    <th class="table-dark">Loisirs</th>
                    <th class="table-dark">Modification</th>
                    <th class="table-dark">Suppression</th>
                </tr>
            </thead>
            <tbody>
                <?php while($ligne_loisir=$sql->fetch())
                    {
                ?>
                <tr class="table-dark">
                    <td><?php echo $ligne_loisir['loisir']; ?></td>
                    <td><a href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>">modif</a></td>
                    <td><a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>">suppr</a></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

<hr>
<form action="loisirs.php" method="post">
    <div class="form-group">
        <label for="loisir">Loisir</label>
        <input type="text" name="loisir" placeholder="Nouveau loisir" required>
    </div>
    <div class="">
        <button type="submit" class="btn btn-primary">Insérer un loisir</button>
    </div>
</form>


<?php require 'inc/footer.php'; ?>

<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>