<?php
ob_start();
session_start();
include "function.php";
include "db-functions.php";
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$personnageToUpdate = null;
if ($id && $personnage = findpersonnageById($id)) {
  $personnageToUpdate = $personnage;
}

?><div class="container main ">
  <div class="box" id="recap">
    <h1>New Personnage</h1>
    <form method='POST' action='traitement.php?action=<?= $personnageToUpdate ? "modifPersonnage" : "ajoutPersonnage" ?>&id=<?= $id ? $id : '' ?>'>
      <div class="row mb-3">
        <label for="nom_personnage" class="col-sm-2 col-form-label" >Nom personnage</label>
        <input type="text" class="form-control" id="nom_personnage" name="nom_personnage" value='<?= $personnageToUpdate ? $personnageToUpdate["nom_personnage"] : "" ?>'>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Valider</button>
    </form>
  </div>
</div>
<?php
$result = ob_get_clean();
include 'template.php';
