<?php require 'inc/connexion.php'; 
    // insertion d'un élément dans la base
    if(isset($_POST['titre_real'])){// si on a reçu un nouvelle réalisation
        if($_POST['titre_real']!='' && $_POST['stitre_real']!='' && $_POST['dates_real']!='' && $_POST['description_real']!=''){

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
    if(isset($_GET['id_realisation'])){  // on récupère la réalisation dans l'url par son id

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


    session_start();// à mettre dans toutes les pages de l'admin

    if(isset($_SESSION['connexion_admin'])){// si on est connecté on récupère les variables de session
        $id_utilisateur=$_SESSION['id_utilisateur'];
        $email=$_SESSION['email'];
        $mdp=$_SESSION['mdp'];
        $nom=$_SESSION['nom'];

        // echo $id_utilisateur;
    } else {// si on n'est pas connecté on ne peut pas accéder à l'index d'admin
        header('location:authentification.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php 
        // requête pour une seule info
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
        $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Admin : les  réalisations <?php echo $ligne_utilisateur['prenom'] ?></title>
    <!-- lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <!-- lien Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <!-- lien feuille de style CSS -->
    <link type="text/css" rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid bg-primary">
    <h1 class="text-center text-dark">Les réalisations et insertion de nouvelles réalisations</h1>
  
    <?php
        // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
        $sql = $pdoCV->prepare(" SELECT * FROM t_realisations $order ");
        $sql->execute();
        $nbr_realisations = $sql->rowCount();
    ?>

    <div class="">
        <table class="table">
        <caption class="text-white">La liste des expériences : <?php echo $nbr_realisations; ?></caption>
            <thead>
                <tr> 
                    <th class="table-primary text-info">Titre
                    <a href="realisations.php?column=titre&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> |
                    <a href="realisations.php?column=titre&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                    </th>
                    <th class="table-primary text-info">Sous-titre</th>
                    <th class="table-primary text-info">Date</th>
                    <th class="table-primary text-info">Description</th>
                    <th class="table-primary text-info">Modification</th>
                    <th class="table-primary text-info">Suppression</th>
                </tr>
            </thead>
            <tbody>
                <?php while($ligne_realisation=$sql->fetch())
                    {
                ?>
                <tr class="table-info">
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

    <hr class="bg-dark">
    <div class="">
        <!-- insertion d'une nouvelle compétence formulaire -->
        <form action="realisations.php" method="post">
            <div class="form-group">
                <label for="titre" class="text-white">Titre</label>
                <input type="text" name="titre_real" placeholder="Titre de la réalisation" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="stitre" class="text-white">Sous-titre</label>
                <input type="text" name="stitre_real" placeholder="Sous-titre de la réalisation" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="dates" class="text-white">Dates</label>
                <input type="text" name="dates_real" placeholder="dates de la réalisation" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description" class="text-white">Description</label>
            </div>
            <div>
                <textarea name="description_real" cols="30" rows="10"></textarea>
            </div>
            
         
            <div class="">
                <button type="submit" class="btn btn-success">Insérer une expérience</button>
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