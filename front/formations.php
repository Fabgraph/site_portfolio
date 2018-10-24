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
    
                header('location:../front/authentification.php');
        }


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
    <?php 
        // requête pour une seule info
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
        $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Admin : les  formations <?php echo $ligne_utilisateur['prenom'] ?></title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid">
        <div class="container2">
        <h1 class="text-center text-white">Les formations et insertion de nouvelles formations</h1>
  
        <?php
            // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_formations WHERE id_utilisateur = '$id_utilisateur' $order ");
            $sql->execute();
            $nbr_formations = $sql->rowCount();
        ?>

        <div class="">
            <table class="table">
            <caption class="text-white">La liste des expériences : <?php echo $nbr_formations; ?></caption>
                <thead>
                    <tr> 
                        <th class="table-dark text-info">Titre
                        <a href="formations.php?column=titre&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> |
                        <a href="formations.php?column=titre&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                        </th>
                        <th class="table-dark text-info">Sous-titre</th>
                        <th class="table-dark text-info">Dates</th>
                        <th class="table-dark text-info">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($ligne_formation=$sql->fetch())
                        {
                    ?>
                    <tr class="table-warning text-info">
                        <td ><?php echo $ligne_formation['titre_form']; ?></td>
                        <td><?php echo $ligne_formation['stitre_form']; ?></td>
                        <td><?php echo $ligne_formation['dates_form']; ?></td>
                        <td><?php echo $ligne_formation['description_form']; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div> <!-- fin de la div container2 -->

    <hr class="bg-dark">
    <div class="container">
        <!-- insertion d'une nouvelle compétence formulaire -->
        <form action="formations.php" method="post">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="titre" class="text-white">Titre</label>
                        <input type="text" name="titre_form" placeholder="Titre de la formation" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="stitre" class="text-white">Sous-titre</label>
                        <input type="text" name="stitre_form" placeholder="Sous-titre de la formation" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="dates" class="text-white">Dates</label>
                        <input type="text" name="dates_form" placeholder="dates de la formation" class="form-control" required>
                    </div>
                </div>
            </div> <!-- fin de la div row -->
            <div class="form-group">
                <label for="description" class="text-white">Description</label>
                <div>
                    <textarea type="text" class="form-control" name="description_form" id="description_form" cols="30" rows="10"></textarea>
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'description_form' );
                    </script>
                </div>
            </div>
         
            <div class="">
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