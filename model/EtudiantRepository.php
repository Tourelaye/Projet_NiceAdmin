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
        $sql = "SELECT id, nom, prenom, photo, email, password, adresse, matricule, telephone, etat FROM etudiants WHERE id = :id";
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
    public function addEtudiant($nom,$prenom, $photo, $email, $password, $adresse, $matricule, $telephone, $etat, $created_at, $created_by)
    {
        $sql = "INSERT INTO etudiants (nom,prenom, photo, email, password, adresse, matricule, telephone, etat, created_at, created_by) 
                VALUES (:nom,:prenom, :photo, :email, :password, :adresse, :matricule, :telephone, :etat, :created_at, :created_by)";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'photo' => $photo,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'adresse' => $adresse,
                'matricule' => $matricule,
                'telephone' => $telephone,
                'etat' => $etat,
                'created_at' => $created_at,
                'created_by' => $created_by    
            ]);

            return $this->db->lastInsertId() ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de l'ajout de l'étudiant $nom : " . $error->getMessage());
            throw $error;
        }
    }

    // Modifier un étudiant
    public function edit($id, $nom, $photo, $email, $password, $adresse, $matricule, $telephone, $etat, $updated_by)
    {
        $sql = "UPDATE etudiants 
                SET nom = :nom, photo = :photo, email = :email, password = :password, 
                    adresse = :adresse, matricule = :matricule, telephone = :telephone, etat = :etat,
                    updated_at = NOW(), updated_by = :updated_by
                WHERE id = :id AND deleted_at IS NULL";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'nom' => $nom,
                'photo' => $photo,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'adresse' => $adresse,
                'matricule' => $matricule,
                'telephone' => $telephone,
                'etat' => $etat,
                'updated_by' => $updated_by,
                'id' => $id
            ]);

            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la modification de l'étudiant $id ($nom) : " . $error->getMessage());
            return false;
        }
    }

    // Supprimer un étudiant (marquage logique)
    public function deleteEtudiant(int $id, int $deleted_by)
    {
        $sql = "UPDATE etudiants 
                SET etat = 0, deleted_by = :deleted_by
                WHERE id = :id AND etat = 1";
    
        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'deleted_by' => $deleted_by,
                'id' => $id
            ]);
    
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la désactivation de l'étudiant ID $id : " . $error->getMessage());
            return false;
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
            //Desactivate un étudiant
    public function desactivate($id)
    {
        $sql = "UPDATE etudiant SET etat = 0 WHERE id = :id";
                
                
        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['id' => $id]);
            $rowAffected = $statement->rowCount();
            return $rowAffected > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la désactivation de l'etudiant d'id $id " . $error->getMessage());
            throw $error;
        }
    }
}
?>
