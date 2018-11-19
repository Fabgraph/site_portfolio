<?php require 'admin/inc/connexion.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon profil</title>
    <?php require 'inc/liens.php'; ?>
</head>
<body>

<?php require 'inc/navigation.php'; ?>

<div class="container container2">

    <div class="card titre">
        <div class="card-body bg-info">
            <h1 class="text-center text-warning">Compétences</h1>
        </div>
    </div>
    <br>
    <div class="row">

        <div class="col-sm-12 col-md-6 col-lg-6">

            <h3 class="text-center text-warning">Web</h3>
            <br>
            <h4 class="text-info">HTML/CSS</h4>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:80%"></div>
            </div>

            <h4 class="text-info">WordPress</h4>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:60%"></div>
            </div>

            <h4 class="text-info">Bootstrap</h4>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:60%"></div>
            </div>

            <h4 class="text-info">SQL</h4>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:40%"></div>
            </div>

            <h4 class="text-info">PHP</h4>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:40%"></div>
            </div>

            <h4 class="text-info">JavaScript</h4>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:20%"></div>
            </div>

            <h4 class="text-info">Angular js</h4>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:20%"></div>
            </div>

            <h4 class="text-info">Ionic/Cordova</h4>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:20%"></div>
            </div>

            <h4 class="text-info">Ajax</h4>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:5%"></div>
            </div>

        </div>

        <div class="col-sm-12 col-md-6 col-lg-6">

            <h3 class="text-center text-warning">Print</h3>
            <br>
            <h4 class="text-info">Indesign</h4>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:80%"></div>
            </div>

            <h4 class="text-info">Illustrator</h4>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:60%"></div>
            </div>

            <h4 class="text-info">Photoshop</h4>
            <div class="progress">
                <div class="progress-bar bg-warning" style="width:40%"></div>
            </div>

        </div>

    </div> <!-- fin div row -->
    <br>

    <div class="card titre">
        <div class="card-body bg-info">
            <h1 class="text-center text-warning">Formations</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-2 col-md-4 col-lg-4 d-flex p-3 text-warning">
            <div class="p-2">
                <h5>2018-2019</h5>
            </div>
        </div>
        <div class="col-sm-10 col-md-8 col-lg-8">
            <p class="text-info">Formation développeur-intégrateur web par WebForce3 et Le PoleS, Pantin. Formation de 10 mois labellisée Grandes Ecoles du Numérique, Techniques de développement web et mobile.</p>
        </div>
        <br>
        <div class="col-sm-2 col-md-4 col-lg-4 d-flex p-3 text-warning">
            <div class="p-2">
                <h5>2017</h5>
            </div>
        </div>
        <div class="col-sm-10 col-md-8 col-lg-8">
            <p class="text-info">Formation «Assistant 3D»  par Dassault Systèmes, Bagnolet et Paris. Découverte de la 3D ses outils et ses usages, et apprendre à maîtriser Catia V5 «BASICS».</p>
        </div>
        <br>
        <div class="col-sm-2 col-md-4 col-lg-4 d-flex p-3 text-warning">
            <div class="p-2">
                <h5>2014-2016</h5>
            </div>
        </div>
        <div class="col-sm-10 col-md-8 col-lg-8">
            <p class="text-info">Baccalauréat Professionnel Artisanat et Métier d’Art (option Communication Visuelle et Plurimédia), ERP Malleterre à Soisy-sur-Seine : • Création, mise en page et rough • Projets d’arts appliqué • Apprentissage des logiciels Indesign, Illustrator et Photoshop</p>
        </div>
        <br>
        <div class="col-sm-2 col-md-4 col-lg-4 d-flex p-3 text-warning">
            <div class="p-2">
                <h5>2005-2006</h5>
            </div>
        </div>
        <div class="col-sm-10 col-md-8 col-lg-8">
            <p class="text-info">1ère année de faculté de psychologie, Université de Paris VIII.</p>
        </div>
        <br>
        <div class="col-sm-2 col-md-4 col-lg-4 d-flex p-3 text-warning">
            <div class="p-2">
                <h5>2005</h5>
            </div>
        </div>
        <div class="col-sm-10 col-md-8 col-lg-8">
            <p class="text-info">Baccalauréat ES (Economique et Social), Lycée Jean Jaurés à Montreuil.</p>
        </div>
    </div> <!-- fin div row -->
    <br>

    <div class="card titre">
        <div class="card-body bg-info">
            <h1 class="text-center text-warning">Expériences Professionnelles</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-2 col-md-4 col-lg-4 d-flex p-3 text-warning">
            <div class="p-2">
                <h5>2017</h5>
            </div>
        </div>
        <div class="col-sm-10 col-md-8 col-lg-8">
            <p class="text-info">Stage à Agence Inédit (3 semaines) : Création de cartes de visite, logo, panneaux, flyers et pose de pannneaux</p>
        </div>
        <br>
        <div class="col-sm-2 col-md-4 col-lg-4 d-flex p-3 text-warning">
            <div class="p-2">
                <h5>2014-2016</h5>
            </div>
        </div>
        <div class="col-sm-10 col-md-8 col-lg-8">
            <p class="text-info">Stage à Groupe Protection Habitat (3 semaines) : Participation à la création d’un catalogue, réalisation d’une couverture et détourage d’images.</p>
            <p class="text-info">Stage à la Mairie des Lilas (7 semaines) : Réalisation d’affiches, d’un quatre pages, de kakémono et corrections de texte.</p>
        </div>
        <br>
        <div class="col-sm-2 col-md-4 col-lg-4 d-flex p-3 text-warning">
            <div class="p-2">
                <h5>2011-2013</h5>
            </div>
        </div>
        <div class="col-sm-10 col-md-8 col-lg-8">
            <p class="text-info"> Atelier imprimerie MGEN : Façonnage et PAO.</p>
        </div>
        <br>
        <div class="col-sm-2 col-md-4 col-lg-4 d-flex p-3 text-warning">
            <div class="p-2">
                <h5>2010</h5>
            </div>
        </div>
        <div class="col-sm-10 col-md-8 col-lg-8">
            <p class="text-info">Pré-orientation professionnelle au Centre Alexandre DUMAS.</p>
        </div>
        <br>
        <div class="col-sm-2 col-md-4 col-lg-4 d-flex p-3 text-warning">
            <div class="p-2">
                <h5>2007-2008</h5>
            </div>
        </div>
        <div class="col-sm-10 col-md-8 col-lg-8">
            <p class="text-info">Manutentionnaire Intérimaire : déchargement de bureau de camions.</p>
        </div>
    </div> <!-- fin div row -->
        <br>

    <div class="card titre">
        <div class="card-body bg-info">
            <h1 class="text-center text-warning">Expériences Professionnelles</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <p class="text-info centre" style="padding: 0 20% 0 20%">Dessin - Pyrogravure - Musique</p>
    </div>
    
</div> <!-- fin div container -->

















<?php require 'inc/footer.php'; ?> 
<!-- liens js Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    
</body>
</html>