<?php
// src/Controller/SiteController.php
namespace App\Controller;

use App\Model\Entreprise;

class SiteController
{
    public function accueil()
    {
        // Logique pour récupérer les données nécessaires
        // Exemple : récupérer les entreprises
        // $entreprises = Entreprise::findAll();

        // Inclure Twig et afficher la vue correspondante
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $twig = new \Twig\Environment($loader);
        echo $twig->render('accueil.twig', []);
    }

    public function aide()
    {
        // Logique spécifique à la page d'aide
        echo $this->render('aide.twig');
    }

    public function entreprise()
    {
        // Logique pour afficher les informations d'une entreprise spécifique
        $entreprise = Entreprise::findById($id);

        echo $this->render('entreprise.twig', [
            'entreprise' => $entreprise
        ]);
    }

    private function render($view, $data = [])
    {
        // Cette méthode inclut le template Twig avec les données nécessaires
        // Supposons que tu as une instance de Twig initialisée ici
        global $twig;
        echo $twig->render($view, $data);
    }
}
