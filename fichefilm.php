<?php
ob_start();
session_start();
include "function.php";
include "db-functions.php";
?>
<div class="container main">
    <?php
    $affichage = "card";
    $film = findFilmById($_GET['id']);

    if ($film) { ?>
        <div class=' box'>
            <div class="screen">
                <img src="img/<?php echo $film['affiche_film'] ?>" width="300px" alt="affiche du film">
                <div class="container"><div>
                    <h2><?php echo $film['titre_film'] . " " . $film['annee_sortie_film'] ?></h2>
                    <a href='newfilm.php?id=<?php echo  $film['ID_film'] ?>' >éditer film</a>
                    <h4><?php echo $film['nom_genre'] ?></h4></div>
                    <p>par : <a href='ficherealisateur.php?id=<?php echo $film['ID_realisateur'] ?>'><?php echo $film['nom_realisateur'] . " " . $film['prenom_realisateur'] ?></a> <br>
                        <em> <?php echo $film['synopsis_film'] ?></em>
                    </p>
                    <div>
                        <?php
                        $castings = findCastingByFilmId($_GET['id']);
                        if ($castings) {
                            echo " <ul>Casting</ul>";
                            foreach ($castings as $casting) {
                        ?>
                                <li>
                                    <a href='ficheacteur.php?id=<?php echo  $casting['ID_acteur'] ?>'><?php echo $casting['prenom_acteur'] . " as " . $casting['nom_personnage'] ?> </a>
                                </li> <?php
                                    }
                                } else  echo "pas de casting !";
                                        ?>
                    </div>

                </div>
            </div>

        </div> <?php
            } else {
                echo "erreur de connection";
            }
                ?>



</div> <?php
        $result = ob_get_clean();
        include 'template.php';
