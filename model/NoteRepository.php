<?php
require_once("DBRepository.php");

class NoteRepository extends DBRepository
{
    // Ajouter une note en utilisant les colonnes : idEtudiant, note, idEvaluation
    public function addNote($idEtudiant, $note, $idEvaluation): ?int
    {
        // Log des valeurs reçues
        error_log("Ajout de la note: Étudiant ID = $idEtudiant, Note = $note, Evaluation ID = $idEvaluation");
    
        $sql = "INSERT INTO notes (idEtudiant, note, idEvaluation) VALUES (:idEtudiant, :note, :idEvaluation)";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
        $statement->bindValue(':note', $note);
        $statement->bindValue(':idEvaluation', $idEvaluation, PDO::PARAM_INT);
    
        if ($statement->execute()) {
            // Log du dernier ID inséré
            error_log("Note insérée avec succès, ID de la note : " . $this->db->lastInsertId());
            return $this->db->lastInsertId();
        }
    
        error_log("Erreur lors de l'exécution de la requête.");
        return null;
    }

    // Récupérer toutes les notes actives en joignant la table des étudiants
    public function getAll(): array
    {
        $sql = "SELECT n.id, n.note, n.idEtudiant, n.idEvaluation,
                       e.nom AS etudiant_nom, e.prenom AS etudiant_prenom,
                       ev.nom AS evaluation_nom
                FROM notes n
                JOIN etudiants e ON n.idEtudiant = e.id
                JOIN evaluations ev ON n.idEvaluation = ev.id";
                
        $statement = $this->db->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getEtudiantAndEvaluation($etudiant_id, $evaluation_id){
        $sql = "SELECT n.id, et.nom AS etudiant_nom, et.prenom AS etudiant_prenom, ev.nom AS evaluation_nom, n.note 
                FROM notes n
                JOIN etudiants et ON n.idEtudiant = et.id
                JOIN evaluations ev ON n.idEvaluation = ev.id
                WHERE n.idEtudiant = :etudiant_id AND n.idEvaluation = :evaluation_id";

        try {
            $statement = $this->db->prepare($sql);
            $statement->bindParam(':etudiant_id', $etudiant_id, PDO::PARAM_INT);
            $statement->bindParam(':evaluation_id', $evaluation_id, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);    
        }   catch(PDOException $error)     {
            error_log("Erreur lors de la recuperation des donnees:".$error->getMessage());
            throw $error;
        }
    }
}
?>
