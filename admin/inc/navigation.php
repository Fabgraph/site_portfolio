<!-- NAVBAR -->
<!-- Grey with black text -->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link text-info" href="index.php">Accueil</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-info" href="authentification.php">Connexion</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-info" href="#">Inscription</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-info" href="#" id="navbardrop" data-toggle="dropdown">
        Catégorie
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item text-info" href="#">Mon profil</a>
        <a class="dropdown-item text-info" href="competences.php">Compétences</a>
        <a class="dropdown-item text-info" href="experiences.php">Experience</a>
        <a class="dropdown-item text-info" href="formations.php">Formations</a>
        <a class="dropdown-item text-info" href="loisirs.php">loisirs</a>
        <a class="dropdown-item text-info" href="realisations.php">Réalisations</a>
        <a class="dropdown-item text-info" href="titres.php">Titre</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link text-info" href="../admin/index.php?quitter=oui" title="<?php echo $ligne_utilisateur['prenom'] ?> déconnectez-vous">Déconnexion</a>
    </li>
  </ul>
</nav>