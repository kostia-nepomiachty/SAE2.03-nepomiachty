<?php
/**
 * Ce fichier contient toutes les fonctions qui réalisent des opérations
 * sur la base de données, telles que les requêtes SQL pour insérer, 
 * mettre à jour, supprimer ou récupérer des données.
 */

/**
 * Définition des constantes de connexion à la base de données.
 *
 * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
 * DBNAME : Nom de la base de données
 * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
 * DBPWD : Mot de passe pour se connecter à la base de données.
 */
$url = $_SERVER['REMOTE_ADDR'];
$env = 'prod';
if ( strpos($url, '~nepomiachty1') === false) 
    $env = 'local';

if ($env == 'local') {
    define("HOST", "localhost");
    define("DBNAME", "nepomiachty1");
    define("DBLOGIN", "root");
    define("DBPWD", "Kostia123");
}    
else {
    define("HOST", "localhost");
    define("DBNAME", "nepomiachty1");
    define("DBLOGIN", "nepomiachty1");
    define("DBPWD", "nepomiachty1");
}
