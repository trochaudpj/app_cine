<?php
ob_start();
session_start();
include "function.php";
include "db-functions.php";
?><div id="gallery" class="container main">
    <h3>Panel admin:</h3>
    <h4> <br>->Films:</h4>

    <table class="table table-striped table-hover table-bordered border border-info">
        <thead>
            <th scope="col">id</th>
            <th scope="col">titre</th>
            <th scope="col">annee</th>
            <th scope="col">duree</th>
            <th scope="col">synopsis</th>
            <th scope="col">affiche</th>
            <th scope="col">note</th>
            <th scope="col">realisateur</th>
            <th scope="col">genre</th>
            <th scope="col">actions</th>
        </thead>
        <tbody>
            <?php foreach (findAllFilm() as $row) { ?>

                <tr>
                    <th scope="row"><?= $row['ID_film'] ?></th>
                    <td><?= $row['titre_film'] ?></td>
                    <td><?= $row['annee_sortie_film'] ?></td>
                    <td><?= $row['duree_film'] ?></td>
                    <td><?= $row['synopsis_film'] = substr($row['synopsis_film'], 0, 20) ?></td>
                    <td><?= $row['affiche_film'] ?></td>
                    <td><?= $row['duree_film'] ?></td>
                    <td>    <form method='POST' action='traitement.php?action=<?= $row ? "modifFilm" : "ajoutFilm" ?>&id=<?= $id ? $id : '' ?>'>

                        <div>
                            <select class="form-control" name="ID_realisateur" value="<?= $row ? $row["ID_realisateur"] : "" ?>">
                                <?php $loop = findreal();
                                if (isset($loop)) {
                                    foreach ($loop as $index => $id_realisateur) {
                                ?> <option <?php if (isset($row['ID_realisateur'])) {
                                                if ($row['ID_realisateur'] == $id_realisateur['ID_realisateur']) {
                                                    echo "selected";
                                                }
                                            }
                                            ?> value=<?php if (isset($index))  echo  $id_realisateur['ID_realisateur'] ?>><?php if (isset($index)) echo $id_realisateur['nom_realisateur'] ?></option>
                                    <?php
                                    } ?> </select><?php
                                                }
                                                    ?>
                        </div>
                        <div>
                            <input class="form-control" type="submit" name="submit" value="Valider">
                        </div>
                        </form>
                    </td>
                    <td><?= $row['nom_genre'] ?></td>
                    <td><a href='newfilm.php?id=<?php echo  $row['ID_film'] ?>'>éditer</a>/effacer</td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
    <h4> <br>->Acteurs:</h4>

    <table class="table table-striped table-hover table-bordered border border-info">
        <thead>
            <th scope="col">id</th>
            <th scope="col">nom</th>
            <th scope="col">prenom</th>
            <th scope="col">date de naissance</th>

            <th scope="col">actions</th>
        </thead>
        <tbody>
            <?php foreach (findAllActeur() as $row) { ?>

                <tr>
                    <th scope="row"><?= $row['ID_acteur'] ?></th>
                    <td><?= $row['nom_acteur'] ?></td>
                    <td><?= $row['prenom_acteur'] ?></td>
                    <td><?= $row['date_naissance_acteur'] ?></td>

                    <td><a href='newacteur.php?id=<?php echo  $row['ID_acteur'] ?>'>éditer</a>/effacer</td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
    <h4> <br>->Realisateurs:</h4>
    <table class="table table-striped table-hover table-bordered border border-info">
        <thead>
            <th scope="col">id</th>
            <th scope="col">nom</th>
            <th scope="col">prenom</th>
            <th scope="col">actions</th>
        </thead>
        <tbody>
            <?php foreach (findreal() as $row) { ?>
                <tr>
                    <th scope="row"><?= $row['ID_realisateur'] ?></th>
                    <td><?= $row['nom_realisateur'] ?></td>
                    <td><?= $row['prenom_realisateur'] ?></td>
                    <td><a href='newrealisateur.php?id=<?php echo  $row['ID_realisateur'] ?>'>éditer</a>/effacer</td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
    <h4> <br>->genres:</h4>
    <table class="table table-striped table-hover table-bordered border border-info">
        <thead>
            <th scope="col">id</th>
            <th scope="col">nom</th>

            <th scope="col">actions</th>
        </thead>
        <tbody>
            <?php foreach (findAllGenre() as $row) { ?>
                <tr>
                    <th scope="row"><?= $row['ID_genre'] ?></th>
                    <td><?= $row['nom_genre'] ?></td>

                    <td><a href='newrgenre.php?id=<?php echo  $row['ID_genre'] ?>'>éditer</a>/effacer</td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
</div>
<?php
$result = ob_get_clean();
include 'template.php';
