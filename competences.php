<?php require 'admin/inc/connexion.php'; 

    // pour classer par ordre
    $order = '';
    if(isset($_GET['order']) && isset($_GET['column'])){

	    if($_GET['column'] == 'competence'){
		    $order = ' ORDER BY competence';
	    }
	        elseif($_GET['column'] = 'niveau'){
		        $order = ' ORDER BY niveau';
	        }
	        elseif($_GET['column'] == 'categorie'){
		        $order = ' ORDER BY categorie';
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
    <title>Les  compétences <?php echo $ligne_utilisateur['prenom'] ?></title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-warning titre mx-auto pt-5">Les compétences</h1>
	        <img src="img/competences.jpg" class="img-responsive">
        </div>
    </div>

    <div class="container bg mt-5">

        <?php
            // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_competences WHERE id_utilisateur = '1' $order ");
            $sql->execute();
            $nbr_competences = $sql->rowCount();
        ?>
        
                    <table class="table">
                    <caption class="text-white">La liste des compétences : <?php echo $nbr_competences; ?></caption>
                        <thead>
                            <tr> 
                                <th class="table-dark text-info">Compétences 
                                <a href="competences.php?column=competence&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> | 
                                <a href="competences.php?column=competence&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                </th>
                                <th class="table-dark text-info">Niveau
                                <a href="competences.php?column=niveau&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> |
                                <a href="competences.php?column=niveau&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                </th>
                                <th class="table-dark text-info">Catégories
                                <a href="competences.php?column=categorie&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> |
                                <a href="competences.php?column=categorie&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($ligne_competence=$sql->fetch())
                                {
                            ?>
                            <tr class="table-warning">
                                <td class="text-info"><?php echo $ligne_competence['competence']; ?></td>
                                <td class="text-info"><?php echo $ligne_competence['niveau']; ?></td>
                                <td class="text-info"><?php echo $ligne_competence['categorie']; ?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
        
    <hr class="bg-dark">
    
</div> <!-- fin container -->

<?php require 'inc/footer.php'; ?> 
<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>