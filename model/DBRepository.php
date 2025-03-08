<?php
class DBRepository
{
    private $host;
    private $dbname;
    private $user;
    private $password;
    protected $db;

    public function __construct()
    {
        $this->host = getenv("DB_HOST") ?: "localhost";
        $this->dbname = getenv("DB_NAME") ?: "gestion_etudiants";
        $this->user = getenv("DB_USER") ?: "root";
        $this->password = getenv("DB_PASSWORD") ?: "";
        $this->getConnexion();
    }

    private function getConnexion()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";

        try {
            $this->db = new PDO($dsn, $this->user, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            error_log("Erreur de connexion à la base de données : " . $error->getMessage());
            throw $error;
        }
    }

    // ==================== ÉTUDIANTS ====================
    public function ajouterEtudiant($nom, $prenom, $email, $date_naissance)
    {
        $sql = "INSERT INTO etudiants (nom, prenom, email, date_naissance) VALUES (:nom, :prenom, :email, :date_naissance)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(compact('nom', 'prenom', 'email', 'date_naissance'));
    }

    public function getEtudiants()
    {
        $sql = "SELECT * FROM etudiants ORDER BY date_inscription DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function supprimerEtudiant($id)
    {
        $sql = "DELETE FROM etudiants WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(compact('id'));
    }

    // ==================== NOTES ====================
    public function ajouterNote($etudiant_id, $matiere, $note)
    {
        $sql = "INSERT INTO notes (etudiant_id, matiere, note) VALUES (:etudiant_id, :matiere, :note)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(compact('etudiant_id', 'matiere', 'note'));
    }

    public function getNotesEtudiant($etudiant_id)
    {
        $sql = "SELECT * FROM notes WHERE etudiant_id = :etudiant_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(compact('etudiant_id'));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function supprimerNote($id)
    {
        $sql = "DELETE FROM notes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(compact('id'));
    }

    // ==================== ÉVALUATIONS (DEVOIRS) ====================
    public function ajouterEvaluation($etudiant_id, $titre, $description, $date_limite)
    {
        $sql = "INSERT INTO evaluations (etudiant_id, titre, description, date_limite) VALUES (:etudiant_id, :titre, :description, :date_limite)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(compact('etudiant_id', 'titre', 'description', 'date_limite'));
    }

    public function getEvaluationsEtudiant($etudiant_id)
    {
        $sql = "SELECT * FROM evaluations WHERE etudiant_id = :etudiant_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(compact('etudiant_id'));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function supprimerEvaluation($id)
    {
        $sql = "DELETE FROM evaluations WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(compact('id'));
    }
}
?>
