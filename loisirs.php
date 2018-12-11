<?php require 'admin/inc/connexion.php';

    // insertion d'un loisir
    if(isset($_POST['loisir'])){// si on a reçu un nouveau loisir
        if($_POST['loisir']!=''){

            $loisir = addslashes ($_POST['loisir']);
            $pdoCV->exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '$id_utilisateur') ");

            header("location: ../front/loisirs.php");
                exit();

        }// ferme le if n'est pas vide

    }// fermeture du if isset


    // pour classer par ordre
    $order = '';
    if(isset($_GET['order']) && isset($_GET['column'])){

	    if($_GET['column'] == 'loisir'){
		    $order = ' ORDER BY loisir';
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
    <title>Les  loisirs <?php echo $ligne_utilisateur['prenom'] ?></title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid">
        <div class="row margin-top">
            <h1 class="text-warning titre mx-auto pt-5">Les loisirs</h1>
	        <img src="img/loisirs.jpg" class="img-responsive">
        </div>
    </div>
    <div class="container bg">

        <?php
            // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_loisirs WHERE id_utilisateur = '1' $order  ");
            $sql->execute();
            $nbr_loisirs = $sql->rowCount();
        ?>
            <div class="table-responsive">
                <table class="table">
                <caption class="text-white">La liste des loisirs : <?php echo $nbr_loisirs; ?></caption>
                    <thead>
                        <tr>
                            <th class="table-dark text-info">Loisirs
                            <a href="loisirs.php?column=loisir&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> | 
                            <a href="loisirs.php?column=loisir&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($ligne_loisir=$sql->fetch())
                            {
                        ?>
                        <tr class="table-warning text-info">
                            <td><?php echo $ligne_loisir['loisir']; ?></td>
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