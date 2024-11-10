<?php
namespace App\Controller;
use App\Model\Entreprise;

class EntrepriseController extends BaseController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new Entreprise($pdo);
    }

    public function index()
    {
        echo $this->renderView('entreprise/index.twig', ['entreprises' => $this->userModel->getAllEntreprises()]);
    }

    public function rechercherEntreprise(){
        echo $this->renderView('entreprise/rechercherEntreprise.twig');
    }

    public function ajouterEntreprise()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nomEntreprise = $_POST['nom_entreprise'] ?? '';
            $nomContact = $_POST['nom_contact'] ?? '';
            $nomResponsable = $_POST['nom_responsable'] ?? '';
            $rue = $_POST['rue'] ?? '';
            $codePostal = $_POST['code_postal'] ?? '';
            $ville = $_POST['ville'] ?? '';
            $telephone = $_POST['telephone'] ?? '';
            $fax = $_POST['fax'] ?? '';
            $email = $_POST['email'] ?? '';
            $observation = $_POST['observation'] ?? '';
            $url = $_POST['url'] ?? '';
            $niveau = $_POST['niveau'] ?? '';
            $specialite = $_POST['specialite'] ?? [];

            $this->userModel->ajouterEntreprise($nomEntreprise, $nomContact, $nomResponsable, $rue, $codePostal, $ville, $telephone, $fax, $email, $observation, $url, $niveau, $specialite);

            // Redirigez vers la page d'index
            header('Location: ?page=entreprise&action=index');
        } else {
            echo $this->renderView('entreprise/ajouterEntreprise.twig');
        }
    }

    public function supprimerEntreprise($id)
    {
        $this->userModel->supprimerEntreprise($id);
        header('Location: ?page=entreprise&action=index');
    }

    public function voirEntreprise($id) {
        echo $this->renderView('entreprise/voirEntreprise.twig', ['entreprise' => $this->userModel->getEntrepriseById($id)]);
    }
}