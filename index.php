<?php 
ob_start();
session_start();
    include "function.php";
    include "db-functions.php";
    ?>
<div id="gallery" class="container main">
    <?php
    foreach (findAllFilm() as $row) { ?>
       <div class='figure box '>

            <img src="img/<?php echo $row['affiche_film'] ?>" width="150px" alt="affiche du film">
        
        <h4><?php echo "<a  href='ficheFilm.php?id=". $row['ID_film'] . "'>".$row['titre_film']." ".$row['annee_sortie_film']."</a>" ?></h4>
        <h5><?php echo $row['nom_genre'] ?></h5>
        <p>par : <a  href='ficherealisateur.php?id=<?php echo $row['ID_realisateur']?>'><?php echo $row['nom_realisateur']." ". $row['prenom_realisateur']?></a> <br>
        <?php echo $row['synopsis_film']= substr($row['synopsis_film'], 0, 50) ?></p>
     
   
    </div><?php
    } ?>
</div>
<?php
$result = ob_get_clean();
include 'template.php';
