<header>
    <nav class="container">
        <div class="nav container-fluid">
            <a class=" nav-link btn btn-outline-dark" aria-current="page" href="index.php">
                <img src="img/logo.svg" alt="" width="60" height="48" class="d-inline-block align-text-top">
            </a>
            <?php
            if (isset($_SESSION['user'])) {
            ?>
                <a href="security.php?action=logout" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Mon compte" class="nav-link fas fa-user-cog btn btn-outline-dark"><?= $_SESSION['user']['username'] ?></a>
                <a href="security.php?action=logout" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Déconnexion" class="nav-link fas fa-user-alt-slash btn btn-outline-dark">Déconnexion</a>
                <a href="newacteur.php">New acteur</a>
                <a href="newrealisateur.php">New réalisateur</a>
                <a href="newpersonnage.php">New personnage</a>
                <a href="newfilm.php">New film</a>
            <?php
            } else {
            ?>
                <a href="login.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Connexion" class="nav-link fas fa-user-lock btn btn-outline-dark">Connexion</a>
                <a href="register.php" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Inscription" class="nav-link fas fa-user-edit btn btn-outline-dark">Inscription</a>
            <?php
            }
            ?>
        </div>

    </nav>
    <?= getMessage() ?>

</header>