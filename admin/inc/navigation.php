<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand text-warning" href="index.php">FabgrapH</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">

      <li class="nav-item active">
        <a class="nav-link text-info" href="authentification.php">Connexion <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-info" href="inscription.php">Inscription</a>
      </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-info" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Catégorie
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item text-info" href="profile.php">Mon profile</a>
            <a class="dropdown-item text-info" href="competences.php">Compétences</a>
            <a class="dropdown-item text-info" href="experiences.php">Experience</a>
            <a class="dropdown-item text-info" href="formations.php">Formations</a>
            <a class="dropdown-item text-info" href="loisirs.php">loisirs</a>
            <a class="dropdown-item text-info" href="realisations.php">Réalisations</a>
            <a class="dropdown-item text-info" href="titres.php">Titres</a>
            <a class="dropdown-item text-info" href="messages.php">Messages</a>
          </div>
        </li>

      <li class="nav-item">
        <a class="nav-link text-info" href="../admin/index.php?quitter=oui" title="déconnecter vous ! ">Déconnexion</a>
      </li>

    </ul>
  </div>
</nav>