<?php
ob_start();
session_start();
include "function.php";
include "db-functions.php";
?>
<div class="container main">
    <?php
    $acteur = findacteurById($_GET['id']);
    if ($acteur) { ?>
        <div class=' box'>
            <div class="screen">
                <div class="container"><div>
                    <h2><?php echo  $acteur['nom_acteur'] . " " . $acteur['prenom_acteur']; ?></h2>
                    <a href='newacteur.php?id=<?php echo  $acteur['ID_acteur'] ?>' >éditer acteur</a>
                    </div><div>
                        <?php
                        $castings = findRolesByacteurId($_GET['id']);
                        if ($castings) {
                            echo " <ul>Casting</ul>";
                            foreach ($castings as $casting) {
                                echo "<li><a href=newpersonnage.php?id=". $casting['ID_personnage'] .">" . $casting['nom_personnage'] . "</a> dans <a href='fichefilm.php?id=" .  $casting['ID_film'] . "'>" . $casting['titre_film'] . "</a> </li>";
                            }
                        } else  echo "pas de casting !";
                        ?></div><div></div>
                </div>
            </div>
        </div>
    <?php
    } else {
        echo "erreur de connection";
    }
    ?>
</div> <?php
        $result = ob_get_clean();
        include 'template.php';
