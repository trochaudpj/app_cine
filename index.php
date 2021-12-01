<?php
ob_start();
session_start();
include "function.php";
include "db-functions.php";
?>

<div id="gallery" class="container main">
    <?php
    foreach (findAllFilm() as $row) { ?>
        <div class='figure box vignette drop' style="background-image: url('img/<?php echo $row['affiche_film'] ?>');">
            <div class="txt">
                <div>
                    <?php echo $row['nom_genre'] ?>
                </div>
                <div >
                    <?php echo "<h5><a  href='ficheFilm.php?id=" . $row['ID_film'] . "'>" . $row['titre_film'] . "</a></h5>". $row['annee_sortie_film']  ?>
                </div>
                <div>
                    <a href='ficherealisateur.php?id=<?php echo $row['ID_realisateur'] ?>'><?php echo $row['nom_realisateur'] . " " . $row['prenom_realisateur'] ?></a>
                </div>
                <div>
                    <?php echo $row['synopsis_film'] = substr($row['synopsis_film'], 0, 50) ?>
                </div>
            </div>
        </div><?php
            } ?>
</div>
<?php
$result = ob_get_clean();
include 'template.php';
