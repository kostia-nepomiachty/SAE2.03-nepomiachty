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
$url = $_SERVER['HTTP_HOST'];
$env = 'prod';
if ( strpos($url, 'mmi-limoges.fr') === false) 
    $env = 'local';

if ($env == 'local') {
    define("HOST", "localhost");
    define("DBNAME", "nepomiachty1");
    define("DBLOGIN", "root");
    define("DBPWD", "Kostia123");
}    
else {
    define("HOST", "localhost");
    define("DBNAME", "SAE203");
    define("DBLOGIN", "usersae203");
    define("DBPWD", 'Pi(||0uTEur');
}
