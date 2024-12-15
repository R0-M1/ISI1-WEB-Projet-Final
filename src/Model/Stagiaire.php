<?php
namespace App\Model;
class Stagiaire {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllStagiaires() {
        $stmt = $this->pdo->query("SELECT s.num_stage, e.nom_etudiant, e.prenom_etudiant, en.raison_sociale, p.nom_prof, p.prenom_prof  FROM stage s JOIN professeur p ON s.num_prof = p.num_prof JOIN entreprise en ON s.num_entreprise = en.num_entreprise RIGHT JOIN etudiant e ON s.num_etudiant = e.num_etudiant");
        return $stmt->fetchAll();
    }

    public function supprimerStagiaire($id) {
        $stmt1 = $this->pdo->prepare("DELETE FROM mission WHERE num_stage = ?");
        $stmt1->execute([$id]);
        $stmt2 = $this->pdo->prepare("DELETE FROM stage WHERE num_stage = ?");
        $stmt2->execute([$id]);
    }
}