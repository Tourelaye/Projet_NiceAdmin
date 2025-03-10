<?php
require_once("DBRepository.php");

    class EtudiantRepository extends DBRepository
    {
    /**
     * Ajouter un étudiant
     */
    public function add($nom, $prenom, $email, $date_naissance)
    {
        $query = "INSERT INTO etudiants (nom, prenom, email, date_naissance) 
                  VALUES (:nom, :prenom, :email, :date_naissance)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':date_naissance', $date_naissance);
        
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    /**
     * Récupérer tous les étudiants
     */
    public function getAll()
    {
        $query = "SELECT * FROM etudiants ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupérer un étudiant par son ID
     */
    public function getById($id)
    {
        $query = "SELECT * FROM etudiants WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Mettre à jour un étudiant
     */
    public function update($id, $nom, $prenom, $email, $date_naissance)
    {
        $query = "UPDATE etudiants 
                  SET nom = :nom, prenom = :prenom, email = :email, date_naissance = :date_naissance 
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':date_naissance', $date_naissance);
        
        return $stmt->execute();
    }

    /**
     * Supprimer un étudiant
     */
    public function delete($id)
    {
        $query = "DELETE FROM etudiants WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    }
?>
