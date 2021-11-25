<?php
ob_start();
session_start();
include "function.php";
include "db-functions.php";
?>
<div class="container main">
    <?php

    $film = findFilmById($_GET['id']);

    if ($film) { ?>
        <div class=' screen box '>
          <div class="content"><img src="img/<?php echo $film['affiche_film'] ?>" class="affiche" alt="affiche du film"></div>
                
           
            <div class="content">
               
                    <h3><?php echo $film['titre_film'] . " " . $film['annee_sortie_film'] ?></h3>

                    <a href='newfilm.php?id=<?php echo  $film['ID_film'] ?>'>éditer film</a>
                
                    <h4><?php echo $film['nom_genre'] ?></h4>
               
                    <p>par : <a href='ficherealisateur.php?id=<?php echo $film['ID_realisateur'] ?>'><?php echo $film['nom_realisateur'] . " " . $film['prenom_realisateur'] ?></a> <br>
                        <em> <?php echo $film['synopsis_film'] ?></em>
                    </p>
                
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
        <?php
    } else {
        echo "erreur de connection";
    }
        ?>
        </div> <?php
                $result = ob_get_clean();
                include 'template.php';
