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
    if(isset($_POST['competence'])){// si on a reçu un nouvelle compétence
        if($_POST['competence']!='' && $_POST['niveau']!='' && $_POST['categorie']!=''){

            $competence = addslashes ($_POST['competence']);
            $niveau = addslashes ($_POST['niveau']);
            $categorie = addslashes ($_POST['categorie']);
            $pdoCV->exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$niveau', '$categorie', '$id_utilisateur') ");

            header("location: ../admin/competences.php");
                exit();

        }// ferme le if n'est pas vide

    }// fermeture du if isset

    // suppression d'un élément de la BDD
    if(isset($_GET['id_competence'])){  // on récupère la compétence dans l'url par son id

        $efface = $_GET[id_competence];  // je passe l'id dans une variable $efface

        $sql = " DELETE FROM t_competences WHERE id_competence = '$efface' ";  // delete de la base
        $pdoCV->query($sql);  // on peut le faire avec exec également

        header("location: ../admin/competences.php");
    }  // ferme le if isset pour la suppression

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
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' ");
        $ligne_utilisateur = $sql->fetch();
    ?>
    <title>Admin : les  compétences <?php echo $ligne_utilisateur['prenom'] ?></title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid bg-primary">
        <div class="container2">
        <h1 class="text-center text-white">Les compétences et insertion de nouvelles compétences</h1>
  
        <?php
            // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_competences WHERE id_utilisateur = '$id_utilisateur' $order ");
            $sql->execute();
            $nbr_competences = $sql->rowCount();
        ?>

            <div class="">
        
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
                                <th class="table-dark text-info">Catégorie
                                <a href="competences.php?column=categorie&order=desc"><i class="fas fa-arrow-alt-circle-up"></i></a> |
                                <a href="competences.php?column=categorie&order=asc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                </th>
                                <th class="table-dark text-info">Modification</th>
                                <th class="table-dark text-info">Suppression</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($ligne_competence=$sql->fetch())
                                {
                            ?>
                            <tr class="table-primary">
                                <td class="text-info"><?php echo $ligne_competence['competence']; ?></td>
                                <td class="text-info"><?php echo $ligne_competence['niveau']; ?></td>
                                <td class="text-info"><?php echo $ligne_competence['categorie']; ?></td>
                                <td class="text-info"><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>"><i class="fas fa-edit"></i></a></td>
                                <td class="text-info"><a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>"><i class="fas fa-trash-alt"></i></a></td>
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
            <!-- insertion d'une nouvelle compétence formulaire -->
            <form action="competences.php" method="post">
            <div class="row">
                <div class=" col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="competence" class="text-white">Compétence</label>
                        <input type="text" name="competence" placeholder="Nouveau compétence" class="form-control" required>
                    </div>
                </div> <!-- fin de la div col -->
                <div class=" col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="niveau" class="text-white">Niveau</label>
                        <input type="text" name="niveau" placeholder="niveau en chiffre" class="form-control" required>
                    </div>
                </div> <!-- fin de la div col -->
                </div>
                <div class="form-group">
                    <label for="categorie" class="text-white">Catégorie</label>
                    <select name="categorie">
                        <option value="Développement">Développement</option>
                        <option value="Infographie">Infographie</option>
                        <option value="Front">Front</option>
                        <option value="Back">Back</option>
                    </select>
                </div>
                <div class="mgbutton">
                    <button type="submit" class="btn btn-info">Insérer une compétence</button>
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