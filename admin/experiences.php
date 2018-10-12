<?php require 'connexion.php'; 
    // insertion d'un élément dans la base
    if(isset($_POST['titre_exp'])){// si on a reçu un nouvelle expérience
        if($_POST['titre_exp']!='' && $_POST['stitre_exp']!='' && $_POST['dates_exp']!='' && $_POST['description_exp']!=''){

            // $experience = addslashes ($_POST['experience']);
            $titre_exp = addslashes ($_POST['titre_exp']);
            $stitre_exp = addslashes ($_POST['stitre_exp']);
            $dates_exp = addslashes ($_POST['dates_exp']);
            $description_exp = addslashes ($_POST['description_exp']);
            $pdoCV->exec(" INSERT INTO t_experiences VALUES (NULL, '$titre_exp', '$stitre_exp', '$dates_exp', '$description_exp', '1') ");

            header("location: ../admin/experiences.php");
                exit();

        }// ferme le if n'est pas vide

    }// fermeture du if isset

    // suppression d'un élément de la BDD
    if(isset($_GET['id_experience'])){  // on récupère l'expérience dans l'url par son id

        $efface = $_GET[id_experience];  // je passe l'id dans une variable $efface

        $sql = " DELETE FROM t_experiences WHERE id_experience = '$efface' ";  // delete de la base
        $pdoCV->query($sql);  // on peut le faire avec exec également

        header("location: ../admin/experiences.php");
    }  // ferme le if isset pour la suppression

    // pour classer par ordre
    $order = '';
    if(isset($_GET['order']) && isset($_GET['column'])){

	    if($_GET['column'] == 'experience'){
		    $order = ' ORDER BY experience';
	    }
	        elseif($_GET['column'] = 'titre_exp'){
		        $order = ' ORDER BY titre_exp';
	        }
	        elseif($_GET['column'] == 'stitre_exp'){
		        $order = ' ORDER BY stitre_exp';
	        }
	        elseif($_GET['column'] == 'dates_exp'){
		        $order = ' ORDER BY dates_exp';
	        }
	        elseif($_GET['column'] == 'description_exp'){
		        $order = ' ORDER BY stitre_exp';
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
    <title>Admin : les  expériences</title>
    <!-- lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <!-- lien feuille de style CSS -->
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid bg-primary">
    <h1 class="text-center text-white">Les expériences et insertion de nouvelles expériences</h1>
  
    <?php
        // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
        $sql = $pdoCV->prepare(" SELECT * FROM t_experiences $order ");
        $sql->execute();
        $nbr_experiences = $sql->rowCount();
    ?>

    <div class="">
        <table class="table">
        <caption>La liste des expériences : <?php echo $nbr_experiences; ?></caption>
            <thead>
                <tr> 
                    <th class="table-dark">Titre
                    <a href="experiences.php?column=dates&order=asc">A</a> |
                    <a href="experiences.php?column=dates&order=desc">Z  </a>
                    </th>
                    <th class="table-dark">Sous-titre</th>
                    <th class="table-dark">Dates</th>
                    <th class="table-dark">Description</th>
                    <th class="table-dark">Modification</th>
                    <th class="table-dark">Suppression</th>
                </tr>
            </thead>
            <tbody>
                <?php while($ligne_experience=$sql->fetch())
                    {
                ?>
                <tr class="table-dark">
                    <td ><?php echo $ligne_experience['titre_exp']; ?></td>
                    <td><?php echo $ligne_experience['stitre_exp']; ?></td>
                    <td><?php echo $ligne_experience['dates_exp']; ?></td>
                    <td><?php echo $ligne_experience['description_exp']; ?></td>
                    <td ><a href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>">modif</a></td>
                    <td><a href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>">suppr</a></td>
                </tr>
                <?php
                     }
                ?>
             </tbody>
        </table>
    </div>

    <hr>
    <!-- insertion d'une nouvelle compétence formulaire -->
    <form action="experiences.php" method="post">
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre_exp" placeholder="Titre du poste" required>
        </div>
        <div class="form-group">
            <label for="stitre">Sous-titre</label>
            <input type="text" name="stitre_exp" placeholder="Sous-titre du poste" required>
        </div>
        <div class="form-group">
            <label for="dates">Dates</label>
            <input type="text" name="dates_exp" placeholder="dates du poste" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <div>
                <textarea name="description_exp" cols="30" rows="10"></textarea>
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