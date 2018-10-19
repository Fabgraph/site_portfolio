<?php require 'inc/connexion.php';
    // gestion mise à jour d'une information
    if(isset($_POST['nom'])){
        $nom = addslashes($_POST['nom']);
        $email = addslashes($_POST['email']);
        $sujet = addslashes($_POST['sujet']);
        $message = addslashes($_POST['message']);
        $id_message = $_POST['id_message'];

        $pdoCV->exec(" UPDATE t_messages SET nom='$nom', email='$email', sujet='$sujet', message='$message' WHERE id_message='$id_message' ");
        header('location: ../admin/messages.php');

    }

    // je récupère l'id de ce que je mets à jour
    $id_message = $_GET['id_message']; // par son id et avec GET
    $sql = $pdoCV->query(" SELECT * FROM t_messages WHERE id_message='$id_message' ");
    $ligne_message = $sql->fetch(); // pour qu'il aille chercher 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour message</title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    <?php require 'inc/navigation.php'; ?>
    <div class="container-fluid bg-primary">
    <div class="container2">
    <h1 class="text-center text-white">Mise à jour d'une message</h1>

    
    <!-- mise à jour formulaire -->
    <form action="modif_message.php" method="post">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div>
                        <label for="nom" class="text-white">Nom</label>
                        <input type="text" name="nom" value="<?php echo $ligne_message['nom']; ?>" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div>
                        <label for="email" class="text-white">email</label>
                        <input type="email" name="email" value="<?php echo $ligne_message['email']; ?>" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div>
                        <label for="sujet" class="text-white">Sujet</label>
                        <input type="text" name="sujet" value="<?php echo $ligne_message['sujet']; ?>" class="form-control" required>
                    </div>
                </div>
            </div> <!-- fin div row -->
            <div>
                <div>
                    <label for="message" class="text-white">Message</label>
                </div>
                <div>
                    <textarea type="text" class="form-control" name="message" id="message_form" cols="30" rows="10"><?php echo $ligne_message['message']; ?></textarea>
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'message_form' );
                    </script>
                </div>
            </div>
        
        
        </div>
        <div>
            <input type="hidden" name="id_message" value="<?php echo $ligne_message['id_message']; ?>">
            <button type="submit" class="btn btn-info">MAJ</button>
        </div>
    </form>

    </div>

    </div> <!-- fin de la div container2 -->
<?php require 'inc/footer.php'; ?>
</body>
</html>