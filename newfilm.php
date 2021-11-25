<?php
ob_start();
session_start();
include "function.php";
include "db-functions.php";
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$filmToUpdate = null;
if ($id && $film = findFilmById($id)) {
  $filmToUpdate = $film;
}

?><div class="container  ">
  <div class="box main" >
    <h1>New film</h1>
    <form method='POST' action='traitement.php?action=<?= $filmToUpdate ? "modifFilm" : "ajoutFilm" ?>&id=<?= $id ? $id : '' ?>'>
      <div class="row mb-3">
        <label for="titre_film" class="col-sm-2 col-form-label">Titre</label>
        <input type="text" class="form-control" id="titre_film" name="titre_film" value="<?= $filmToUpdate ? $filmToUpdate["titre_film"] : "" ?>">
      </div>
      <div class="row mb-3">
        <label for="annee_sortie_film" class="col-sm-2 col-form-label">Année</label>
        <input type="number" class="form-control" id="annee_sortie_film" name="annee_sortie_film" value="<?= $filmToUpdate ? $filmToUpdate["annee_sortie_film"] : "" ?>">
      </div>
      <div class="row mb-3">
        <label for="duree_film" class="col-sm-2 col-form-label">Durée</label>
        <input type="number" class="form-control" id="duree_film" name="duree_film" value="<?= $filmToUpdate ? $filmToUpdate["duree_film"] : "" ?>">
      </div>
      <div class="row mb-3">
        <label for="synopsis_film" class="col-sm-2 col-form-label">synopsis</label>
        <textarea type="textarea" class="form-control" id="synopsis_film" name="synopsis_film"><?= $filmToUpdate ? $filmToUpdate["synopsis_film"] : "" ?></textarea>
      </div>
      <div class="row mb-3">
        <label for="affiche_film" class="col-sm-2 col-form-label">Affiche</label>
        <input type="text" class="form-control" id="affiche_film" name="affiche_film" value="<?= $filmToUpdate ? $filmToUpdate["affiche_film"] : "" ?>">
      </div>
      <div class="row mb-3">
        <label for="note_film" class="col-sm-2 col-form-label">Note</label>
        <input type="number" class="form-control" id="note_film" name="note_film" value="<?= $filmToUpdate ? $filmToUpdate["note_film"] : "0" ?>">
      </div>
      <div>
        <label for="ID_realisateur" class="col-sm-2 col-form-label">Réalisateur</label>
      </div>
      <div>
        <select class="form-control" name="ID_realisateur" value="<?= $filmToUpdate ? $filmToUpdate["ID_realisateur"] : "" ?>">
          <?php $loop = findreal();
          if (isset($loop)) {
            foreach ($loop as $index => $id_realisateur) {
          ?> <option <?php if (isset($filmToUpdate['ID_realisateur'])) {
                      if ($filmToUpdate['ID_realisateur'] == $id_realisateur['ID_realisateur']) {
                        echo "selected";
                      }
                    }
                    ?> value=<?php if (isset($index))  echo  $id_realisateur['ID_realisateur'] ?>><?php if (isset($index)) echo $id_realisateur['nom_realisateur'] ?></option>
          <?php
            }
          }
          ?>
      </div>
      <div>
        <input class="form-control" type="submit" name="submit" value="Valider">
      </div>
    </form>
  </div>
</div>
<?php
$result = ob_get_clean();
include 'template.php';
