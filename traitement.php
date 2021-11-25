<?php
session_start();
include "function.php";
require_once("db-functions.php");
$action = filter_input(INPUT_GET, "action", FILTER_VALIDATE_REGEXP, [
    "options" => [
        "regexp" => "/modifActeur|ajoutActeur|modifPersonnage|ajoutPersonnage|modifRealisateur|ajoutRealisateur|modifFilm|ajoutFilm|deleteAll/"
    ]
]);

if ($action) {
    switch ($action) {
        case "modifActeur":
            if (isset($_POST['submit'])) {
                $prenom_acteur = filter_input(INPUT_POST, "prenom_acteur", FILTER_SANITIZE_STRING);
                $nom_acteur = filter_input(INPUT_POST, "nom_acteur", FILTER_SANITIZE_STRING);
                $date_n = filter_input(INPUT_POST, "date_n", FILTER_SANITIZE_STRING);
                $id = $_GET['id'];
                $redirect = modifActeur($prenom_acteur, $nom_acteur, $date_n, $id);

                setMessage("success", "Acteur modifié avec succès !");
                redirect("ficheacteur.php?id=" . $id);
            } else {
                setMessage("error", "Acteur pas modifié!");
                redirect("index.php");
            }
            break;
        case "ajoutActeur":

            if (isset($_POST['submit'])) {
                $prenom_acteur = filter_input(INPUT_POST, "prenom_acteur", FILTER_SANITIZE_STRING);
                $nom_acteur = filter_input(INPUT_POST, "nom_acteur", FILTER_SANITIZE_STRING);
                $date_n = filter_input(INPUT_POST, "date_n", FILTER_SANITIZE_STRING);
                $id = $_GET['id'];
                $redirect = ajoutActeur($prenom_acteur, $nom_acteur, $date_n);

                setMessage("success", "Acteur inséré avec succès !");
                redirect("ficheacteur.php?id=" . $redirect);
            } else {
                setMessage("error", "Acteur pas inséré!");
                redirect("index.php");
            }
            break;
        case "modifRealisateur":
            if (isset($_POST['submit'])) {
                $prenom_realisateur = filter_input(INPUT_POST, "prenom_realisateur", FILTER_SANITIZE_STRING);
                $nom_realisateur = filter_input(INPUT_POST, "nom_realisateur", FILTER_SANITIZE_STRING);
                $id = $_GET['id'];
                $redirect = modifRealisateur($prenom_realisateur, $nom_realisateur, $id);

                setMessage("success", "Réalisateur modifié avec succès !");
                redirect("ficherealisateur.php?id=" . $id);
            } else {
                setMessage("error", "Réalisateur pas modifié!");
                redirect("index.php");
            }
            break;
        case "ajoutRealisateur":

            if (isset($_POST['submit'])) {
                $prenom_realisateur = filter_input(INPUT_POST, "prenom_realisateur", FILTER_SANITIZE_STRING);
                $nom_realisateur = filter_input(INPUT_POST, "nom_realisateur", FILTER_SANITIZE_STRING);
                $redirect = ajoutRealisateur($prenom_realisateur, $nom_realisateur);

                setMessage("success", "Réalisateur inséré avec succès !");
                redirect("ficherealisateur.php?id=" . $redirect);
            } else {
                setMessage("error", "Réalisateur pas inséré!");
                redirect("index.php");
            }
            break;
            case "modifPersonnage":
                if (isset($_POST['submit'])) {
                    $nom_personnage = filter_input(INPUT_POST, "nom_personnage", FILTER_SANITIZE_STRING);
                    $id = $_GET['id'];
                    $redirect = modifPersonnage($nom_personnage, $id);
    
                    setMessage("success", "Personnage modifié avec succès !");
                    redirect("index.php?id=" . $id);
                } else {
                    setMessage("error", "Personnage pas modifié!");
                    redirect("index.php");
                }
                break;
            case "ajoutPersonnage":
    
                if (isset($_POST['submit'])) {
                    $nom_personnage = filter_input(INPUT_POST, "nom_personnage", FILTER_SANITIZE_STRING);
                    $redirect = ajoutPersonnage($nom_personnage);
    
                    setMessage("success", "Personnage inséré avec succès !");
                    redirect("index.php?id=" . $redirect);
                } else {
                    setMessage("error", "Personnage pas inséré!");
                    redirect("index.php");
                }
                break;
                case "modifFilm":
                    if (isset($_POST['submit'])) {
                        $titre_film = filter_input(INPUT_POST, "titre_film", FILTER_SANITIZE_STRING);
                        $annee_sortie_film = filter_input(INPUT_POST, "annee_sortie_film", FILTER_VALIDATE_INT);
                        $duree_film = filter_input(INPUT_POST, "duree_film", FILTER_VALIDATE_INT);
                        $synopsis_film = filter_input(INPUT_POST, "synopsis_film", FILTER_SANITIZE_STRING);
                        $affiche_film = filter_input(INPUT_POST, "affiche_film", FILTER_SANITIZE_URL);
                        $note_film = filter_input(INPUT_POST, "note_film", FILTER_VALIDATE_INT);
                        $ID_realisateur = filter_input(INPUT_POST, "ID_realisateur", FILTER_VALIDATE_INT);                        $id = $_GET['id'];
                        $redirect = modifFilm($titre_film, $annee_sortie_film,$duree_film,$synopsis_film,$affiche_film,$note_film,$ID_realisateur,$id);
                 
                        setMessage("success", "Film modifié avec succès !");
                        redirect("fichefilm.php?id=" . $id);
                    } else {
                        setMessage("error", "Film pas modifié!");
                        redirect("index.php");
                    }
                    break;
                case "ajoutFilm":
        
                    if (isset($_POST['submit'])) {
                        $titre_film = filter_input(INPUT_POST, "titre_film", FILTER_SANITIZE_STRING);
                        $annee_sortie_film = filter_input(INPUT_POST, "annee_sortie_film", FILTER_VALIDATE_INT);
                        $duree_film = filter_input(INPUT_POST, "duree_film", FILTER_VALIDATE_INT);
                        $synopsis_film = filter_input(INPUT_POST, "synopsis_film", FILTER_SANITIZE_STRING);
                        $affiche_film = filter_input(INPUT_POST, "affiche_film", FILTER_SANITIZE_URL);
                        $note_film = filter_input(INPUT_POST, "note_film", FILTER_VALIDATE_INT);
                        $ID_realisateur = filter_input(INPUT_POST, "ID_realisateur", FILTER_VALIDATE_INT);
                        $redirect = ajoutFilm($titre_film, $annee_sortie_film,$duree_film,$synopsis_film,$affiche_film,$note_film,$ID_realisateur);
        
                        setMessage("success", "Film inséré avec succès !");
                        redirect("fichefilm.php?id=" . $redirect);
                    } else {
                        setMessage("error", "Film pas inséré!");
                        redirect("index.php");
                    }
                    break;
    }
}
