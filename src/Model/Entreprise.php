<?php
namespace App\Model;
class Entreprise {
    private $pdo;
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllEntreprises() {
        $stmt = $this->pdo->query("SELECT e.*, GROUP_CONCAT(s.libelle) AS specialite FROM entreprise e LEFT JOIN spec_entreprise se ON e.num_entreprise=se.num_entreprise LEFT JOIN specialite s ON se.num_spec=s.num_spec GROUP BY e.num_entreprise ORDER BY raison_sociale");
        $result = $stmt->fetchAll();
        foreach ($result as &$ligne) {
            $ligne['specialite'] = explode(",", $ligne['specialite']);
        }
        return $result;
    }

    public function getEntreprisesByCriteria($nom, $ville, $specialite) {
        $stmt = $this->pdo->prepare("SELECT e.*, GROUP_CONCAT(s.libelle) AS specialite FROM entreprise e LEFT JOIN spec_entreprise se ON e.num_entreprise=se.num_entreprise LEFT JOIN specialite s ON se.num_spec=s.num_spec WHERE e.raison_sociale LIKE ? AND e.ville_entreprise LIKE ? GROUP BY e.num_entreprise HAVING (?='' OR FIND_IN_SET(?, GROUP_CONCAT(s.libelle))) ORDER BY raison_sociale");
        $stmt->execute(['%'.$nom.'%', '%'.$ville.'%', $specialite, $specialite]);
        $result = $stmt->fetchAll();
        foreach ($result as &$ligne) {
            $ligne['specialite'] = explode(",", $ligne['specialite']);
        }
        return $result;
    }

    public function getEntrepriseById($num_entreprise) {
        $stmt = $this->pdo->prepare("SELECT e.*, GROUP_CONCAT(s.libelle) AS specialite FROM entreprise e LEFT JOIN spec_entreprise se ON e.num_entreprise=se.num_entreprise LEFT JOIN specialite s ON se.num_spec=s.num_spec WHERE e.num_entreprise=? GROUP BY e.num_entreprise ORDER BY raison_sociale");
        $stmt->execute([$num_entreprise]);
        $result = $stmt->fetch();
        $result['specialite'] = explode(",", $result['specialite']);
        return $result;
    }
    public function ajouterEntreprise($nomEntreprise, $nomContact, $nomResponsable, $rue, $codePostal, $ville, $telephone, $fax, $email, $observation, $url, $niveau, $specialite)
    {
        $stmt = $this->pdo->prepare("INSERT INTO entreprise 
              (raison_sociale, nom_contact, nom_resp, rue_entreprise, cp_entreprise, ville_entreprise, tel_entreprise, fax_entreprise, email, observation, site_entreprise, niveau) 
              VALUES 
              (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nomEntreprise, $nomContact, $nomResponsable, $rue, $codePostal, $ville, $telephone, $fax, $email, $observation, $url, $niveau]);
        $num_entreprise = $this->pdo->lastInsertId();

        foreach ($specialite as $spe) {
            $stmt = $this->pdo->prepare("SELECT num_spec FROM specialite WHERE libelle = ?");
            $stmt->execute([$spe]);
            $num_spec = $stmt->fetch()['num_spec'];

            $stmt = $this->pdo->prepare("INSERT INTO spec_entreprise
                (num_entreprise, num_spec)
                VALUES 
                (?, ?)");
            $stmt->execute([$num_entreprise, $num_spec]);
        }
    }
    public function supprimerEntreprise($num_entreprise)
    {
        $stmt1 = $this->pdo->prepare("DELETE FROM spec_entreprise WHERE num_entreprise=?");
        $stmt1->execute([$num_entreprise]);
        $stmt2 = $this->pdo->prepare("DELETE FROM mission WHERE num_stage IN (SELECT num_stage FROM stage WHERE num_entreprise=?)");
        $stmt2->execute([$num_entreprise]);
        $stmt2 = $this->pdo->prepare("DELETE FROM stage WHERE num_entreprise=?");
        $stmt2->execute([$num_entreprise]);
        $stmt3 = $this->pdo->prepare("DELETE FROM entreprise WHERE num_entreprise=?");
        $stmt3->execute([$num_entreprise]);
    }

    public function modifierEntreprise($id, $nomEntreprise, $nomContact, $nomResponsable, $rue, $codePostal, $ville, $telephone, $fax, $email, $observation, $url, $niveau, $specialite)
    {
        $stmt = $this->pdo->prepare("UPDATE entreprise 
        SET 
            raison_sociale = ?, 
            nom_contact = ?, 
            nom_resp = ?, 
            rue_entreprise = ?, 
            cp_entreprise = ?, 
            ville_entreprise = ?, 
            tel_entreprise = ?, 
            fax_entreprise = ?, 
            email = ?, 
            observation = ?, 
            site_entreprise = ?, 
            niveau = ?
        WHERE num_entreprise = ?");

        $stmt->execute([$nomEntreprise, $nomContact, $nomResponsable, $rue, $codePostal, $ville, $telephone, $fax, $email, $observation, $url, $niveau, $id]);

        $stmt = $this->pdo->prepare("DELETE FROM spec_entreprise WHERE num_entreprise=?");
        $stmt->execute([$id]);

        foreach ($specialite as $spe) {
            $stmt = $this->pdo->prepare("SELECT num_spec FROM specialite WHERE libelle = ?");
            $stmt->execute([$spe]);
            $num_spec = $stmt->fetch()['num_spec'];

            $stmt = $this->pdo->prepare("INSERT INTO spec_entreprise
                (num_entreprise, num_spec)
                VALUES 
                (?, ?)");
            $stmt->execute([$id, $num_spec]);
        }
    }

    public function getStageByEntrepriseId($num_entreprise) {
        $stmt = $this->pdo->prepare("SELECT s.num_stage, e.num_etudiant, e.nom_etudiant, e.prenom_etudiant, s.desc_projet FROM stage s JOIN etudiant e ON s.num_etudiant = e.num_etudiant WHERE num_entreprise=?");
        $stmt->execute([$num_entreprise]);
        $result = $stmt->fetchAll();
        return $result;
    }
}