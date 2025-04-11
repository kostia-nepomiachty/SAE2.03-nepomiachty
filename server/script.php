<?php
/** ARCHITECTURE PHP SERVEUR : Rôle du fichier script.php
 * 
 * Ce fichier est celui à qui on adresse toutes les requêtes HTTP.
 * Pour être valide, on décide que chaque requête doit contenir un paramètre 'todo'.
 * C'est un choix d'implémentation, on aurait pu choisir un autre nom de paramètre.
 * L'interprétation de la requête se fait en fonction de la valeur du paramètre 'todo'.
 * Selon cette valeur, on fait appelle à la fonction de contrôleur (voir controller.php)
 * appropriée pour traiter la requête HTTP et produire la réponse HTTP attendue..
 * 
 * Pourquoi faire comme ça ?
 * 
 *  En ajoutant un paramètre 'todo' dans la requête, on a un seul paramètre à regarder pour déterminer l'action à effectuer.
 *  Sinon il faudrait toujours analyser tous les paramètres de la requête pour déterminer l'action à effectuer.
 *  Et dans une véritable application il peut y avoir énormément de paramètres, ce qui deviendrait compliqué et illisible.
 * 
 */

/**
 * Inclusion du fichier controller.php.
 * 
 * Il contient les fonctions nécessaires pour traiter chaque type de requête
 * et définir la réponnse à renvoyer au client.
 */
require("controller.php");

/**
 * Vérifie si la variable 'todo' est définie dans la requête.
 * 
 * Cette condition permet de déterminer si un paramètre 'todo' a été envoyé
 * via une requête HTTP. 
 * Si ce paramètre est présent, le code à l'intérieur du bloc conditionnel sera exécuté.
 */
$data = false;

//if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  if ( isset($_REQUEST['todo']) ){

    /**
     * La fonction PHP header permet de définir l'en-tête HTTP de la réponse.
     * 
     * A ce stade on sait qu'on va répondre à la requête HTTP avec du contenu JSON (même pour signaler une erreur).
     * Donc on définit de suite l'en-tête de la réponse HTTP pour indiquer que le contenu sera de type JSON.
     * Ce n'est pas obligatoire, mais c'est une bonne pratique pour indiquer clairement le type de contenu.
     * Le client à qui on répond pourra tester le type de contenu de la réponse pour mieux comprendre et 
     * traiter la réponse du serveur.
     */
    header('Content-Type: application/json');

    // Récupère la valeur du paramètre 'todo' dans le tableau $_REQUEST
    // $_REQUEST est une superglobale qui contient les paramètres de la requête HTTP.
    $todo = $_REQUEST['todo'];

    // en fonction de la valeur de 'todo', on appelle la fonction de contrôle appropriée
    // peut s'écrire aussi avec des if/else
    switch($todo){
      case 'readmovie':
        $categorie = '';
        if (isset($_REQUEST['categorie'])) {
          $categorie = $_REQUEST['categorie'];
        }
        $data = liste_films($categorie);
        break;

      case 'readMovieDetail':
        if (!isset($_REQUEST['id'])) {
          http_response_code(400); // 400 == "Bad request"
          exit();
        }
        $id = $_REQUEST['id'];
        $data = get_film($id);
        break;

      case 'addMovie':
        $name = (isset($_POST['titre'])) ? $_POST['titre'] : '';
        //error_log("[DEBUG #01] titre=".$name);
        $director = (isset($_POST['nom'])) ? $_POST['nom'] : '';
        $year = (isset($_POST['annee'])) ? $_POST['annee'] : 0;
        $length = (isset($_POST['duree'])) ? $_POST['duree'] : 0;
        $description = (isset($_POST['desci'])) ? $_POST['desci'] : '';
        $id_category = (isset($_POST['categorie'])) ? $_POST['categorie'] : '';
        $image = (isset($_POST['ilustra'])) ? $_POST['ilustra'] : '';
        $trailer = (isset($_POST['lienyt'])) ? $_POST['lienyt'] : '';
        $min_age = (isset($_POST['age'])) ? $_POST['age'] : 0;
        $data = addMovie($name, $director, $year, $length, $description, $id_category, $image, $trailer,$min_age);
        break;

      case 'addProfile':
        //error_log("[DEBUG #01] titre=".$name);
        $name = (isset($_POST['name'])) ? $_POST['name'] : '';
        $photo = (isset($_POST['photo'])) ? $_POST['photo'] : '';
        $min_age = (isset($_POST['min_age'])) ? $_POST['min_age'] : 0;
        $data = addProfile($name, $photo, $min_age);
        break;

      case 'listCategories':
        $data = list_categories();
        break;

      default: // il y a un paramètre todo mais sa valeur n'est pas reconnue/supportée
        echo json_encode('[error] Unknown todo value');
        http_response_code(400); // 400 == "Bad request"
        exit();
    }

    /**
     * A ce stade, on a appelé la fonction de contrôleur appropriée et stocké le résultat dans la variable $data.
     * 
     * On a décidé que si les fonctions de contrôleur échouaient à répondre normalement à la requête HTTP,
     * elle devait retourner false (par exemple il peut arriver que le serveur de base de données soit down).
     * C'est un choix qui nous permet de savoir si un problème est survenu et de retourner un message d'erreur.
     * Si la fonction de contrôleur retourne false, on renvoie une réponse JSON avec un message d'erreur 
     * et un code de réponse HTTP 500 (Internal error), puis termine l'exécution du script (exit()).
     */
    if ($data===false){
      echo json_encode('[error] Controller returns false');
      http_response_code(500); // 500 == "Internal error"
      exit(); 
    }

    /**
     * Si tout s'est bien passé, on renvoie la réponse HTTP avec les données ($data) retournées
     * par la fonction de contrôleur et encodées en JSON (json_encode).
     * On renvoie aussi un code de réponse HTTP 200 (OK) pour indiquer que la requête a été traitée avec succès.
     */
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    //echo $data;
    http_response_code(200); // 200 == "OK"
    exit();

    
  } // fin de if ( isset($_REQUEST['todo']) )
//}

/**
 * Cette partie du code n'est atteinte que si la variable 'todo' n'est pas définie dans la requête.
 * La conception de notre script est basée sur le fait qu'une variable todo doit être définie. Dans
 * le cas contraire, on considère que la requête est invalide et on renvoie un code de réponse 
 * HTTP 404 (Not found), indiquant que la requête HTTP ne correspond à rien.
 */
http_response_code(404); // 404 == "Not found"
 





/*

class Films {
  // Properties
  public $nom;
  public $annee;
  public $genre;

}

$film1 = new Films();
$film1->nom = 'Totoro';
$film1->annee = 1988;
$film1->genre = 'Manga';

$film2 = new Films();
$film2->nom = 'Le Voyage de Chihiro';
$film2->annee = 2001;
$film2->genre = 'Manga';

$erreur = 'Pas d\'erreur';

$films = array();
$films['donnees'] = array($film1, $film2);
$films['erreur'] = $erreur;


$myJSON = json_encode($films);
echo $myJSON;

/ *
{
    "donnees": [{
        "nom": "Totoro",
        "annee": 1988,
        "genre": "Manga"
    }, {
        "nom": "Le Voyage de Chihiro",
        "annee": 2001,
        "genre": "Manga"
    }],
    "erreur": "Pas d'erreur"
}
*/
?>