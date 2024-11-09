<?php
namespace App\Controller;

class AccueilController extends BaseController{
    public function index(){
        echo $this->renderView('accueil.twig');
    }
}