<?php
namespace App\Controller;

class BaseController
{
    protected function renderView($view, $data = [])
    {
        $data['page'] = isset($_GET['page']) ? $_GET['page'] : 'accueil'; // Par défaut 'accueil'

        $loader = new \Twig\Loader\FilesystemLoader('../src/View');
        $twig = new \Twig\Environment($loader);
        return $twig->render($view, $data);
    }
}