<?php

require("controller.php");

// Connexion à la base de données
echo "DEBUG 1<br/>";
try {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    echo "DEBUG 2<br/>";
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = 'SELECT * FROM category';
    echo "DEBUG 3<br/>";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    echo "DEBUG 4<br/>";
    // Exécute la requête SQL
    $stmt->execute();
    echo "DEBUG 5<br/>";
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo "DEBUG 6<br/>";
    print_r($res); // Retourne les résultats   
}
catch(Exception $e) {
    echo 'Message: ' . $e->getMessage();
}



?>