<?php
require_once("DBRepository.php");

class EtudiantRepository extends DBRepository
{
    // Récupérer tous les étudiants (actifs uniquement)
    public function getAll()
    {
        $sql = "SELECT * FROM etudiants WHERE deleted_at IS NULL";
        try {
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $error) {
            error_log("Erreur lors de la récupération des étudiants : " . $error->getMessage());
            throw $error;
        }
    }

   

    // Récupérer un étudiant par ID
    public function getEtudiantById(int $id)
    {
        $sql = "SELECT id, nom, prenom FROM etudiants WHERE id = :id";
        try {
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de la récupération de l'étudiant ID $id : " . $error->getMessage());
            throw $error;
        }
    }

    // Ajouter un étudiant
    public function addEtudiant($nom, $prenom, $email, $date_naissance, $date_inscription, $adresse, $nationalite, $matricule, $sexe, $created_by)
    {
        $sql = "INSERT INTO etudiants (nom, prenom, email, date_naissance, date_inscription, adresse, nationalite, matricule, sexe, created_at, created_by) 
                VALUES (:nom, :prenom, :email, :date_naissance, :date_inscription, :adresse, :nationalite, :matricule, :sexe, NOW(), :created_by)";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'date_naissance' => $date_naissance,
                'date_inscription' => $date_inscription,
                'adresse' => $adresse,
                'nationalite' => $nationalite,
                'matricule' => $matricule,
                'sexe' => $sexe,
                'created_by' => $created_by    
            ]);

            return $this->db->lastInsertId() ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de l'ajout de l'étudiant $nom $prenom : " . $error->getMessage());
            throw $error;
        }
    }

    // Modifier un étudiant
    public function edit($id, $nom, $prenom, $email, $date_naissance, $date_inscription, $adresse, $nationalite, $matricule, $sexe, $updated_by)
    {
        $sql = "UPDATE etudiants 
                SET nom = :nom, prenom = :prenom, email = :email, 
                    date_naissance = :date_naissance, date_inscription = :date_inscription,
                    adresse = :adresse, nationalite = :nationalite, sexe = :sexe, matricule = :matricule,
                    updated_at = NOW(), updated_by = :updated_by
                WHERE id = :id AND deleted_at IS NULL";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'date_naissance' => $date_naissance,
                'date_inscription' => $date_inscription,
                'adresse' => $adresse,
                'nationalite' => $nationalite, 
                'matricule' => $matricule,
                'sexe' => $sexe,
                'updated_by' => $updated_by,
                'id' => $id
            ]);

            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la modification de l'étudiant $id ($nom $prenom) : " . $error->getMessage());
            return false;
        }
    }

    // Supprimer un étudiant (marquage logique)
    public function delete(int $id, int $deleted_by)
    {
        $sql = "UPDATE etudiants 
                SET deleted_at = NOW(), deleted_by = :deleted_by
                WHERE id = :id AND deleted_at IS NULL";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'deleted_by' => $deleted_by,
                'id' => $id
            ]);

            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la suppression de l'étudiant ID $id : " . $error->getMessage());
            throw $error;
        }
    }

    // Restaurer un étudiant supprimé
    public function restore(int $id)
    {
        $sql = "UPDATE etudiants 
                SET deleted_at = NULL, deleted_by = NULL
                WHERE id = :id AND deleted_at IS NOT NULL";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['id' => $id]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la restauration de l'étudiant ID $id : " . $error->getMessage());
            throw $error;
        }
    }
}
?>
