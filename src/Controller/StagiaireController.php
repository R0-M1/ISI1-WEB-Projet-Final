<?php
namespace App\Controller;

use App\Model\Stagiaire;

class StagiaireController extends BaseController{
    private $userModel;
    public function __construct($pdo)
    {
        $this->userModel=new Stagiaire($pdo);
    }

    public function index(){
        echo $this->renderView('stagiaire/index.twig', ['stagiaires' => $this->userModel->getAllStagiaires()]);
    }

    public function rechercherStagiaire(){
        echo $this->renderView('stagiaire/rechercherStagiaire.twig');
    }

    public function supprimerStagiaire($id){
        $this->userModel->supprimerStagiaire($id);
        header('Location: ?page=stagiaire&action=index');
    }
}