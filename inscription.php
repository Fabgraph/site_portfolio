<?php require 'admin/inc/connexion.php';


$inscription = false;  // pour savoir si l'internaute vient de s'inscrire (on metttra la variable à true) et ne plus afficher le formulaire d'inscription
// var_dump($_POST);
// Traitement du formulaire :
if (!empty($_POST)) {  // si le formulaire est soumis
    // Validation des champs du formulaire :
    if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 4 || strlen($_POST['prenom']) > 20) $contenu .= '<div class="bg-danger">Le prenom doit contenir entre 4 et 20 caractères.</div>';
    if (!isset($_POST['nom']) || strlen($_POST['nom']) < 4 || strlen($_POST['nom']) > 20) $contenu .= '<div class="bg-danger">Le nom doit contenir entre 4 et 20 caractères.</div>';
    if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $contenu .= '<div class="bg-danger">Email est incorrect.</div>';  // filter_var() avec l'argument FILTER_VALIDATE_EMAIL valide que $_POST['email'] est bien de format d'un email. Notez que cela marche aussi pour valider les URL avec FILTER_VALIDATE_URL
    if (!isset($_POST['telephone']) || strlen($_POST['telephone']) < 2 || strlen($_POST['telephone']) > 20) $contenu .= '<div class="bg-danger">Le telephone doit contenir entre 2 et 20 caractères.</div>';
    if (!isset($_POST['portable']) || strlen($_POST['portable']) < 2 || strlen($_POST['portable']) > 20) $contenu .= '<div class="bg-danger">Le portable doit contenir entre 2 et 20 caractères.</div>';
    if (!isset($_POST['mdp']) || strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 20) $contenu .= '<div class="bg-danger">Le mot de passe doit contenir entre 4 et 20 caractères.</div>';
    if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 2 || strlen($_POST['pseudo']) > 20) $contenu .= '<div class="bg-danger">Le pseudo doit contenir entre 2 et 20 caractères.</div>';
    if (!isset($_POST['age']) || strlen($_POST['age']) < 2 || strlen($_POST['age']) > 3) $contenu .= '<div class="bg-danger">L\'age doit contenir entre 2 et 3 caractères.</div>';
    if (!isset($_POST['anniversaire']) || strlen($_POST['anniversaire']) == 8) $contenu .= '<div class="bg-danger">L\'anniversaire doit contenir 8 caractères.</div>';
    if (!isset($_POST['civilite']) || ($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f')) $contenu .= '<div class="bg-danger">La civilité est incorrecte.</div>';
    if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 2 || strlen($_POST['adresse']) > 50) $contenu .= '<div class="bg-danger">L\'adresse doit contenir entre 2 et 50 caractères.</div>';
    if (!isset($_POST['code_postal']) || !ctype_digit($_POST['code_postal']) || strlen($_POST['code_postal']) != 5) $contenu .= '<div class="bg-danger">Le code postal est incorrect.</div>';  // ctype_digit() permet de vérifier qu'un string contient un nombre entier (utilisé pour les formulaires qui ne retournent que des string avec le type "text")
    if (!isset($_POST['ville']) || strlen($_POST['ville']) < 2 || strlen($_POST['ville']) > 20) $contenu .= '<div class="bg-danger">La ville doit contenir entre 2 et 20 caractères.</div>';
    if (!isset($_POST['commentaire']) || strlen($_POST['commentaire']) < 4 || strlen($_POST['commentaire']) > 255) $contenu .= '<div class="bg-danger">Le commentaire doit contenir entre 4 et 20 caractères.</div>';
    //--------------- 
    // Si pas d'erreur sur le formulaire, on vérifie que le pseudo est disponible dans la BDD :
    if (empty($contenu)) {  // si $contenu est vide, c'est qu'il n'y a pas d'erreur
        // Vérification du pseudo :
        $membre = executeRequete("SELECT * FROM t_utilisateurs WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));   // on sélectionne en base les éventuels membre dont le pseudo correspond au pseudo donné par l'internaute lors de l'inscription
        if ($membre->rowCount() > 0) {  // si la requête retourne 1 ou plusieurs résultats c'est que le pseudo existe en BDD
            $contenu .= '<div class="bg-danger">Le pseudo est indisponible. Veuillez en choisir un autre.</div>';
        } else {  // sinon, le pseudo étant disponible, on enregistre le membre en BDD :
            executeRequete("INSERT INTO t_utilisateurs (prenom, nom, email, telephone, portable, mdp, pseudo, age, anniversaire, civilite, adresse, code_postal, ville, commentaire, value) VALUES (:prenom, :nom, :email, :telephone, :portable, :mdp, :pseudo, :age, :anniversaire, :civilite, :adresse, :code_postal, :ville, :commentaire, 0)", 
            array(':prenom' => $_POST['prenom'],
                    ':nom' => $_POST['nom'],
                    ':email' => $_POST['email'],
                    ':telephone' => $_POST['telephone'],
                    ':portable' => $_POST['portable'],
                    ':mdp' => $_POST['mdp'],
                    ':pseudo' => $_POST['pseudo'],
                    ':age' => $_POST['age'],
                    ':anniversaire' => $_POST['anniversaire'],
                    ':civilite' => $_POST['civilite'],
                    ':adresse' => $_POST['adresse'],
                    ':code_postal' => $_POST['code_postal'],
                    ':ville' => $_POST['ville'],
                    ':commentaire' => $_POST['commentaire'],
                    
                    
            ));
            $contenu .= '<div class="bg-success">Vous êtes inscrit à notre site. <a href="connexion.php">Cliquez ici pour vous connecter.</a></div>';
            $inscription = true;  // pour ne plus afficher le formulaire sur cette page
            header('location:../site_portfolio/admin/index.php');
            exit();
        }  // fin du else
    }  // fin du if (empty($contenu))
}  // fin du if (!empty($_POST))
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>
    

//------------------------ AFFICHAGE -------------------------
<?php require 'inc/navigation.php';  // doctype, HEADER, nav
echo $contenu; // pour afficher les messages à l'internaute
?>
<div class="container">
    <h1 class="mt-4">Inscription</h1>
<?php
if (!$inscription) :   // if (!$inscription) équivaut à écrire if ($inscription == false), c'est-à-dire que nous rentrons dans la condition si $inscription vaut false. Syntaxe en if (condition) : ... endif;
?>

    <div class="row">
        <p>Veuillez renseigner le formulaire pour vous inscrire.</p>

        <form method="post" action="">

            <label for="prenom">Prénom</label><br>
            <input type="text" name="prenom" id="prenom" value=""><br><br>

            <label for="nom">Nom</label><br>
            <input type="text" name="nom" id="nom" value=""><br><br>

            <label for="email">Email</label><br>
            <input type="text" name="email" id="email" value=""><br><br>

            <label for="telephone">Téléphone</label><br>
            <input type="text" name="telephone" id="telephone" value=""><br><br>

            <label for="portable">Portable</label><br>
            <input type="text" name="portable" id="portable" value=""><br><br>

            <label for="mdp">Mot de passe</label><br>
            <input type="text" name="mdp" id="mdp" value=""><br><br>

            <label for="pseudo">Pseudo</label><br>
            <input type="text" name="pseudo" id="pseudo" value=""><br><br>

            <label for="age">Age</label><br>
            <input type="text" name="age" id="age" value=""><br><br>

            <label for="anniversaire">Anniversaire</label><br>
            <input type="text" name="anniversaire" id="anniversaire" value=""><br><br>

            <label>Civilité</label>
            <input type="radio" name="civilite" value="m" checked> Homme
            <input type="radio" name="civilite" value="f"> Femme<br><br>

            <label for="adresse">Adresse</label><br>
            <textarea name="adresse" id="adresse"></textarea><br><br>

            <label for="code_postal">Code postal</label><br>
            <input type="text" name="code_postal" id="code_postal" value=""><br><br>

            <label for="ville">Ville</label><br>
            <input type="text" name="ville" id="ville" value=""><br><br>

            <label for="commentaire" class="text-white">Description</label>
               
            <textarea name="commentaire" id="commentaire" cols="123" rows="10"></textarea>
               

        

        

            <input type="submit" name="inscription" value="s'inscrire" class="btn">
        </form>
    </div>

<?php endif; ?>
</div> <!-- fin de la div container -->
<?php require 'inc/footer.php'; ?>   <!-- footer et fermetures des balises -->
<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>