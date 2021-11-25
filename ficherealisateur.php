<?php
ob_start();
session_start();
    include "function.php";
    include "db-functions.php";
  ?>
    <div  class="container main">
        <?php
        $affichage = "card";
        $real = findrealById($_GET['id']);

        if ($real) { ?>
            <div class=' box'>
                <div class="screen">
                    <div class="container">
                        <div>
                            <h2><?php echo $real['nom_realisateur'] . " " . $real['prenom_realisateur'] ?></h2>
                            <a href='newrealisateur.php?id=<?php echo  $real['ID_realisateur'] ?>' >éditer realisateur</a>

                            <?php $filmog = findFilmByRealId($_GET['id']);
                            echo " <ul>Filmographie</ul>";
                            if ($filmog) {
                                foreach ($filmog as $row) {
                                     echo "<li> <a  href='ficheFilm.php?id=" . $row['ID_film'] . "'>".$row['titre_film']."</a> ".$row['annee_sortie_film']."</li>" ;
       
                                }
                            } else {
                                echo "pas de filmographie";
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div> <?php
                } else {
                    echo "erreur de connection";
                }
                    ?>

    </div>
<?php
    $result = ob_get_clean();
include 'template.php';
