<?php
ob_start();
session_start();
include "function.php";
include "db-functions.php";
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$acteurToUpdate = null;
if ($id && $acteur = findacteurById($id)) {
  $acteurToUpdate = $acteur;
}
var_dump($acteurToUpdate);
?><div class="container main ">
  <div class="box" id="recap">
    <h1>New acteur</h1>
    <form method='POST' action='traitement.php?action=<?= $acteurToUpdate ? "modifActeur" : "ajoutActeur" ?>&id=<?= $id ? $id : '' ?>'>
      <div class="row mb-3">
        <label for="prenom" class="col-sm-2 col-form-label" >prenom</label>
        <input type="text" class="form-control" id="prenom_acteur" name="prenom_acteur" value="<?= $acteurToUpdate ? $acteurToUpdate["prenom_acteur"] : "" ?>">
      </div>
      <div class="row mb-3">
        <label for="nom" class="col-sm-2 col-form-label"  >Nom</label>
        <input type="text" class="form-control" id="nom_acteur" name="nom_acteur" value="<?= $acteurToUpdate ? $acteurToUpdate["nom_acteur"] : "" ?>">
      </div>
      <div class="row mb-3">
        <label for="date_n" class="col-sm-2 col-form-label" >Date de naissance</label>
        <input type="date" class="form-control" id="date_n" name="date_n"  value="<?= $acteurToUpdate ? $acteurToUpdate["date_naissance_acteur"] : "" ?>">
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Valider</button>
    </form>
  </div>
</div>
<?php
$result = ob_get_clean();
include 'template.php';
