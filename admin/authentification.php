<?php require 'inc/connexion.php';

session_start();// à mettre dans toutes les pages de l'admin
//traitement pour la connexion à l'admin
if(isset($_POST['connexion'])){// connexion est la name du button

    $email = addslashes($_POST['email']);
    $mdp = addslashes($_POST['mdp']);

    $sql= $pdoCV -> prepare (" SELECT * FROM t_utilisateurs WHERE email='$email' AND mdp='$mdp' ");
    // on vérifie email ET mot de passe

    $sql -> execute();
    $nbr_utilisateur = $sql -> rowCount();// on compte si il est dans la BDD; le compte répond 0 s'il n'y est pas et répond 1 s'il y est

    if($nbr_utilisateur == 0) {// il n'y est pas
        echo '<p>Erreur</p>';
    } else {// il y est
        // echo $nbr_utilisateur; 
        $ligne_utilisateur = $sql -> fetch();

        $_SESSION['connexion_admin'] = 'connecté'; // connexion pour l'admin

        $_SESSION['id_utilisateur'] = $ligne_utilisateur['id_utilisateur'];
        $_SESSION['email'] = $ligne_utilisateur['email'];
        $_SESSION['nom'] = $ligne_utilisateur['nom'];
        $_SESSION['mdp'] = $ligne_utilisateur['mdp'];

        // echo $ligne_utilisateur['nom'];

        header('location:../admin/index.php');
    }
}

?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <!-- lien pour le form -->
    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="img/icons/favicon.ico"/>
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
	    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
	    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->	
	    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
	    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
	    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->	
	    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
	    <link rel="stylesheet" type="text/css" href="css/util.css">
	    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <title>Admin : authentification</title>
</head>
<body>

<div class="container-login100" style="background-image: url('img/fond3.jpg');">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<form class="login100-form validate-form"  method="post" action="authentification.php" role="login">
				<span class="login100-form-title p-b-37">
					Connexion
				</span>

				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
					<input class="input100" type="email" name="email" placeholder="Votre email">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
					<input class="input100" type="password" name="mdp" placeholder="Votre mot de passe">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<button type="submit"  class="login100-form-btn" name="connexion">
						Se connecter
					</button>
				</div>

				<div class="text-center p-t-57 p-b-20">
					<span class="txt1">
						Or login with
					</span>
				</div>

				<div class="flex-c p-b-112">
					<a href="https://fr-fr.facebook.com/" class="login100-social-item">
						<i class="fa fa-facebook-f"></i>
					</a>

					<a href="https://www.google.com/" class="login100-social-item">
						<img src="img/icons/icon-google.png" alt="GOOGLE">
					</a>
				</div>

				<div class="text-center">
					<a href="#" class="txt2 hov1">
						Inscription
					</a>
				</div>
			</form>

			
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>









    <!-- <div class="container">
  
        <div class="row" id="pwd-container">
            <div class="col-md-4"></div>
    
            <div class="col-md-4">
                <section class="login-form">
                    <form method="post" action="authentification.php" role="login">
                        <h1 class="text-center text-info">Connexion</h1>
                        <br>
                        <input type="email" name="email" placeholder="email" required class="form-control input-lg" value="Votre email" />
                        <br>
                        <input type="password" name="mdp" class="form-control input-lg" id="password" placeholder="Votre mot de passe" required="" />
                        <br>
                        <div class="pwstrength_viewport_progress"></div>
          

                        <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign in</button>

                        <div>
                            <a href="#">Create account</a> or <a href="#">reset password</a>
                        </div>

                    </form>

                    <div class="form-links">
                        <a href="#">www.website.com</a>
                    </div>
        
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      

  </div>   
  
  
</div> -->
    
    
<!-- lien pour le form -->
<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>