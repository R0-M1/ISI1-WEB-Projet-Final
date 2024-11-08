<?php
use App\Controller\testController;

// Récupérer les paramètres de l'URL
$page = $_GET['page'] ?? null // Page active
$action = $_GET['action'] ?? null; // Action de la route

// Initialisation du contrôleur
$controller = null;
$method = null;

switch ($page) { // TODO faire un double switch, un switch($action) imbriqué dans un switch($page)
    case 'accueil':
        $controller = 'SiteController';
        $method = 'accueil';
        break;
    default:
        $controller = 'AccueilController';
        $method = 'index';
        break;
}

// Vérifier si le contrôleur et la méthode sont définis et appelés
if ($controller && $method) {
    require_once '../config/database.php'; // Connexion à la base de données
    $controllerClass = 'App\\Controller\\' . $controller;
    $controllerObject = new $controllerClass($pdo);

    // Appeler la méthode du contrôleur avec l'ID si besoin
    if ($action == 'edit' || $action == 'update' || $action == 'delete') {
        $controllerObject->$method($id);
    } else {
        $controllerObject->$method();
    }
} else {
    echo "404 Not Found";
}
?>