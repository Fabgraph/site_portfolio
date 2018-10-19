<?php require 'inc/connexion.php';

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

    
        // pour vider les variables de session on destroy
        if(isset($_GET['quitter'])){

            $_SESSION['connexion_admin']='';
            $_SESSION['id_utilisateur']='';
            $_SESSION['email']='';
            $_SESSION['nom']='';
            $_SESSION['mdp']='';

                unset($_SESSION['connexion_admin']); // unset détruit la variable connexion_admin
                session_destroy(); // on détruit la session

                header('location:../admin/authentification.php');
        }




    // insertion d'un loisir
    if(isset($_POST['loisir'])){// si on a reçu un nouveau loisir
        if($_POST['loisir']!=''){

            $loisir = addslashes ($_POST['loisir']);
            $pdoCV->exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '$id_utilisateur') ");

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
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
        $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Admin : les  loisirs <?php echo $ligne_utilisateur['prenom'] ?></title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid bg-primary">
        <div class="container2">
        <h1 class="text-center text-white">Les loisirs et insertion de nouveaux loisirs</h1>

        <?php
            // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_loisirs WHERE id_utilisateur = '$id_utilisateur' $order  ");
            $sql->execute();
            $nbr_loisirs = $sql->rowCount();
        ?>
            <div class="">
                <table class="table">
                <caption class="text-white">La liste des loisirs : <?php echo $nbr_loisirs; ?></caption>
                    <thead>
                        <tr>
                            <th class="table-dark text-info">Loisirs
                            <a href="loisirs.php?column=loisir&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> | 
                            <a href="loisirs.php?column=loisir&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                            </th>
                            <th class="table-dark text-info">Modification</th>
                            <th class="table-dark text-info">Suppression</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($ligne_loisir=$sql->fetch())
                            {
                        ?>
                        <tr class="table-warning text-info">
                            <td><?php echo $ligne_loisir['loisir']; ?></td>
                            <td><a href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>"><i class="fas fa-edit"></i></a></td>
                            <td><a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div> <!-- fin div container2 -->
    <hr class="bg-dark">
    <div class="container">
        <form action="loisirs.php" method="post">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="loisir" class="text-white" class="text-white">Loisir</label>
                        <input type="text" name="loisir" placeholder="Nouveau loisir" class="form-control" required>
                    </div>
                </div>
            </div> <!-- fin de la div row -->
            <div class="">
                <button type="submit" class="btn btn-info">Insérer un loisir</button>
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