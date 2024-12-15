<?php
use App\Controller;

// Récupérer les paramètres de l'URL
$page = $_GET['page'] ?? null; // Page active
$action = $_GET['action'] ?? null; // Action de la route
$id = $_GET['id'] ?? null; // Id de l'entreprise

// Initialisation du contrôleur
$controller = null;
$method = null;

switch ($page) {
    case 'entreprise':
        $controller = 'EntrepriseController';
        switch ($action) {
            case 'index':
                $method = 'index';
                break;
            case 'rechercher':
                $method = 'rechercherEntreprise';
                break;
            case 'ajouter':
                $method = 'ajouterEntreprise';
                break;
            case 'voir':
                $method = 'voirEntreprise';
                break;
            case 'modifier':
                $method = 'modifierEntreprise';
                break;
            case 'supprimer':
                $method = 'supprimerEntreprise';
                break;
            default:
                $method = 'index'; // Méthode par défaut si l'action n'est pas reconnue
                break;
        }
        break;
    case 'stagiaire':
        $controller = 'StagiaireController';
        switch ($action) {
            case 'index':
                $method = 'index';
                break;
            case 'rechercher':
                $method = 'rechercherStagiaire';
                break;
            case 'voir':
                $method = 'voirStagiaire.twig';
                break;
            case 'modifier':
                $method = 'modifierStagiaire';
                break;
            case 'supprimer':
                $method = 'supprimerStagiaire';
                break;
            default:
                $method = 'index'; // Méthode par défaut si l'action n'est pas reconnue
                break;
        }
        break;
    case 'inscription':
        $controller = 'InscriptionController';
        $method = 'index';
        break;
    case 'aide':
        $controller = 'AideController';
        $method = 'index';
        break;
    default:
        $controller = 'AccueilController';
        $method = 'index';
        break;
}

// Vérifier si le contrôleur et la méthode sont définis et appelés
if ($controller && $method) {
    require_once '../config/database.php'; // Connexion à la base de données
    //require_once '../src/Controller/' . $controller . '.php'; // Importe le controller actif
    $controllerClass = 'App\\Controller\\' . $controller;
    $controllerObject = new $controllerClass($pdo); // TODO pas toutes les classes doivent etre construites avec $pdo. Etre sur que ça ne pose pas de problème de construire toutes les classes avec ça
    if($action='voir' || $action='modifier' || $action='supprimer') {
        $controllerObject->$method($id);
    } else {
        $controllerObject->$method();
    }
} else {
    echo "404 Not Found";
}
