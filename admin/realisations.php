<?php require 'connexion.php'; 
    // insertion d'un élément dans la base
    if(isset($_POST['titre_real'])){// si on a reçu un nouvelle compétence
        if($_POST['titre_real']!='' && $_POST['stitre_real']!='' && $_POST['dates_real']!='' && $_POST['description_real']!=''){

            // $experience = addslashes ($_POST['experience']);
            $titre_real = addslashes ($_POST['titre_real']);
            $stitre_real = addslashes ($_POST['stitre_real']);
            $dates_real = addslashes ($_POST['dates_real']);
            $description_real = addslashes ($_POST['description_real']);
            $pdoCV->exec(" INSERT INTO t_realisations VALUES (NULL, '$titre_real', '$stitre_real', '$dates_real', '$description_real', '1') ");

            header("location: ../admin/realisations.php");
                exit();

        }// ferme le if n'est pas vide

    }// fermeture du if isset

    // suppression d'un élément de la BDD
    if(isset($_GET['id_realisation'])){  // on récupère la compétence dans l'url par son id

        $efface = $_GET[id_realisation];  // je passe l'id dans une variable $efface

        $sql = " DELETE FROM t_realisations WHERE id_realisation = '$efface' ";  // delete de la base
        $pdoCV->query($sql);  // on peut le faire avec exec également

        header("location: ../admin/realisations.php");
    }  // ferme le if isset pour la suppression

    // pour classer par ordre
    $order = '';
    if(isset($_GET['order']) && isset($_GET['column'])){

	    if($_GET['column'] == 'realisation'){
		    $order = ' ORDER BY realisation';
	    }
	        elseif($_GET['column'] = 'titre_real'){
		        $order = ' ORDER BY titre_real';
	        }
	        elseif($_GET['column'] == 'stitre_real'){
		        $order = ' ORDER BY stitre_real';
	        }
	        elseif($_GET['column'] == 'dates_real'){
		        $order = ' ORDER BY dates_real';
	        }
	        elseif($_GET['column'] == 'description_real'){
		        $order = ' ORDER BY stitre_real';
	        }

	//----------------

	    if($_GET['order'] == 'asc'){
		    $order.= ' ASC';
	    }
	        elseif($_GET['order'] == 'desc'){
		        $order.= ' DESC';
            }
    }

    // //je préprare la requete puis je l'execute (tri en fonction de ce qu'il y a dans l'url)

    // $queryUsers = $pdoCV -> prepare('SELECT * FROM t_competences');

    // if($queryUsers->execute()){	

	//     $users = $queryUsers ->fetchAll(PDO::FETCH_ASSOC);   
    // }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : les  réalisations</title>
    <!-- lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <!-- lien feuille de style CSS -->
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid bg-primary">
    <h1 class="text-center text-white">Les réalisations et insertion de nouvelles réalisations</h1>
  
    <?php
        // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
        $sql = $pdoCV->prepare(" SELECT * FROM t_realisations $order ");
        $sql->execute();
        $nbr_realisations = $sql->rowCount();
    ?>

    <div class="">
        <table class="table">
        <caption>La liste des expériences : <?php echo $nbr_realisations; ?></caption>
            <thead>
                <tr> 
                    <th class="table-dark">Titre
                    <a href="realisations.php?column=titre&order=asc">A</a> |
                    <a href="realisations.php?column=titre&order=desc">Z  </a>
                    </th>
                    <th class="table-dark">Sous-titre</th>
                    <th class="table-dark">Date</th>
                    <th class="table-dark">Description</th>
                    <th class="table-dark">Modification</th>
                    <th class="table-dark">Suppression</th>
                </tr>
            </thead>
            <tbody>
                <?php while($ligne_realisation=$sql->fetch())
                    {
                ?>
                <tr class="table-dark">
                    <td ><?php echo $ligne_realisation['titre_real']; ?></td>
                    <td><?php echo $ligne_realisation['stitre_real']; ?></td>
                    <td><?php echo $ligne_realisation['dates_real']; ?></td>
                    <td><?php echo $ligne_realisation['description_real']; ?></td>
                    <td ><a href="modif_realisation.php?id_realisation=<?php echo $ligne_realisation['id_realisation']; ?>">modif</a></td>
                    <td><a href="realisations.php?id_realisation=<?php echo $ligne_realisation['id_realisation']; ?>">suppr</a></td>
                </tr>
                <?php
                     }
                ?>
             </tbody>
        </table>
    </div>

    <hr>
    <!-- insertion d'une nouvelle compétence formulaire -->
    <form action="realisations.php" method="post">
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre_real" placeholder="Titre de la réalisation" required>
        </div>
        <div class="form-group">
            <label for="stitre">Sous-titre</label>
            <input type="text" name="stitre_real" placeholder="Sous-titre de la réalisation" required>
        </div>
        <div class="form-group">
            <label for="dates">Dates</label>
            <input type="text" name="dates_real" placeholder="dates de la réalisation" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <div>
                <textarea name="description_real" cols="30" rows="10"></textarea>
            </div>
        </div>
         
        <div class="">
            <button type="submit" class="btn btn-info">Insérer une expérience</button>
        </div>
    </form>

</div>


<?php require 'inc/footer.php'; ?> 
   <!-- liens js Bootstrap -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>