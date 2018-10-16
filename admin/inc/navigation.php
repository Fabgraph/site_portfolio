<!-- NAVBAR -->
<!-- Grey with black text -->
<nav class="navbar navbar-expand-sm navbar-dark bg-info">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link text-white" href="index.php">Accueil</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="authentification.php">Connexion</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#">Link</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">
        Catégorie
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Mon profil</a>
        <a class="dropdown-item" href="competences.php">Compétences</a>
        <a class="dropdown-item" href="experiences.php">Experience</a>
        <a class="dropdown-item" href="formations.php">Formations</a>
        <a class="dropdown-item" href="loisirs.php">loisirs</a>
        <a class="dropdown-item" href="realisations.php">Réalisations</a>
        <a class="dropdown-item" href="titres.php">Titre</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../admin/index.php?quitter=oui" title="<?php echo $ligne_utilisateur['prenom'] ?> déconnectez-vous">Déconnexion</a>
    </li>
  </ul>
</nav>