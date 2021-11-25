<?php

/**
 * Retourne une instance de PDO, représentant la connexion à la base de données
 * @return \PDO un objet instance de PDO, connecté à la base de données
 */
function connexion()
{
    return new \PDO(
        "mysql:dbname=film;host=localhost:3306",
        "root",
        "",
        [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        ]
    );
}

/**
 * Retourne tous les films de la base de données
 * 
 * @return array|false 
 * Renvoie un tableau contenant les films sous forme de tableau, 
 * un tableau vide si aucun film n'est présent en base
 * ou FALSE si la requète a échoué
 */
function findAllFilm()
{
    $db = connexion();
    $sql = "SELECT * FROM film f 
    left join realisateur r on f.ID_realisateur = r.ID_realisateur 
    left join classement c on f.ID_film = c.ID_film 
    left join genre g on g.ID_genre = c.ID_genre";
    $stmt = $db->query($sql);
    return $stmt->fetchAll();
}
/**
 * Retourne le film en base de données correspondant à l'id en paramètre
 * 
 * @param int $id l'identifiant du film en BDD
 * @return array|false un tableau contenant les champs du film ou FALSE si aucun produit n'a été récupéré
 */
function findFilmById($id)
{
    $sql = "SELECT * FROM film f 
    inner join realisateur r on f.ID_realisateur = r.ID_realisateur 
    inner join classement c on f.ID_film = c.ID_film 
    inner join genre g on g.ID_genre = c.ID_genre
    WHERE f.ID_film= :id";
    $stmt = connexion()->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return ($stmt->fetch());
}
/**
 * Retourne le film en base de données correspondant à l'id en paramètre
 * 
 * @param int $id l'identifiant du film en BDD
 * @return array|false un tableau contenant les champs du film ou FALSE si aucun produit n'a été récupéré
 */
function findFilmByRealId($id)
{
    $sql = "SELECT * FROM film f
    WHERE f.ID_realisateur= :id";
    $stmt = connexion()->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return ($stmt->fetchall());
}
/**
 * Retourne le film en base de données correspondant à l'id en paramètre
 * 
 * @param int $id l'identifiant du film en BDD
 * @return array|false un tableau contenant les champs du film ou FALSE si aucun produit n'a été récupéré
 */
function findCastingByFilmId($id)
{
    $sql = "SELECT * FROM casting c 
    inner join acteur a on a.ID_acteur = c.ID_acteur 
    inner join personnage p on p.ID_personnage = c.ID_personnage 
    WHERE c.ID_film= :id";
    $stmt = connexion()->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return ($stmt->fetchall());
}
/**
 * Retourne le film en base de données correspondant à l'id en paramètre
 * 
 * @param int $id l'identifiant du film en BDD
 * @return array|false un tableau contenant les champs du film ou FALSE si aucun produit n'a été récupéré
 */
function findRolesByacteurId($id)
{
    $sql = "SELECT * FROM personnage p 
    inner join casting c on c.ID_personnage=p.ID_personnage
    inner join acteur a on a.ID_acteur = c.ID_acteur 
    inner join film f on f.ID_film = c.ID_film
    WHERE c.ID_acteur= :id";
    $stmt = connexion()->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return ($stmt->fetchall());
}
/**
 * Retourne le film en base de données correspondant à l'id en paramètre
 * 
 * @param int $id l'identifiant du film en BDD
 * @return array|false un tableau contenant les champs du film ou FALSE si aucun produit n'a été récupéré
 */
function findacteurById($id)
{
    $sql = "SELECT * FROM acteur WHERE ID_acteur= :id";
    $stmt = connexion()->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return ($stmt->fetch());
}

/**
 * Retourne le realisateur en base de données correspondant à l'id en paramètre
 * 
 * @param int $id l'identifiant du realisateur en BDD
 * @return array|false un tableau contenant les champs du realisateur ou FALSE si aucun produit n'a été récupéré
 */
function findrealById($id)
{
    $sql = "SELECT r.ID_realisateur,nom_realisateur,prenom_realisateur FROM realisateur r 
    inner join film f on f.ID_realisateur = r.ID_realisateur 
    WHERE r.ID_realisateur= :id";
    $stmt = connexion()->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return ($stmt->fetch());
}
/**
 * Retourne le realisateur en base de données correspondant à l'id en paramètre
 * 
 * @param int $id l'identifiant du realisateur en BDD
 * @return array|false un tableau contenant les champs du realisateur ou FALSE si aucun produit n'a été récupéré
 */
function findreal()
{
    $sql = "SELECT * FROM realisateur";
    $stmt = connexion()->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return ($stmt->fetchall());
}
/**
 * ajoute un acteur en base de données 
 * 
 * @param prenom $prenom le nom du produit
 * @param nom $nom la description du produit
 * @param categorie $categorie la categorie du produit
 * @return int|false un entier du produit insere ou FALSE si aucun produit n'a été insere
 */
function ajoutActeur($prenom_acteur, $nom_acteur, $date_n)
{
    $sql = "INSERT INTO acteur (prenom_acteur, nom_acteur, date_naissance_acteur) VALUES (:prenom_acteur,:nom_acteur,:date_n)";
    $bddtmp = connexion();
    $stmt = $bddtmp->prepare($sql);
    $stmt->bindParam(":prenom_acteur", $prenom_acteur);
    $stmt->bindParam(":nom_acteur", $nom_acteur);
    $stmt->bindParam(":date_n", $date_n);
    $stmt->execute();
    $lastId = $bddtmp->lastInsertId();
    return $lastId;
}
/**
 * modifie le film en base de données correspondant à l'id en paramètre
 * 
 * @param int $id l'identifiant du film en BDD
 * @return array|false un tableau contenant les champs du realisateur ou FALSE si aucun produit n'a été récupéré
 */
function modifActeur($prenom_acteur, $nom_acteur, $date_n, $id)
{
    $sql = "UPDATE acteur SET prenom_acteur =:prenom_acteur, nom_acteur=:nom_acteur, date_naissance_acteur=:date_n where ID_acteur=:id";
    $bddtmp = connexion();
    $stmt = $bddtmp->prepare($sql);
    $stmt->bindParam(":prenom_acteur", $prenom_acteur);
    $stmt->bindParam(":nom_acteur", $nom_acteur);
    $stmt->bindParam(":date_n", $date_n);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $lastId = $bddtmp->lastInsertId();
    return $lastId;
}
/**
 * ajoute un acteur en base de données 
 * 
 * @param prenom $prenom le nom du produit
 * @param nom $nom la description du produit
 * @param categorie $categorie la categorie du produit
 * @return int|false un entier du produit insere ou FALSE si aucun produit n'a été insere
 */
function ajoutRealisateur($prenom_realisateur, $nom_realisateur)
{
    $sql = "INSERT INTO realisateur (prenom_realisateur, nom_realisateur) VALUES (:prenom_realisateur,:nom_realisateur)";
    $bddtmp = connexion();
    $stmt = $bddtmp->prepare($sql);
    $stmt->bindParam(":prenom_realisateur", $prenom_realisateur);
    $stmt->bindParam(":nom_realisateur", $nom_realisateur);
    $stmt->execute();
    $lastId = $bddtmp->lastInsertId();
    return $lastId;
}
/**
 * modifie le film en base de données correspondant à l'id en paramètre
 * 
 * @param int $id l'identifiant du film en BDD
 * @return array|false un tableau contenant les champs du realisateur ou FALSE si aucun produit n'a été récupéré
 */
function modifRealisateur($prenom_realisateur, $nom_realisateur, $id)
{
    $sql = "UPDATE realisateur SET prenom_realisateur =:prenom_realisateur, nom_realisateur=:nom_realisateur where ID_realisateur=:id";
    $bddtmp = connexion();
    $stmt = $bddtmp->prepare($sql);
    $stmt->bindParam(":prenom_realisateur", $prenom_realisateur);
    $stmt->bindParam(":nom_realisateur", $nom_realisateur);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $lastId = $bddtmp->lastInsertId();
    return $lastId;
}

/**
 * Retourne le realisateur en base de données correspondant à l'id en paramètre
 * 
 * @param int $id l'identifiant du realisateur en BDD
 * @return array|false un tableau contenant les champs du realisateur ou FALSE si aucun produit n'a été récupéré
 */
function findpersonnageById($id)
{
    $sql = "SELECT * FROM personnage p 
    WHERE p.ID_personnage= :id";
    $stmt = connexion()->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return ($stmt->fetch());
}
/**
 * ajoute un acteur en base de données 
 * 
 * @param prenom $prenom le nom du produit
 * @param nom $nom la description du produit
 * @param categorie $categorie la categorie du produit
 * @return int|false un entier du produit insere ou FALSE si aucun produit n'a été insere
 */
function ajoutPersonnage($nom_personnage)
{
    $sql = "INSERT INTO personnage (nom_personnage) VALUES (:nom_personnage)";
    $bddtmp = connexion();
    $stmt = $bddtmp->prepare($sql);
    $stmt->bindParam(":nom_personnage", $nom_personnage);
    $stmt->execute();
    $lastId = $bddtmp->lastInsertId();
    return $lastId;
}
/**
 * modifie le film en base de données correspondant à l'id en paramètre
 * 
 * @param int $id l'identifiant du film en BDD
 * @return array|false un tableau contenant les champs du realisateur ou FALSE si aucun produit n'a été récupéré
 */
function modifPersonnage($nom_personnage, $id)
{
    $sql = "UPDATE personnage SET nom_personnage =:nom_personnage where ID_personnage=:id";
    $bddtmp = connexion();
    $stmt = $bddtmp->prepare($sql);
    $stmt->bindParam(":nom_personnage", $nom_personnage);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $lastId = $bddtmp->lastInsertId();
    return $lastId;
}
/**
 * ajoute un acteur en base de données 
 * 
 * @param prenom $prenom le nom du produit
 * @param nom $nom la description du produit
 * @param categorie $categorie la categorie du produit
 * @return int|false un entier du produit insere ou FALSE si aucun produit n'a été insere
 */
function ajoutFilm($titre_film, $annee_sortie_film,$duree_film,$synopsis_film,$affiche_film,$note_film,$ID_realisateur)
{
    $sql = "INSERT INTO film (titre_film, annee_sortie_film,duree_film,synopsis_film,affiche_film,note_film,ID_realisateur ) VALUES (:titre_film,:annee_sortie_film,:duree_film,:synopsis_film,:affiche_film,:note_film,:ID_realisateur)";
    $bddtmp = connexion();
    $stmt = $bddtmp->prepare($sql);
    $stmt->bindParam(":titre_film", $titre_film);
    $stmt->bindParam(":annee_sortie_film", $annee_sortie_film);
    $stmt->bindParam(":duree_film", $duree_film);
    $stmt->bindParam(":synopsis_film", $synopsis_film);
    $stmt->bindParam(":affiche_film", $affiche_film);
    $stmt->bindParam(":note_film", $note_film);
    $stmt->bindParam(":ID_realisateur", $ID_realisateur);
    $stmt->execute();
    $lastId = $bddtmp->lastInsertId();
    return $lastId;
}
/**
 * modifie le film en base de données correspondant à l'id en paramètre
 * 
 * @param int $id l'identifiant du film en BDD
 * @return array|false un tableau contenant les champs du realisateur ou FALSE si aucun produit n'a été récupéré
 */
function modifFilm($titre_film, $annee_sortie_film,$duree_film,$synopsis_film,$affiche_film,$note_film,$ID_realisateur, $id)
{
    $sql = "UPDATE film SET titre_film =:titre_film, annee_sortie_film=:annee_sortie_film,duree_film =:duree_film, synopsis_film=:synopsis_film,affiche_film =:affiche_film, note_film=:note_film,ID_realisateur=:ID_realisateur where ID_film=:id";
    $bddtmp = connexion();
    $stmt = $bddtmp->prepare($sql);
    $stmt->bindParam(":titre_film", $titre_film);
    $stmt->bindParam(":annee_sortie_film", $annee_sortie_film);
    $stmt->bindParam(":duree_film", $duree_film);
    $stmt->bindParam(":synopsis_film", $synopsis_film);
    $stmt->bindParam(":affiche_film", $affiche_film);
    $stmt->bindParam(":note_film", $note_film);
    $stmt->bindParam(":ID_realisateur", $ID_realisateur);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $lastId = $bddtmp->lastInsertId();
    return $lastId;
}
