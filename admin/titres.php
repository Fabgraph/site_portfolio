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









    // insertion d'un titre
    if(isset($_POST['titre'])){// si on a reçu un nouveau titre
        if($_POST['titre']!=''){

            $titre = addslashes ($_POST['titre']);
            $accroche = addslashes ($_POST['accroche']);
            $pdoCV->exec(" INSERT INTO t_titres VALUES (NULL, '$titre', '$accroche', '$id_utilisateur') ");

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
    <?php 
        // requête pour une seule info
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
        $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Admin : les  titres <?php echo $ligne_utilisateur['prenom'] ?></title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    
    <div class="container  fond-container">
        <h1 class="text-center text-white">Admin : les titres</h1>
        <div class="container2">
        <?php
            // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_titres WHERE id_utilisateur = '$id_utilisateur' $order  ");
            $sql->execute();
            $nbr_titres = $sql->rowCount();
        ?>
            <div class="table-responsive">
                <table class="table">
                <caption class="text-white">La liste des titres : <?php echo $nbr_titres; ?></caption>
                    <thead>
                        <tr>
                            <th class="table-dark text-primary">Titre
                            <a href="titres.php?column=titre&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> | 
                            <a href="titres.php?column=titre&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                            </th>
                            <th class="table-dark text-primary">Accroche</th>
                            <th class="table-dark text-primary">Modification</th>
                            <th class="table-dark text-primary">Suppression</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($ligne_titre=$sql->fetch())
                            {
                        ?>
                        <tr class="table-warning text-info">
                            <td><?php echo $ligne_titre['titre']; ?></td>
                            <td><?php echo $ligne_titre['accroche']; ?></td>
                            <td><a href="modif_titre.php?id_titre=<?php echo $ligne_titre['id_titre']; ?>"><i class="fas fa-edit"></i></a></td>
                            <td><a href="titres.php?id_titre=<?php echo $ligne_titre['id_titre']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
        </div>
    </div>

    <div class="container">                  
        <hr class="bg-dark mx-auto" style="width: 100%; height: 1%; color: rgb(0, 0, 0);">
    </div>
    <div class="row"></div>
            <div class="container">
                <div class="form-row">
                    <div class="col-sm-0 col-md-4 col-lg-4"></div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <form action="titres.php" method="post" class="col-auto">
                            <div class="form-group">
                                <label for="titre" class="text-white">Titre</label>
                                <input type="text" name="titre" placeholder="Nouveau titre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="accroche" class="text-white">Accroche</label>
                                <div>
                                    <textarea name="accroche" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-info">Insérer un Titre</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-0 col-md-4 col-lg-4"></div>
                </div>
            </div>
        </div>
    </div> <!-- fin de la div row -->


<?php require 'inc/footer.php'; ?>

<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>