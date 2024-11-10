<?php
namespace App\Controller;

class StagiaireController extends BaseController{
    public function index(){
        echo $this->renderView('stagiaire/index.twig');
    }
}