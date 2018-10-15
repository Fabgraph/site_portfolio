<?php require 'inc/connexion.php';

    // insertion d'un titre
    if(isset($_POST['titre'])){// si on a reçu un nouveau titre
        if($_POST['titre']!=''){

            $titre = addslashes ($_POST['titre']);
            $accroche = addslashes ($_POST['accroche']);
            $pdoCV->exec(" INSERT INTO t_titres VALUES (NULL, '$titre', '$accroche', '1') ");

            header("location: ../admin/titres.php");
                exit();

        }// ferme le if n'est pas vide

    }// fermeture du if isset

    // suppression d'un titre de la BDD
    if(isset($_GET['id_titre'])){  // on récupère le titre dans l'url par son id

        $efface = $_GET[id_titre];  // je passe l'id dans une variable $efface

        $sql = " DELETE FROM t_titres WHERE id_titre = '$efface' ";  // delete de la base
        $pdoCV->query($sql);  // on peut le faire avec exec également

        header("location: ../admin/titres.php");
    }  // ferme le if isset pour la suppression


    // pour classer par ordre
    $order = '';
    if(isset($_GET['order']) && isset($_GET['column'])){

	    if($_GET['column'] == 'titre'){
		    $order = ' ORDER BY titre';
	    }
	

        //----------------
    
	    if($_GET['order'] == 'asc'){
		    $order.= ' ASC';
	    }
	        elseif($_GET['order'] == 'desc'){
		    $order.= ' DESC';
            }
    }

    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- lien feuille de style CSS -->
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
    <title>Admin : les  titres</title>
    <!-- lien Bootstarp -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <!-- lien Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid bg-info">
    <h1 class="text-center text-dark">Les titres et insertion de nouveaux titres</h1>

    <?php
        // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
        $sql = $pdoCV->prepare(" SELECT * FROM t_titres $order  ");
        $sql->execute();
        $nbr_titres = $sql->rowCount();
    ?>
    <div class="">
        <table class="table">
        <caption class="text-white">La liste des titres : <?php echo $nbr_titres; ?></caption>
            <thead>
                <tr>
                    <th class="table-primary text-dark">Titre
                    <a href="titres.php?column=titre&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> | 
                    <a href="titres.php?column=titre&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                    </th>
                    <th class="table-primary text-dark">Accroche</th>
                    <th class="table-primary text-dark">Modification</th>
                    <th class="table-primary text-dark">Suppression</th>
                </tr>
            </thead>
            <tbody>
                <?php while($ligne_titre=$sql->fetch())
                    {
                ?>
                <tr class="table-info">
                    <td><?php echo $ligne_titre['titre']; ?></td>
                    <td><?php echo $ligne_titre['accroche']; ?></td>
                    <td><a href="modif_titre.php?id_titre=<?php echo $ligne_titre['id_titre']; ?>">modif</a></td>
                    <td><a href="titres.php?id_titre=<?php echo $ligne_titre['id_titre']; ?>">suppr</a></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <hr class="bg-dark">
    <div class="">
        <form action="titres.php" method="post">
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" placeholder="Nouveau titre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="accroche">Accroche</label>
                <div>
                    <textarea name="accroche" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="">
                <button type="submit" class="btn btn-success">Insérer un Titre</button>
            </div>
        </form>
    </div>
</div>


<?php require 'inc/footer.php'; ?>

<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>