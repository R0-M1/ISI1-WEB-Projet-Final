<?php
namespace App\Controller;

use App\Model\Stagiaire;

class StagiaireController extends BaseController{
    private $stagiaireModel;
    public function __construct($pdo)
    {
        $this->stagiaireModel=new Stagiaire($pdo);
    }

    public function index(){
        session_start();
        if($_SESSION['role']=='professeur') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo $this->renderView("stagiaire/index.twig", ['stagiaires' => $this->stagiaireModel->getStagiairesByCriteria($_POST['nomEntreprise'] ?? '', $_POST['nomE'] ?? '', $_POST['prenomE'] ?? '', $_POST['nomP'] ?? '', $_POST['prenomP'] ?? '')]);
            } else {
                echo $this->renderView('stagiaire/index.twig', ['stagiaires' => $this->stagiaireModel->getAllStagiaires()]);
            }
        } else echo $this->renderView('403.twig');
    }

    public function rechercherStagiaire(){
        echo $this->renderView('stagiaire/rechercherStagiaire.twig');
    }

    public function voirStagiaire($id){
        echo $this->renderView('stagiaire/voirStagiaire.twig', ['stagiaire' => $this->stagiaireModel->getStagiaireById($id)]);
    }

    public function supprimerStage($id){
        $this->stagiaireModel->supprimerStage($id);
        header('Location: ?page=stagiaire&action=index');
    }

    public function supprimerEtudiant($id){
        $this->stagiaireModel->supprimerEtudiant($id);
        header('Location: ?page=stagiaire&action=index');
    }

    public function ajouterEtudiant()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nomEtudiant  = $_POST['nom_etudiant'] ?? '';
            $prenomEtudiant = $_POST['prenom_etudiant'] ?? '';
            $login = $_POST['login'] ?? '';
            $mdp = $_POST['mdp'] ?? '';
            $anneeObtention = $_POST['annee_obtention'] ?? '';
            $classe = $_POST['classe'] ?? '';

            $this->stagiaireModel->ajouterEtudiant($nomEtudiant, $prenomEtudiant, $login, $mdp, $anneeObtention, $classe);

            header('Location: ?page=stagiaire&action=index');
        } else {
            echo $this->renderView('stagiaire/formulaireEtudiant.twig', ['classes' => $this->stagiaireModel->getAllClasses()]);
        }
    }
    public function modifierEtudiant($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nomEtudiant  = $_POST['nom_etudiant'] ?? '';
            $prenomEtudiant = $_POST['prenom_etudiant'] ?? '';
            $login = $_POST['login'] ?? '';
            $mdp = $_POST['mdp'] ?? '';
            $anneeObtention = $_POST['annee_obtention'] ?? '';
            $classe = $_POST['classe'] ?? '';
            $this->stagiaireModel->modifierEtudiant($id, $nomEtudiant, $prenomEtudiant, $login, $mdp, $anneeObtention, $classe);

            header('Location: ?page=stagiaire&action=index');
        } else {
            echo $this->renderView('stagiaire/formulaireEtudiant.twig', ['etudiant' => $this->stagiaireModel->getStagiaireById($id)[0], 'classes' => $this->stagiaireModel->getAllClasses()]);
        }
    }
}