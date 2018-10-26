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
    if(isset($_POST['nom'])){// si on a reçu un nouvelle compétence
        if($_POST['nom']!='' && $_POST['email']!='' && $_POST['sujet']!='' && $_POST['message']!=''){

            $nom = addslashes ($_POST['nom']);
            $email = addslashes ($_POST['email']);
            $sujet = addslashes ($_POST['sujet']);
            $message = addslashes ($_POST['message']);
            $pdoCV->exec(" INSERT INTO t_messages VALUES (NULL, '$nom', '$email', '$sujet', '$message') ");

            header("location: ../admin/messages.php");
                exit();

        }// ferme le if n'est pas vide

    }// fermeture du if isset

    // suppression d'un élément de la BDD
    if(isset($_GET['id_message'])){  // on récupère le message dans l'url par son id

        $efface = $_GET[id_message];  // je passe l'id dans une variable $efface

        $sql = " DELETE FROM t_messages WHERE id_message = '$efface' ";  // delete de la base
        $pdoCV->query($sql);  // on peut le faire avec exec également

        header("location: ../admin/messages.php");
    }  // ferme le if isset pour la suppression

    // pour classer par ordre
    $order = '';
    if(isset($_GET['order']) && isset($_GET['column'])){

	    if($_GET['column'] == 'message'){
		    $order = ' ORDER BY message';
	    }
	        elseif($_GET['column'] = 'nom'){
		        $order = ' ORDER BY nom';
	        }
	        elseif($_GET['column'] == 'email'){
		        $order = ' ORDER BY email';
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
        $sql = $pdoCV->query(" SELECT * FROM t_messages WHERE id_message ");
        $ligne_message = $sql->fetch();
    ?>
    <title>Admin : les  messages</title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid">
        <div class="container2">
        <h1 class="text-center text-warning">Les messages et insertion de nouvelles messages</h1>
  
        <?php
            // requête pour compter et chercher plusieurs enregistrements on ne peut compter que si on a prépare
            $sql = $pdoCV->prepare(" SELECT * FROM t_messages $order ");
            $sql->execute();
            $nbr_messages = $sql->rowCount();
        ?>

            <div class="">
        
                    <table class="table">
                    <caption class="text-white">La liste des messages: <?php echo $nbr_messages; ?></caption>
                        <thead>
                            <tr> 
                                <th class="table-dark text-info">Nom 
                                <a href="messages.php?column=nom&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> | 
                                <a href="messages.php?column=nom&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                </th>
                                <th class="table-dark text-info">Email
                                <a href="messages.php?column=email&order=asc"><i class="fas fa-arrow-alt-circle-up"></i></a> |
                                <a href="messages.php?column=email&order=desc"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                </th>
                                <th class="table-dark text-info">Sujet</th>
                                <th class="table-dark text-info">Message</th>
                                <th class="table-dark text-info">Modification</th>
                                <th class="table-dark text-info">Suppression</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($ligne_message=$sql->fetch())
                                {
                            ?>
                            <tr class="table-warning">
                                <td class="text-info"><?php echo $ligne_message['nom']; ?></td>
                                <td class="text-info"><?php echo $ligne_message['email']; ?></td>
                                <td class="text-info"><?php echo $ligne_message['sujet']; ?></td>
                                <td class="text-info"><?php echo $ligne_message['message']; ?></td>
                                <td class="text-info"><a href="modif_message.php?id_message=<?php echo $ligne_message['id_message']; ?>"><i class="fas fa-edit"></i></a></td>
                                <td class="text-info"><a href="messages.php?id_message=<?php echo $ligne_message['id_message']; ?>"><i class="fas fa-trash-alt"></i></a></td>
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
            <!-- insertion d'un nouveau message -->
            <form action="messages.php" method="post">
            <div class="row">
                <div class=" col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="nom" class="text-white">Nom</label>
                        <input type="text" name="nom" placeholder="Nom" class="form-control" required>
                    </div>
                </div> <!-- fin de la div col -->
                <div class=" col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="email" class="text-white">Email</label>
                        <input type="email" name="email" placeholder="Entrez votre email" class="form-control" required>
                    </div>
                </div> <!-- fin de la div col -->
                <div class=" col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="sujet" class="text-white">Sujet</label>
                        <input type="text" name="sujet" placeholder="sujet" class="form-control" required>
                    </div>
                </div> <!-- fin de la div col -->
            </div>
            <div class="form-group">
                <label for="message" class="text-white">Message</label>
                <div>
                    <textarea type="text" class="form-control" name="message" id="message_form" cols="30" rows="10"></textarea>
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'message_form' );
                    </script>
                </div>
            </div>
                <div class="mgbutton">
                    <button type="submit" class="btn btn-info">Insérer un message</button>
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