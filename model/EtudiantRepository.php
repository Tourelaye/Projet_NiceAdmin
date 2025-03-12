<?php

require_once("DBRepository.php");

class EtudiantRepository extends DBRepository
{
    // Ajouter un étudiant
    public function add($nom, $prenom, $email, $date_naissance)
    {
        $sql = "INSERT INTO etudiants (nom, prenom, email, date_naissance) 
                VALUES (:nom, :prenom, :email, :date_naissance)";
        
        try {
            $statement = $this->connexion->prepare($sql);
            $success = $statement->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'date_naissance' => $date_naissance
            ]);
            
            if ($success) {
                echo "Insertion réussie, ID: " . $this->connexion->lastInsertId();
                return $this->connexion->lastInsertId() ?: null;
            } else {
                echo "Échec de l'insertion.";
                return null;
            }
        } catch (PDOException $error) {
            error_log("Erreur lors de l'ajout de l'étudiant: " . $error->getMessage());
            echo "Erreur SQL : " . $error->getMessage();
            throw $error;
        }
    }

    // Récupérer tous les étudiants
    public function getAll()
    {
        $sql = "SELECT * FROM etudiants";
        
        try {
            $statement = $this->connexion->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de la récupération des étudiants: " . $error->getMessage());
            throw $error;
        }
    }

    // Récupérer un étudiant par ID
    public function getById($id)
    {
        $sql = "SELECT * FROM etudiants WHERE id = :id";
        
        try {
            $statement = $this->connexion->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de la récupération de l'étudiant avec ID $id: " . $error->getMessage());
            throw $error;
        }
    }

    // Modifier un étudiant
    public function edit($id, $nom, $prenom, $email, $date_naissance)
    {
        $sql = "UPDATE etudiants SET nom = :nom, prenom = :prenom, email = :email, date_naissance = :date_naissance WHERE id = :id";
        
        try {
            $statement = $this->connexion->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'date_naissance' => $date_naissance,
                'id' => $id
            ]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la modification de l'étudiant $id: " . $error->getMessage());
            throw $error;
        }
    }

    // Supprimer un étudiant
    public function delete($id)
    {
        $sql = "DELETE FROM etudiants WHERE id = :id";
        
        try {
            $statement = $this->connexion->prepare($sql);
            $statement->execute(['id' => $id]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la suppression de l'étudiant $id: " . $error->getMessage());
            throw $error;
        }
    }

    // Rechercher un étudiant par nom ou prénom
    public function search($keyword)
    {
        $sql = "SELECT * FROM etudiants WHERE nom LIKE :keyword OR prenom LIKE :keyword";
        
        try {
            $statement = $this->connexion->prepare($sql);
            $searchTerm = "%" . $keyword . "%";
            $statement->execute(['keyword' => $searchTerm]);
            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de la recherche des étudiants: " . $error->getMessage());
            throw $error;
        }
    }
}

?>
