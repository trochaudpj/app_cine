<?php
ob_start();
session_start();
include "function.php";
include "db-functions.php";
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$realisateurToUpdate = null;
if ($id && $realisateur = findrealById($id)) {
  $realisateurToUpdate = $realisateur;
}

?><div class="container  ">
  <div class="box main" >
    <h1>New réalisateur</h1>
    <form method='POST' action='traitement.php?action=<?= $realisateurToUpdate ? "modifRealisateur" : "ajoutRealisateur" ?>&id=<?= $id ? $id : '' ?>'>
      <div class="row mb-3">
        <label for="prenom" class="col-sm-2 col-form-label" >prenom</label>
        <input type="text" class="form-control" id="prenom_realisateur" name="prenom_realisateur" value="<?= $realisateurToUpdate ? $realisateurToUpdate["prenom_realisateur"] : "" ?>">
      </div>
      <div class="row mb-3">
        <label for="nom" class="col-sm-2 col-form-label"  >Nom</label>
        <input type="text" class="form-control" id="nom_realisateur" name="nom_realisateur" value="<?= $realisateurToUpdate ? $realisateurToUpdate["nom_realisateur"] : "" ?>">
      </div>

      <button type="submit" name="submit" class="btn btn-primary">Valider</button>
    </form>
  </div>
</div>
<?php
$result = ob_get_clean();
include 'template.php';
