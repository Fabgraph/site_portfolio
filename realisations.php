<?php require 'admin/inc/connexion.php'; 

    // insertion d'un élément dans la base
    if(isset($_POST['titre_real'])){// si on a reçu un nouvelle réalisation
        if($_POST['titre_real']!='' && $_POST['stitre_real']!='' && $_POST['dates_real']!='' && $_POST['description_real']!=''){

            $titre_real = addslashes ($_POST['titre_real']);
            $stitre_real = addslashes ($_POST['stitre_real']);
            $dates_real = addslashes ($_POST['dates_real']);
            $description_real = addslashes ($_POST['description_real']);
            $pdoCV->exec(" INSERT INTO t_realisations VALUES (NULL, '$titre_real', '$stitre_real', '$dates_real', '$description_real', '$id_utilisateur') ");

            header("location: ../front/realisations.php");
                exit();

        }// ferme le if n'est pas vide

    }// fermeture du if isset


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
    <?php 
        // requête pour une seule info
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1' ");
        $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Les  réalisations <?php echo $ligne_utilisateur['prenom'] ?></title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center text-warning titre">Les réalisations</h1>
	        <img src="img/realisations.jpg" class="img-responsive">
        </div>
    </div>
    <div class="container bg pt-4">
  
        <?php
            // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_realisations WHERE id_utilisateur = '1' $order ");
            $sql->execute();
            $nbr_realisations = $sql->rowCount();
        ?>

            <div class="table-responsive">
                <table class="table">
                <caption class="text-white">La liste des réalisations : <?php echo $nbr_realisations; ?></caption>
                    <thead>
                        <tr> 
                            <th class="table-dark text-info">Titre
                            <a href="realisations.php?column=titre&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> |
                            <a href="realisations.php?column=titre&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                            </th>
                            <th class="table-dark text-info">Sous-titre</th>
                            <th class="table-dark text-info">Date</th>
                            <th class="table-dark text-info">Description</th>
                            <th class="table-dark text-info">Modification</th>
                            <th class="table-dark text-info">Suppression</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($ligne_realisation=$sql->fetch())
                            {
                        ?>
                        <tr class="table-warning text-info">
                            <td ><?php echo $ligne_realisation['titre_real']; ?></td>
                            <td><?php echo $ligne_realisation['stitre_real']; ?></td>
                            <td><?php echo $ligne_realisation['dates_real']; ?></td>
                            <td><?php echo $ligne_realisation['description_real']; ?></td>
                            <td ><a href="modif_realisation.php?id_realisation=<?php echo $ligne_realisation['id_realisation']; ?>"><i class="fas fa-edit"></i></a></td>
                            <td><a href="realisations.php?id_realisation=<?php echo $ligne_realisation['id_realisation']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>

    <hr class="bg-dark">
   
</div> <!-- fin container -->


<?php require 'inc/footer.php'; ?> 
   <!-- liens js Bootstrap -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>