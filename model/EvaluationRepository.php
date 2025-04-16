<?php
    require_once("DBRepository.php");

    class EvaluationRepository extends DBRepository
    {
        // Ajouter une évaluation
        public function add($etudiant_id, $nom, $semestre, $type_evaluation, $created_by)
        {
            $sql = "INSERT INTO evaluations (etudiant_id, nom, semestre, type_evaluation, created_by)
                    VALUES (:etudiant_id, :nom, :semestre, :type_evaluation, :created_by)";

            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'etudiant_id' => $etudiant_id,
                    'nom' => $nom,
                    'semestre' => $semestre,
                    'type_evaluation' => $type_evaluation,
                    'created_by' => $created_by
                ]);

                return $this->db->lastInsertId() ?: null;
            } catch (PDOException $error) {
                error_log("Erreur lors de l'ajout de l'évaluation :" . $error->getMessage());
                throw $error;
            }
        }

        // Récupérer toutes les évaluations actives
        public function getAll()
        {
            $sql = "SELECT e.*, et.nom as etudiant_nom, et.prenom
                    FROM evaluations e
                    JOIN etudiants et ON e.etudiant_id = et.id
                    WHERE e.deleted_at IS NULL
                    ORDER BY e.created_at DESC";

            try {
                $statement = $this->db->prepare($sql);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
            } catch (PDOException $error) {
                error_log("Erreur lors de la récupération des évaluations:" . $error->getMessage());
                throw $error;
            }
        }

        // Récupérer les évaluations d'un étudiant spécifique
        public function getEvaluationsByEtudiant($etudiant_id)
        {
            $sql = "SELECT * FROM evaluations WHERE etudiant_id = :etudiant_id AND deleted_at IS NULL ORDER BY created_at DESC";

            try {
                $statement = $this->db->prepare($sql);
                $statement->bindParam(':etudiant_id', $etudiant_id, PDO::PARAM_INT);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
            } catch (PDOException $error) {
                error_log("Erreur lors de la récupération des évaluations pour l'étudiant ID $etudiant_id: " . $error->getMessage());
                throw $error;
            }
        }

        // Modifier une évaluation
        public function update($id, $nom, $semestre, $type_evaluation, $updated_by): bool
        {
            $sql = "UPDATE evaluations
                    SET nom = :nom, semestre = :semestre, 
                        type_evaluation = :type_evaluation, updated_at = NOW(), updated_by = :updated_by
                    WHERE id = :id AND deleted_at IS NULL";

            try {
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'id' => $id,
                    'nom' => $nom,
                    'semestre' => $semestre,
                    'type_evaluation' => $type_evaluation,
                    'updated_by' => $updated_by
                ]);

                return $statement->rowCount() > 0;
            } catch (PDOException $error) {
                error_log("Erreur lors de la modification de l'évaluation ID $id:" . $error->getMessage());
                return false;
            }
        }

        // Supprimer une évaluation
        public function delete($id, $deleted_by): bool
        {
            $sql = "UPDATE evaluations
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
                error_log("Erreur lors de la suppression de l'évaluation ID $id: " . $error->getMessage());
                throw $error;
            }
        }

        // Restaurer une évaluation supprimée
        public function restore($id): bool
        {
            $sql = "UPDATE evaluations
                    SET deleted_at = NULL, deleted_by = NULL
                    WHERE id = :id AND deleted_at IS NOT NULL";
            try {
                $statement = $this->db->prepare($sql);
                $statement->execute(['id' => $id]);
                return $statement->rowCount() > 0;
            } catch (PDOException $error) {
                error_log("Erreur lors de la restauration de l'évaluation ID $id :" . $error->getMessage());
                throw $error;
            }
        }
    }
?>
