<?php

namespace App\Model;

class Connexion
{
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function checkUser($login, $mdp, $role): bool
    {
        if($role == 'etudiant') {
            $stmt = $this->pdo->prepare("SELECT num_etudiant FROM etudiant WHERE login = ? AND mdp = ?");
            $stmt->execute([$login, $mdp]);
        } else if($role == 'professeur') {
            $stmt = $this->pdo->prepare("SELECT num_prof FROM professeur WHERE login = ? AND mdp = ?");
            $stmt->execute([$login, $mdp]);
        }
        return !empty($stmt->fetchAll());
    }
}