<?php
require_once("DBRepository.php");

class NoteRepository extends DBRepository
{
    // Ajouter une note
    public function addNote($etudiant_id, $matiere, $note, $coefficient, $created_by, $evaluation_id): ?int
    {
        $sql = "INSERT INTO notes (etudiant_id, matiere, note, coefficient, created_at, created_by, evaluation_id)
                VALUES (:etudiant_id, :matiere, :note, :coefficient, NOW(), :created_by, :evaluation_id)";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'etudiant_id' => $etudiant_id,
                'matiere' => $matiere,
                'note' => $note,
                'coefficient' => $coefficient,
                'created_by' => $created_by,
                'evaluation_id' => $evaluation_id
            ]);

            return $this->db->lastInsertId() ?: null;
        } catch (PDOException $error) {
            error_log("Erreur lors de l'ajout de la note :" . $error->getMessage());
            throw $error;
        }
    }

    // Récupérer toutes les notes actives
    public function getAll()
    {
        $sql = "SELECT n.*, e.nom, e.prenom
                FROM notes n
                JOIN etudiants e ON n.etudiant_id = e.id
                WHERE n.deleted_at IS NULL
                ORDER BY n.created_at DESC";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $error) {
            error_log("Erreur lors de la récupération des notes :" . $error->getMessage());
            throw $error;
        }
    }

    // Récupérer les notes d'un étudiant spécifique
    public function getNotesByEtudiant($etudiant_id)
    {
        $sql = "SELECT * FROM notes WHERE etudiant_id = :etudiant_id AND deleted_at IS NULL ORDER BY created_at DESC";

        try {
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':etudiant_id', $etudiant_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $error) {
            error_log("Erreur lors de la récupération des notes pour l'étudiant ID $etudiant_id: " . $error->getMessage());
            throw $error;
        }
    }

    // Modifier une note
    public function update($id, $note, $coefficient, $updated_by): bool
    {
        $sql = "UPDATE notes
                SET note = :note, coefficient = :coefficient, updated_at = NOW(), updated_by = :updated_by
                WHERE id = :id AND deleted_at IS NULL";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'id' => $id,
                'note' => $note,
                'coefficient' => $coefficient,
                'updated_by' => $updated_by
            ]);

            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la modification de la note ID $id: " . $error->getMessage());
            return false;
        }
    }

    // Supprimer une note (soft delete)
    public function delete($id, $deleted_by): bool
    {
        $sql = "UPDATE notes
                SET deleted_at = NOW(), deleted_by = :deleted_by
                WHERE id = :id AND deleted_at IS NULL";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute([
                'id' => $id,
                'deleted_by' => $deleted_by
            ]);

            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la suppression de la note ID $id: " . $error->getMessage());
            throw $error;
        }
    }

    // Restaurer une note supprimée
    public function restore($id): bool
    {
        $sql = "UPDATE notes
                SET deleted_at = NULL, deleted_by = NULL
                WHERE id = :id AND deleted_at IS NOT NULL";

        try {
            $statement = $this->db->prepare($sql);
            $statement->execute(['id' => $id]);
            return $statement->rowCount() > 0;
        } catch (PDOException $error) {
            error_log("Erreur lors de la restauration de la note ID $id: " . $error->getMessage());
            throw $error;
        }
    }
}
?>
