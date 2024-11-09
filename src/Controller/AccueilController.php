<?php
namespace App\Controller;

class AccueilController{
    public function index(){
        echo $this->renderView('testMain.twig', []);
    }
    private function renderView($view, $data = []) {
        $loader = new \Twig\Loader\FilesystemLoader('../src/View');
        $twig = new \Twig\Environment($loader);
        return $twig->render($view, $data);
    }
}