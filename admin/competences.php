<?php require 'inc/connexion.php'; 
    // insertion d'un élément dans la base
    if(isset($_POST['competence'])){// si on a reçu un nouvelle compétence
        if($_POST['competence']!='' && $_POST['niveau']!='' && $_POST['categorie']!=''){

            $competence = addslashes ($_POST['competence']);
            $niveau = addslashes ($_POST['niveau']);
            $categorie = addslashes ($_POST['categorie']);
            $pdoCV->exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$niveau', '$categorie', '1') ");

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
    <title>Admin : les  compétences <?php echo $ligne_utilisateur['prenom'] ?></title>
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
    <h1 class="text-center text-white">Les compétences et insertion de nouvelles compétences</h1>
  
    <?php
        // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
        $sql = $pdoCV->prepare(" SELECT * FROM t_competences $order ");
        $sql->execute();
        $nbr_competences = $sql->rowCount();
    ?>

    <div class="">
        <table class="table">
        <caption class="text-white">La liste des compétences : <?php echo $nbr_competences; ?></caption>
            <thead>
                <tr> 
                    <th class="table-primary text-info">Compétences 
                    <a href="competences.php?column=competence&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> | 
                    <a href="competences.php?column=competence&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                    </th>
                    <th class="table-primary text-info">Niveau
                    <a href="competences.php?column=niveau&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> |
                    <a href="competences.php?column=niveau&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                    </th>
                    <th class="table-primary text-info">Catégorie
                    <a href="competences.php?column=categorie&order=desc"><i class="fas fa-arrow-alt-circle-up"></i></a> |
                    <a href="competences.php?column=categorie&order=asc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                    </th>
                    <th class="table-primary text-info">Modification</th>
                    <th class="table-primary text-info">Suppression</th>
                </tr>
            </thead>
            <tbody>
                <?php while($ligne_competence=$sql->fetch())
                    {
                ?>
                <tr class="table-info">
                    <td><?php echo $ligne_competence['competence']; ?></td>
                    <td ><?php echo $ligne_competence['niveau']; ?></td>
                    <td><?php echo $ligne_competence['categorie']; ?></td>
                    <td ><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>">modif</a></td>
                    <td><a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>">suppr</a></td>
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
        <form action="competences.php" method="post">
            <div class="form-group">
                <label for="competence">Compétence</label>
                <input type="text" name="competence" placeholder="Nouveau compétence" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="niveau">Niveau</label>
                <input type="text" name="niveau" placeholder="niveau en chiffre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <select name="categorie">
                    <option value="Développement">Développement</option>
                    <option value="Infographie">Infographie</option>
                    <option value="Front">Front</option>
                    <option value="Back">Back</option>
                </select>
            </div>
            <div class="">
                <button type="submit" class="btn btn-success">Insérer une compétence</button>
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