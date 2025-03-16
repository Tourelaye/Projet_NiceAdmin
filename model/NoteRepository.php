<?php
require_once("DBRepository.php");

class NoteRepository
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Ajouter une note
    public function addNote($etudiant_id, $matiere, $note, $created_by)
    {
        $sql = "INSERT INTO notes (etudiant_id, matiere, note, created_by) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isdi", $etudiant_id, $matiere, $note, $created_by);
        return $stmt->execute();
    }

    // Récupérer toutes les notes
    public function getAll()
    {
        $sql = "SELECT n.id, e.nom, e.prenom, n.matiere, n.note 
                FROM notes n
                JOIN etudiants e ON n.etudiant_id = e.id";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
