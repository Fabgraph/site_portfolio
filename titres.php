<?php require 'admin/inc/connexion.php';

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
    <?php 
        // requête pour une seule info
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1' ");
        $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Les  titres <?php echo $ligne_utilisateur['prenom'] ?></title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <h1 class="text-center text-warning titre">Les titres</h1>
	        <img src="img/titres.jpg" class="img-responsive">
        </div>
    </div>
    <div class="container bg pt-6">

        <?php
            // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_titres WHERE id_utilisateur = '1' $order  ");
            $sql->execute();
            $nbr_titres = $sql->rowCount();
        ?>
            <div class="table-responsive">
                <table class="table">
                <caption class="text-white">La liste des titres : <?php echo $nbr_titres; ?></caption>
                    <thead>
                        <tr>
                            <th class="table-dark text-info">Titre
                            <a href="titres.php?column=titre&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> | 
                            <a href="titres.php?column=titre&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                            </th>
                            <th class="table-dark text-info">Accroche</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($ligne_titre=$sql->fetch())
                            {
                        ?>
                        <tr class="table-warning text-info">
                            <td><?php echo $ligne_titre['titre']; ?></td>
                            <td><?php echo $ligne_titre['accroche']; ?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>


    <hr class="bg-dark">
    
</div> <!-- fin de la div container -->


<?php require 'inc/footer.php'; ?>

<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>