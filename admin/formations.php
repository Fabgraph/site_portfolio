<?php require 'connexion.php'; 
    // insertion d'un élément dans la base
    if(isset($_POST['titre_form'])){// si on a reçu un nouvelle formation
        if($_POST['titre_form']!='' && $_POST['stitre_form']!='' && $_POST['dates_form']!='' && $_POST['description_form']!=''){

            // $experience = addslashes ($_POST['experience']);
            $titre_form = addslashes ($_POST['titre_form']);
            $stitre_form = addslashes ($_POST['stitre_form']);
            $dates_form = addslashes ($_POST['dates_form']);
            $description_form = addslashes ($_POST['description_form']);
            $pdoCV->exec(" INSERT INTO t_formations VALUES (NULL, '$titre_form', '$stitre_form', '$dates_form', '$description_form', '1') ");

            header("location: ../admin/formations.php");
                exit();

        }// ferme le if n'est pas vide

    }// fermeture du if isset

    // suppression d'un élément de la BDD
    if(isset($_GET['id_formation'])){  // on récupère la formation dans l'url par son id

        $efface = $_GET[id_formation];  // je passe l'id dans une variable $efface

        $sql = " DELETE FROM t_formations WHERE id_formation = '$efface' ";  // delete de la base
        $pdoCV->query($sql);  // on peut le faire avec exec également

        header("location: ../admin/formations.php");
    }  // ferme le if isset pour la suppression

    // pour classer par ordre
    $order = '';
    if(isset($_GET['order']) && isset($_GET['column'])){

	    if($_GET['column'] == 'formation'){
		    $order = ' ORDER BY formation';
	    }
	        elseif($_GET['column'] = 'titre_form'){
		        $order = ' ORDER BY titre_form';
	        }
	        elseif($_GET['column'] == 'stitre_form'){
		        $order = ' ORDER BY stitre_form';
	        }
	        elseif($_GET['column'] == 'dates_form'){
		        $order = ' ORDER BY dates_form';
	        }
	        elseif($_GET['column'] == 'description_form'){
		        $order = ' ORDER BY stitre_form';
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
    <title>Admin : les  formations</title>
    <!-- lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <!-- lien feuille de style CSS -->
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid bg-primary">
    <h1 class="text-center text-white">Les formations et insertion de nouvelles formations</h1>
  
    <?php
        // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
        $sql = $pdoCV->prepare(" SELECT * FROM t_formations $order ");
        $sql->execute();
        $nbr_formations = $sql->rowCount();
    ?>

    <div class="">
        <table class="table">
        <caption>La liste des expériences : <?php echo $nbr_formations; ?></caption>
            <thead>
                <tr> 
                    <th class="table-dark">Titre
                    <a href="formations.php?column=titre&order=asc">A</a> |
                    <a href="formations.php?column=titre&order=desc">Z  </a>
                    </th>
                    <th class="table-dark">Sous-titre</th>
                    <th class="table-dark">Dates</th>
                    <th class="table-dark">Description</th>
                    <th class="table-dark">Modification</th>
                    <th class="table-dark">Suppression</th>
                </tr>
            </thead>
            <tbody>
                <?php while($ligne_formation=$sql->fetch())
                    {
                ?>
                <tr class="table-dark">
                    <td ><?php echo $ligne_formation['titre_form']; ?></td>
                    <td><?php echo $ligne_formation['stitre_form']; ?></td>
                    <td><?php echo $ligne_formation['dates_form']; ?></td>
                    <td><?php echo $ligne_formation['description_form']; ?></td>
                    <td ><a href="modif_formation.php?id_formation=<?php echo $ligne_formation['id_formation']; ?>">modif</a></td>
                    <td><a href="formations.php?id_formation=<?php echo $ligne_formation['id_formation']; ?>">suppr</a></td>
                </tr>
                <?php
                     }
                ?>
             </tbody>
        </table>
    </div>

    <hr>
    <!-- insertion d'une nouvelle compétence formulaire -->
    <form action="formations.php" method="post">
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre_form" placeholder="Titre de la formation" required>
        </div>
        <div class="form-group">
            <label for="stitre">Sous-titre</label>
            <input type="text" name="stitre_form" placeholder="Sous-titre de la formation" required>
        </div>
        <div class="form-group">
            <label for="dates">Dates</label>
            <input type="text" name="dates_form" placeholder="dates de la formation" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <div>
                <textarea name="description_form" cols="30" rows="10"></textarea>
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