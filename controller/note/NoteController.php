<?php 
session_start();
require_once("../../model/NoteRepository.php");

class NoteController
{
    private $noteRepository;

    public function __construct()
    {
        $this->noteRepository = new NoteRepository();
    }

    // Gestion des erreurs
    private function setErrorAndRedirect($message, $title, $redirectUrl = 'admin')
    {
        $_SESSION["error"] = $message;
        header("Location:$redirectUrl?error=1&message=" . urlencode($message) . "&title=" . urlencode($title));
        exit;
    }

    // Gestion des succès
    private function setSuccessAndRedirect($message, $title, $redirectUrl = 'admin')
    {
        $_SESSION["success"] = $message;
        header("Location:$redirectUrl?success=1&message=" . urlencode($message) . "&title=" . urlencode($title));
        exit;
    }

    public function addNote()
    {
        if ($_SERVER['REQUEST_METHOD']  == 'POST') {
            // Récupération des informations
            $etudiant_id = trim($_POST['etudiant_id'] ?? '');
            $matiere = trim($_POST['matiere'] ?? '');
            $note = trim($_POST['note'] ?? '');
            $coefficient = trim($_POST['coefficient'] ?? '');
            $evaluation_id = trim($_POST['evaluation_id'] ?? '');
            $created_by = $_SESSION['user_id'] ?? null;

            // Vérification des champs
            if (empty($etudiant_id) || empty($matiere) || empty($note)) {
                $this->setErrorAndRedirect("Tous les champs sont requis", "Erreur d'ajout");
            }

            try {
                $lastInsertId = $this->noteRepository->addNote($etudiant_id, $matiere, $note, $coefficient, $created_by, $evaluation_id);

                if ($lastInsertId) {
                    $this->setSuccessAndRedirect("Note ajoutée avec succès", "Ajout réussi");
                } else {
                    $this->setErrorAndRedirect("Une erreur est survenue lors de l'ajout", "Erreur d'ajout");
                }
            } catch (Exception $th) {
                die("Erreur : " . $th->getMessage());
            }
        }
    }
}
?>
