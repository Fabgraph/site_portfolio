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






    // insertion d'un élément dans la base
    if(isset($_POST['titre_exp'])){// si on a reçu un nouvelle expérience
        if($_POST['titre_exp']!='' && $_POST['stitre_exp']!='' && $_POST['dates_exp']!='' && $_POST['description_exp']!=''){

            // $experience = addslashes ($_POST['experience']);
            $titre_exp = addslashes ($_POST['titre_exp']);
            $stitre_exp = addslashes ($_POST['stitre_exp']);
            $dates_exp = addslashes ($_POST['dates_exp']);
            $description_exp = addslashes ($_POST['description_exp']);
            $pdoCV->exec(" INSERT INTO t_experiences VALUES (NULL, '$titre_exp', '$stitre_exp', '$dates_exp', '$description_exp', '$id_utilisateur') ");

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
    <?php 
        // requête pour une seule info
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
        $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Admin : les  expériences <?php echo $ligne_utilisateur['prenom'] ?></title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    
    <div class="container fond-container">
        <h1 class="text-center text-white">Admin : les expériences</h1>
        <div class="row p-2">
        <?php
            // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_experiences WHERE id_utilisateur = '$id_utilisateur' $order ");
            $sql->execute();
            $nbr_experiences = $sql->rowCount();
        ?>

            <div style="overflow-x:auto;">
                <table class="table">
                <caption class="text-white">La liste des expériences : <?php echo $nbr_experiences; ?></caption>
                    <thead>
                        <tr> 
                            <th class="table-dark text-primary">Titre
                            <a href="experiences.php?column=titre_exp&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> |
                            <a href="experiences.php?column=titre_exp&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                            </th>
                            <th class="table-dark text-primary">Sous-titre</th>
                            <th class="table-dark text-primary">Dates</th>
                            <th class="table-dark text-primary">Description</th>
                            <th class="table-dark text-primary">Modification</th>
                            <th class="table-dark text-primary">Suppression</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($ligne_experience=$sql->fetch())
                            {
                        ?>
                        <tr class="table-warning text-info">
                            <td ><?php echo $ligne_experience['titre_exp']; ?></td>
                            <td><?php echo $ligne_experience['stitre_exp']; ?></td>
                            <td><?php echo $ligne_experience['dates_exp']; ?></td>
                            <td><?php echo $ligne_experience['description_exp']; ?></td>
                            <td ><a href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>"><i class="fas fa-edit"></i></a></td>
                            <td><a href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>  <!-- fin div container2 -->
    <div class="container pl-2 pr-2">                  
        <hr class="bg-dark mx-auto" style="width: 100%; height: 1%; color: rgb(0, 0, 0);">
    </div>
    <div class="container fond_container">
        <!-- insertion d'une nouvelle compétence formulaire -->
        <form action="experiences.php" method="post" class="col-auto">
            <div class="form-row">
                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="titre" class="text-white">Titre</label>
                        <input type="text" name="titre_exp" placeholder="Titre du poste" class="form-control" required>
                    </div>
                </div>
                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="stitre" class="text-white">Sous-titre</label>
                        <input type="text" name="stitre_exp" placeholder="Sous-titre du poste" class="form-control" required>
                    </div>
                </div>
                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="dates" class="text-white">Dates</label>
                        <input type="text" name="dates_exp" placeholder="dates du poste" class="form-control" required>
                    </div>
                </div>
            </div> <!-- fin de la div form-row -->
            <div class="form-row">
                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label for="description" class="text-white">Description</label>
                        <div>
                            <textarea name="description_exp" class="form-control" cols="109" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div> <!-- fin de la div form-row -->
         
            <div class="form-row">
                <button type="submit" class="btn btn-info">Insérer une expérience</button>
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