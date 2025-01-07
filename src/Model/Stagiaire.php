<?php

namespace App\Model;
class Stagiaire
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllStagiaires()
    {
        $stmt = $this->pdo->query("SELECT s.num_stage, e.num_etudiant, e.nom_etudiant, e.prenom_etudiant, en.raison_sociale, p.nom_prof, p.prenom_prof  FROM stage s JOIN professeur p ON s.num_prof = p.num_prof JOIN entreprise en ON s.num_entreprise = en.num_entreprise RIGHT JOIN etudiant e ON s.num_etudiant = e.num_etudiant");
        return $stmt->fetchAll();
    }

    public function supprimerStage($id)
    {
        $stmt1 = $this->pdo->prepare("DELETE FROM mission WHERE num_stage = ?");
        $stmt1->execute([$id]);
        $stmt2 = $this->pdo->prepare("DELETE FROM stage WHERE num_stage = ?");
        $stmt2->execute([$id]);
    }

    public function getStagiaireById($id)
    {
        $stmt = $this->pdo->prepare("SELECT *, p.email AS emailP FROM stage s JOIN professeur p ON s.num_prof = p.num_prof JOIN entreprise en ON s.num_entreprise = en.num_entreprise RIGHT JOIN etudiant e ON s.num_etudiant = e.num_etudiant JOIN classe c ON e.num_classe=c.num_classe WHERE e.num_etudiant = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    public function getStagiairesByCriteria($nomEntreprise, $nomE, $prenomE, $nomP, $prenomP)
    {
        $stmt = $this->pdo->prepare("SELECT s.num_stage, e.num_etudiant, e.nom_etudiant, e.prenom_etudiant, en.raison_sociale, p.nom_prof, p.prenom_prof  FROM stage s JOIN professeur p ON s.num_prof = p.num_prof JOIN entreprise en ON s.num_entreprise = en.num_entreprise RIGHT JOIN etudiant e ON s.num_etudiant = e.num_etudiant WHERE en.raison_sociale LIKE ? AND e.nom_etudiant LIKE ? AND e.prenom_etudiant LIKE ? AND p.nom_prof LIKE ? AND p.prenom_prof LIKE ?");
        $stmt->execute(['%' . $nomEntreprise . '%', '%' . $nomE . '%', '%' . $prenomE . '%', '%' . $nomP . '%', '%' . $prenomP . '%']);
        return $stmt->fetchAll();
    }

    public function supprimerEtudiant($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM etudiant WHERE num_etudiant = ?");
        $stmt->execute([$id]);
    }

    public function ajouterEtudiant($nomEtudiant, $prenomEtudiant, $login, $mdp, $anneeObtention, $classe)
    {
        $stmt = $this->pdo->prepare("SELECT num_classe FROM classe WHERE nom_classe = ?");
        $stmt->execute([$classe]);
        $numClasse = $stmt->fetch()['num_classe'];

        $stmt = $this->pdo->prepare("INSERT INTO etudiant 
              (nom_etudiant, prenom_etudiant, login, mdp, annee_obtention, num_classe) 
              VALUES 
              (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nomEtudiant, $prenomEtudiant, $login, $mdp, $anneeObtention, $numClasse]);
    }

    public function modifierEtudiant($id, $nomEtudiant, $prenomEtudiant, $login, $mdp, $anneeObtention, $classe)
    {
        $stmt = $this->pdo->prepare("SELECT num_classe FROM classe WHERE nom_classe = ?");
        $stmt->execute([$classe]);
        $numClasse = $stmt->fetch()['num_classe'];

        $stmt = $this->pdo->prepare("UPDATE etudiant 
        SET 
            nom_etudiant = ?, 
            prenom_etudiant = ?, 
            login = ?, 
            mdp = ?, 
            annee_obtention = ?, 
            num_classe = ?
        WHERE num_etudiant = ?");

        $stmt->execute([$nomEtudiant, $prenomEtudiant, $login, $mdp, $anneeObtention, $numClasse, $id]);
    }

    public function getAllClasses()
    {
        $stmt = $this->pdo->query("SELECT nom_classe FROM classe");
        return $stmt->fetchAll();
    }

    public function getAllProfesseurs()
    {
        $stmt = $this->pdo->query("SELECT * FROM professeur");
        return $stmt->fetchAll();
    }

    public function getAllEtudiants()
    {
        $stmt = $this->pdo->query("SELECT * FROM etudiant");
        return $stmt->fetchAll();
    }

    public function ajouterStage($entreprise, $etudiant, $professeur, $dateDebut, $dateFin, $typeStage, $description, $observation)
    {
        $stmt = $this->pdo->prepare("INSERT INTO stage 
              (num_entreprise, num_etudiant, num_prof, debut_stage, fin_stage, type_stage, desc_projet, observation_stage) 
              VALUES 
              (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$entreprise, $etudiant, $professeur, $dateDebut, $dateFin, $typeStage, $description, $observation]);
    }

    public function modifierStage($id, $entreprise, $etudiant, $professeur, $dateDebut, $dateFin, $typeStage, $description, $observation)
    {
        $stmt = $this->pdo->prepare("UPDATE stage 
        SET num_entreprise = ?, num_etudiant = ?, num_prof = ?, debut_stage = ?, fin_stage = ?, type_stage = ?, desc_projet = ?, observation_stage = ? 
        WHERE num_stage = ?");
        $stmt->execute([$entreprise, $etudiant, $professeur, $dateDebut, $dateFin, $typeStage, $description, $observation, $id]);
    }
    public function getStageById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM stage WHERE num_stage = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}