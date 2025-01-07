<?php
namespace App\Controller;

use App\Model\Entreprise;
use App\Model\Stagiaire;

class InscriptionController extends BaseController{
    private $entrepriseModel;
    private $stagiaireModel;

    public function __construct($pdo)
    {
        $this->entrepriseModel = new Entreprise($pdo);
        $this->stagiaireModel = new Stagiaire($pdo);
    }
    public function inscrire($id=null){
        session_start();
        if($_SESSION['role']=='professeur') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $entreprise = $_POST['entreprise'] ?? '';
                $etudiant = $_POST['etudiant'] ?? '';
                $professeur = $_POST['professeur'] ?? '';
                $dateDebut = $_POST['date_debut'] ?? '';
                $dateFin = $_POST['date_fin'] ?? '';
                $typeStage = $_POST['type_stage'] ?? '';
                $description = $_POST['description'] ?? '';
                $observation = $_POST['observation'] ?? '';

                $this->stagiaireModel->ajouterStage($entreprise, $etudiant, $professeur, $dateDebut, $dateFin, $typeStage, $description, $observation);
                header('Location: ?page=stagiaire');
            } else {
                $entreprises = $this->entrepriseModel->getAllEntreprises();
                $etudiants = $this->stagiaireModel->getAllEtudiants();
                $professeurs = $this->stagiaireModel->getAllProfesseurs();

                $data = ['entreprises' => $entreprises, 'etudiants' => $etudiants, 'professeurs' => $professeurs];

                if($id!=null){
                    $data['currentEntreprise'] = $this->entrepriseModel->getEntrepriseById($id);
                }
                echo $this->renderView('inscription/formulaireStage.twig', $data);
            }
        } else echo $this->renderView('403.twig');
    }

    public function modifier($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $entreprise = $_POST['entreprise'] ?? '';
            $etudiant = $_POST['etudiant'] ?? '';
            $professeur = $_POST['professeur'] ?? '';
            $dateDebut = $_POST['date_debut'] ?? '';
            $dateFin = $_POST['date_fin'] ?? '';
            $typeStage = $_POST['type_stage'] ?? '';
            $description = $_POST['description'] ?? '';
            $observation = $_POST['observation'] ?? '';

            $this->stagiaireModel->modifierStage($id, $entreprise, $etudiant, $professeur, $dateDebut, $dateFin, $typeStage, $description, $observation);
            header('Location: ?page=stagiaire');
        } else {
            $entreprises = $this->entrepriseModel->getAllEntreprises();
            $etudiants = $this->stagiaireModel->getAllEtudiants();
            $professeurs = $this->stagiaireModel->getAllProfesseurs();

            $stage = $this->stagiaireModel->getStageById($id);

            echo $this->renderView('inscription/formulaireStage.twig', ['entreprises' => $entreprises, 'etudiants' => $etudiants, 'professeurs' => $professeurs, 'stage' => $stage]);
        }
    }
}