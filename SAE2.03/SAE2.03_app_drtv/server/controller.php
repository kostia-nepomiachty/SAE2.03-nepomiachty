<?php

/** ARCHITECTURE PHP SERVEUR  : Rôle du fichier controller.php
 * 
 *  Dans ce fichier, on va définir les fonctions de contrôle qui vont traiter les requêtes HTTP.
 *  Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php)
 *  Pour chaque valeur différente, on déclarera une fonction de contrôle différente.
 * 
 *  Les fonctions de contrôle vont éventuellement lire les paramètres additionnels de la requête, 
 *  les vérifier, puis appeler les fonctions du modèle (model.php) pour effectuer les opérations
 *  nécessaires sur la base de données.
 *  
 *  Si la fonction échoue à traiter la requête, elle retourne false (mauvais paramètres, erreur de connexion à la BDD, etc.)
 *  Sinon elle retourne le résultat de l'opération (des données ou un message) à includre dans la réponse HTTP.
 */

/** Inclusion du fichier model.php
 *  Pour pouvoir utiliser les fonctions qui y sont déclarées et qui permettent
 *  de faire des opérations sur les données stockées en base de données.
 */
require("model.php");


function liste_films($categorie, $min_age, $profile, $favorite) {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $where = '';
    $categorie = addslashes($categorie);
    if ($categorie != '') $where = " WHERE id_category='$categorie' ";

    if ($min_age != '') {
        if ($where == '') 
            $where = ' WHERE ';
        else 
            $where .= ' AND ';
        $where .= "  min_age<=$min_age ";
    }
    $sql = "select id, name, description, image from movie $where";

    if ($favorite) {
        $sql = "select m.id, m.name, m.description, m.image from movie m inner join favorite f on f.id_movie=m.id $where";
        if ($where == '') 
            $where = ' WHERE ';
        else 
            $where .= ' AND ';
        $where .= "  f.id_movie=$profile ";
    }

    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    /*
    array_push(
        $res, 
        array('sql' => $sql)
    );
    */
    return $res; // Retourne les résultats
}

function addMovie($name, $director, $year, $length, $description, $id_category, $image, $trailer,$min_age ) {
    // Connexion à la base de données                                                                       
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
//         addMovie($name, $director, $year, $length, $description, $id_category, $image, $trailer,$min_age);

    $sql = 'INSERT INTO movie(name, director, year, length, description, id_category, image, trailer, min_age) VALUES(:name, :director, :year, :length, :description, :id_category, :image, :trailer, :min_age)';

    $stmt = $cnx->prepare($sql);
    $name = addslashes($name);
    $director = addslashes($director);
    $year = addslashes($year);
    $length = addslashes($length);
    $description = addslashes($description);
    $id_category = addslashes($id_category); 
    $image = addslashes($image);
    $trailer = addslashes($trailer);
    $min_age = addslashes($min_age);


    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':director', $director);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':length', $length);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id_category', $id_category);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':trailer', $trailer);
    $stmt->bindParam(':min_age', $min_age);

    $stmt->execute();

    $lastInsertId = $cnx->lastInsertId();
    return array('id' => $lastInsertId);    
}

function get_film($id) {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = <<<SQL
        SELECT m.id, m.name, m.year, m.length, m.description, m.director, c.name as category, m.image, m.trailer, m.min_age 
        FROM movie m 
        INNER JOIN category c ON c.id = m.id_category 
        WHERE m.id = :id
    SQL;

    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    $id = addslashes($id);
    $stmt->bindParam(':id', $id);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

function get_category($id_category) {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = <<<SQL

    $sql = <<<SQL
        SELECT m.id, c.id_category FROM movie m 
        INNER JOIN category c ON c.id = m.id_category 
        WHERE c.id_category = :id_category 
    SQL;

    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    $id_category = addslashes($id_category);
    $stmt->bindParam(':id_category', $id_category);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

function list_categories() {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = 'SELECT * FROM category';
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

function read_profiles() {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer les profils
    $sql = 'SELECT * FROM profile';
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

function read_profile($id) {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer les profils
    $id = addslashes($id);
    $sql = 'SELECT * FROM profile WHERE id = :id';
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id', $id);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

//$data = addProfile($name, $photo, $min_age);
function addProfile($name, $photo, $min_age) {
    // Connexion à la base de données      po $id_profile
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
//         addProfile($name, $director, $year, $length, $description, $id_category, $image, $trailer,$min_age);

    $sql = 'INSERT INTO profile(name, photo, min_age) VALUES(:name, :photo, :min_age)';
//                                              po id_profile                   :id_profile
    $stmt = $cnx->prepare($sql);
    $name = addslashes($name);
    $photo = addslashes($photo);
    $min_age = addslashes($min_age);
    // po $id_profile = addslashes($id_profile);

    $stmt->bindParam(':name', $name); // protège les simples guillemets en ajoutant un backslash
    $stmt->bindParam(':photo', $photo);
    $stmt->bindParam(':min_age', $min_age);
    // po $stmt->bindParam(':id_profile', $id_profile);
    $stmt->execute();

    $lastInsertId = $cnx->lastInsertId();
    return array('id' => $lastInsertId);    
} 


function updateProfile($id, $name, $photo, $min_age) {
    if ($id == '') {
        return array('id' => -1, 'error' => 'id requis');
        exit;
    }
    // Connexion à la base de données      po $id_profile
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
//         addProfile($name, $director, $year, $length, $description, $id_category, $image, $trailer,$min_age);

    $sql = 'UPDATE profile SET name = :name, photo = :photo, min_age = :min_age WHERE id = :id';
//                                              po id_profile                   :id_profile
    $stmt = $cnx->prepare($sql);
    $id = addslashes($id);
    $name = addslashes($name);
    $photo = addslashes($photo);
    $min_age = addslashes($min_age);
    // po $id_profile = addslashes($id_profile);

    $stmt->bindParam(':name', $name); // protège les simples guillemets en ajoutant un backslash
    $stmt->bindParam(':photo', $photo);
    $stmt->bindParam(':min_age', $min_age);
    $stmt->bindParam(':id', $id);
    // po $stmt->bindParam(':id_profile', $id_profile);
    $stmt->execute();

    return array('id' => $id);    
} 

/* po
function get_category($id_profile) {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = <<<SQL

    $sql = <<<SQL
        SELECT m.id, p.id_profile FROM movie m 
        INNER JOIN category c ON c.id = m.id_profile 
        WHERE c.id_profile = :id_profile 
    SQL;

    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    $id_profile = addslashes($id_profile);
    $stmt->bindParam(':id_profile', $id_profile);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}
*/

function addFavorite($id_profile, $id_movie) {
    // Connexion à la base de données      po $id_profile
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $id_profile = addslashes($id_profile);
    $id_movie = addslashes($id_movie);

    $sql = 'SELECT COUNT(*) AS C FROM favorite WHERE id_profile = :id_profile AND id_movie = :id_movie';
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_profile', $id_profile); 
    $stmt->bindParam(':id_movie', $id_movie);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    if ($res->C >= 1) {
        return array(
            'id_profile' => $id_profile, 
            'id_movie' => $id_movie,
            'status' => 'existe deja'
        );    
    }

    $sql = 'INSERT INTO favorite(id_profile, id_movie) VALUES(:id_profile, :id_movie)';
    $stmt = $cnx->prepare($sql);

    $stmt->bindParam(':id_profile', $id_profile); 
    $stmt->bindParam(':id_movie', $id_movie);
    $stmt->execute();
    $lastInsertId = $cnx->lastInsertId();
    return array(
        'id' => $lastInsertId, 
        'id_profile' => $id_profile, 
        'id_movie' => $id_movie,
        'status' => 'ok'
    );    
} 

function readFavorite($id_profile, $id_movie) {
    // Connexion à la base de données      po $id_profile
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $id_profile = addslashes($id_profile);
    $id_movie = addslashes($id_movie);

    $sql = 'SELECT COUNT(*) AS C FROM favorite WHERE id_profile = :id_profile AND id_movie = :id_movie';
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_profile', $id_profile); 
    $stmt->bindParam(':id_movie', $id_movie);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    $is_favorite = ($res->C >= 1) ? 1 : 0;
    return array(
        'is_favorite' => $is_favorite 
    );    
} 

function readFavorites($id_profile) {
    // Connexion à la base de données      po $id_profile
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $id_profile = addslashes($id_profile);
    $id_movie = addslashes($id_movie);

    $sql = 'SELECT id_movie FROM favorite WHERE id_profile = :id_profile';
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_profile', $id_profile); 
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;
} 


//deleteFavorite
function deleteFavorite($id_profile, $id_movie) {
    // Connexion à la base de données      po $id_profile
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $id_profile = addslashes($id_profile);
    $id_movie = addslashes($id_movie);
    $sql = 'DELETE FROM favorite WHERE id_profile = :id_profile AND id_movie = :id_movie';
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_profile', $id_profile); 
    $stmt->bindParam(':id_movie', $id_movie);
    $stmt->execute();

    return array(
        'status' => 'ok'
    );    
} 

function bad_http_verb($v) {
      echo json_encode("[error] Mauvais verb http. Attendu: $v");
      http_response_code(500); // 500 == "Internal error"
      exit();
}























/*----------------------------------------------------------------------------------* /
function readController(){
 
    // PREMIERE VERIFICATION : LES PARAMETRES EXISTENT ET SONT NON VIDES
    // Vérification du paramètre 'semaine' 
    if ( isset($_REQUEST['semaine'])==false || empty($_REQUEST['semaine'])==true ){
        return false;
    }
    // Vérification du paramètre 'jour'
    if ( isset($_REQUEST['jour'])==false || empty($_REQUEST['jour'])==true ){
        return false;
    }

    // DEUXIEME VERIFICATION : LES PARAMETRES EXISTENT MAIS LEUR VALEURS SONT-ELLES VALIDES ?
    $semaine = $_REQUEST['semaine'];
    // $ semaine doit être un entier entre 1 et 52
    if ($semaine<1 || $semaine>52){
        return false;
    }
    $jour = $_REQUEST['jour'];
    // $jour doit être un jour de la semaine
    // Tableau des jours de la semaine, va servir à vérifier si le jour spécifié est valide
    $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
    // in_array retourne true si $jour est dans $days, false sinon. C'est une fonction native PHP.
    if ( in_array($jour, $days)==false ){ // $jour n'est pas un jour de la semaine
       return false;
    }
    
    // si on arrive ici c'est que les paramètres existent et sont valides, on peut interroger la BDD
    // Appel de la fonction getMenu déclarée dans model.php pour extraire de la BDD le menu du jour spécifié
    $menu = getMenu($semaine, $jour);
    return $menu;
}

function readController(){

} */