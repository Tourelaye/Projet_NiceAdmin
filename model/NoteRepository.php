<?php
require_once("DBRepository.php");

class NoteRepository extends DBRepository
{
    // Ajouter une note en utilisant les colonnes : idEtudiant, note, idEvaluation
    public function addNote($idEtudiant, $note, $idEvaluation): ?int
    {
        $sql = "INSERT INTO notes (idEtudiant, note, idEvaluation) VALUES (:idEtudiant, :note, :idEvaluation)";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':idEtudiant', $idEtudiant, PDO::PARAM_INT);
        $statement->bindValue(':note', $note);
        $statement->bindValue(':idEvaluation', $idEvaluation, PDO::PARAM_INT);
        
        if ($statement->execute()) {
            return $this->db->lastInsertId();
        }
        return null;
    }

    // Récupérer toutes les notes actives en joignant la table des étudiants
    public function getAll(): array
    {
        $sql = "SELECT n.*, e.nom, e.prenom
                FROM notes n
                JOIN etudiants e ON n.idEtudiant = e.id";
        $statement = $this->db->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
