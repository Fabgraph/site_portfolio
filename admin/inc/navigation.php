<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand text-warning" href="index.php">FabgrapH</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">

        <li class="nav-item">
            <a class="dropdown-item text-white" href="../admin/profil.php">Mon profil</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Modification Qualités
          </a>
          <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item text-white bg-dark" href="competences.php">Compétences</a>
            <a class="dropdown-item text-white bg-dark" href="experiences.php">Expériences</a>
            <a class="dropdown-item text-white bg-dark" href="formations.php">Formations</a>
            <a class="dropdown-item text-white bg-dark" href="loisirs.php">Loisirs</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Modification Travaux
          </a>
          <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item text-white bg-dark" href="realisations.php">Réalisations</a>
            <a class="dropdown-item text-white bg-dark" href="titres.php">Titres</a>
          </div>
        </li>

        <li>
            <a class="dropdown-item text-white" href="messages.php">Messages</a>
        </li>
    </ul>

    <li class="nav-right ml-auto">
      <a class="nav-link text-white" href="../admin/index.php?quitter=oui" title="déconnecter vous ! ">Déconnexion</a>
    </li>
  
      
  </div>
</nav>