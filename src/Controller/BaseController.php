<?php
namespace App\Controller;

class BaseController
{
    protected function renderView($view, $data = [])
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['isLogged']) || !$_SESSION['isLogged']) {
            if(!isset($_GET['page']) || $_GET['page']!=='connexion') {
                header('Location: ?page=connexion');
                exit();
            }
        } else {
            $data['role'] = $_SESSION['role'];
        }
        
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 'accueil'; // Par défaut 'accueil'

        $loader = new \Twig\Loader\FilesystemLoader('../src/View');
        $twig = new \Twig\Environment($loader);

        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]";
        $twig->addGlobal('base_url', $actual_link.'/ISI1-WEB-Projet-Final');

        return $twig->render($view, $data);
    }
}