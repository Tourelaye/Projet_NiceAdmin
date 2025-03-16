<?php
    require_once("DBRepository.php");

    class EvaluationRepository extends DBRepository
    {
        // Ajouter une evaluation
        public function register($etudiant_id,	$titre,	$description,	$date_limite, $created_by, $type_evaluation ): ?int
        {
                $sql = "INSERT INTO evaluations (etudiant_id, titre, description, date_limite, created_by, type_evaluation)
                VALUES (:etudiant_id, :titre, :description, :date_limite, :created_by, :type_evaluation)";

                try{
                    $statement = $this->db->prepare($sql);
                    $statement->execute([
                        'etudiant_id' => $etudiant_id,
                        'titre' => $titre,
                        'description' => $description,
                        'date_limite' => $date_limite,
                        'created_by' => $created_by,
                        'type_evaluation' => $type_evaluation
                    ]);

                    return $this->db->lastInsertId() ?: null;
                } catch (PDOException $error) {
                    error_log("Erreur lors de l'ajout de l'evaluation :" . $error->getMessage());
                    throw $error;
                }
        }

        // Recuperer toutes les evaluations actives
        public function getAll()
        {
            $sql = "SELECT e.*, et.nom, et,prenom
                    FROM evaluations e
                    JOIN etudiants et ON e.etudiant_id = et.id
                    WHERE e.deleted_at IS NULL
                    ORDER BY e.date_limite DESC";

            try{
                $statement = $this->db->prepare($sql);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
            }catch(PDOException $error){
                error_log("Erreur lors de la recupertion des evaluations:". $error->getMessage());
                throw $error;
            }
        } 

        // Recuperer les evaluations d'un etudiant specifique
        public  function getEvaluationsByEtudiant($etudiant_id)
        {
            $sql = "SELECT * FROM evaluations WHERE etudiant_id = :etudiant_id AND deleted_at IS NULL ORDER BY date_limite DESC";

            try{
                $statement = $this->db->prepare($sql);
                $statement->bindParam(':etudiant_id', $etudiant_id, PDO::PARAM_INT);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC) ?: [];
            }catch(PDOException $error){
                error_log("Erreur lors de la recuperation des evaluations pour l'etudiant ID $etudiant_id: ".$error->getMessage());
                throw $error; 
            }
        }

        // Modifier une evaluation
        public function update($id, $titre, $description, $date_limite, $updated_by, $type_evaluation): bool
        {
            $sql = "UPDATE evaluations
                    SET titre = :titre, description = :description, date_limite = :date_limite, 
                        updated_at = NOW(), updated_by = :updated_by, type_evaluation = :type_evaluation
                    WHERE id = :id AND deleted_at IS NULL";

            try{
                $statement = $this->db->prepare($sql);
                $statement->execute([
                    'id' => $id,
                    'titre' => $titre,
                    'description' => $description,
                    'date_limite' => $date_limite,
                    'updated_by' => $updated_by,
                    'type_evaluation' => $type_evaluation
                ]);

                return $statement->rowCount() > 0; 
            }   catch(PDOException $error){
                error_log("Erreur lors de la modification de l'evaluation ID $id:".$error->getMessage());
                return false;
            }     
        }

        // Supprimer une evaluation
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
            }   catch (PDOException $error){
                error_log("Erreur lors de la suppression de l'evaluation ID $id: ".$error->getMessage());
                throw $error;
            }     
        }

        // Restaurer une evaluation supprimee
        public function restore($id):bool
        {
            $sql = "UPDATE evaluations
                    SET deleted_at = NULL, deleted_by = NULL
                    WHERE id = :id AND deleted_at IS NOT NULL";
            try{
                $statement = $this->db->prepare($sql);
                $statement->execute(['id' => $id]);
                return $statement->rowCount() > 0; 
            }catch(PDOException $error){
                error_log("Erreur lors de la restauration de l'evaluation ID $id :".$error->getMessage());
                throw $error;
            }

        }
    }

?>