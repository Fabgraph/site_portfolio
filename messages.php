<?php require 'inc/connexion.php'; 

    // insertion d'un élément dans la base
    if(isset($_POST['nom'])){// si on a reçu un nouvelle compétence
        if($_POST['nom']!='' && $_POST['email']!='' && $_POST['sujet']!='' && $_POST['message']!=''){

            $nom = addslashes ($_POST['nom']);
            $email = addslashes ($_POST['email']);
            $sujet = addslashes ($_POST['sujet']);
            $message = addslashes ($_POST['message']);
            $pdoCV->exec(" INSERT INTO t_messages VALUES (NULL, '$nom', '$email', '$sujet', '$message') ");

            header("location: ../front/messages.php");
                exit();

        }// ferme le if n'est pas vide

    }// fermeture du if isset


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
    <div class="container container1">
        <h1 class="text-center text-warning titre">Les messages</h1>
  
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
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
        
            </div>

    <hr class="bg-dark">

</div> <!-- fin container-fluid principal -->

<?php require 'inc/footer.php'; ?> 
<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>