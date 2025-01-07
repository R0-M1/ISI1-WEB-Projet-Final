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
                $method = 'voirStagiaire';
                break;
            case 'supprimer_stage':
                $method = 'supprimerStage';
                break;
            case 'supprimer_etu':
                $method = 'supprimerEtudiant';
                break;
            case 'ajouter':
                $method = 'ajouterEtudiant';
                break;
            case 'modifier_etu':
                $method = 'modifierEtudiant';
                break;
            default:
                $method = 'index'; // Méthode par défaut si l'action n'est pas reconnue
                break;
        }
        break;
    case 'inscription':
        $controller = 'InscriptionController';
        switch ($action) {
            case 'inscrire':
                $method = 'inscrire';
                break;
            case 'modifier':
                $method = 'modifier';
                break;
            default:
                $method = 'inscrire'; // Méthode par défaut
                break;
        }
        break;
    case 'aide':
        $controller = 'AideController';
        $method = 'index';
        break;
    case 'connexion':
        $controller = 'ConnexionController';
        $method = 'index';
        break;
    case 'deconnexion':
        $controller = 'ConnexionController';
        $method = 'deconnexion';
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
    if($id) {
        $controllerObject->$method($id);
    } else {
        $controllerObject->$method();
    }
} else {
    echo "404 Not Found";
}
