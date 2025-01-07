<?php
namespace App\Controller;

use App\Model\Connexion;

class ConnexionController extends BaseController{

    private $connexionModel;

    public function __construct($pdo)
    {
        $this->connexionModel = new Connexion($pdo);
    }

    public function index(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = $_POST['login'];
            $mdp = $_POST['mdp'];
            $role = $_POST['role'];

            if($this->connexionModel->checkUser($login, $mdp, $role)){
                session_start();
                $_SESSION['isLogged'] = true;
                $_SESSION['role'] = $role;
                header('Location: index.php?page=accueil');
                exit();
            } else {
                echo $this->renderView('connexion.twig', ['erreur' => 'login, mot de passe ou role incorrect']);
            }
        } else {
            echo $this->renderView('connexion.twig');
        }
    }

    public function deconnexion()
    {
        session_start();
        $_SESSION['isLogged'] = false;
        $_SESSION['role'] = null;
        header('Location: index.php?page=accueil');
        exit();
    }
}