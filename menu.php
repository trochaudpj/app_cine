<header class="box">
    <nav class="container">
        <div class="nav container-fluid ">
            <a class=" nav-link btn btn-outline-dark " aria-current="page" href="index.php">
                <img src="img/logo.svg" alt="" width="60" height="48" class="d-inline-block align-text-top">
            </a>
            <?php
            if (isset($_SESSION['user'])) {
            ?>
  
                <a href="security.php?action=logout" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mon compte" class="nav-link fas fa-user-cog "><?= $_SESSION['user']['username'] ?></a>
                <a href="security.php?action=logout" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Déconnexion" class="nav-link fas fa-user-alt-slash ">Déconnexion</a>
                <a href="newacteur.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mon compte" class="nav-link ">New acteur</a>
                <a href="newrealisateur.php"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mon compte" class="nav-link ">New réalisateur</a>
                <a href="newpersonnage.php"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mon compte" class="nav-link ">New personnage</a>
                <a href="newfilm.php"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mon compte" class="nav-link ">New film</a>
            <?php
            } else {
            ?>
                <a href="login.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Connexion" class="nav-link fas fa-user-lock btn ">Connexion</a>
                <a href="register.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Inscription" class="nav-link fas fa-user-edit btn ">Inscription</a>
            <?php
            }
            ?>
        </div>

    </nav>
    <?= getMessage() ?>

</header>