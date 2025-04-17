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
            // Récupération des informations du formulaire
            $etudiant_id = trim($_POST['etudiant_id'] ?? '');
            $note = trim($_POST['note'] ?? '');
            $evaluation_id = trim($_POST['evaluation_id'] ?? '');
            $created_by = $_SESSION['user_id'] ?? null;
    
            // Vérification des champs requis
            if (empty($etudiant_id) || empty($note) || empty($evaluation_id)) {
                $this->setErrorAndRedirect("Tous les champs sont requis", "Erreur d'ajout");
            }
    
            try {
                // Ajout de la note directement
                $lastInsertId = $this->noteRepository->addNote($etudiant_id, $note, $evaluation_id);
    
                if ($lastInsertId) {
                    $message = "Note ajoutée avec succès pour l'étudiant avec l'ID $etudiant_id et l'évaluation avec l'ID $evaluation_id.";
                    $this->setSuccessAndRedirect($message, "Ajout réussi");
                } else {
                    $this->setErrorAndRedirect("Une erreur est survenue lors de l'ajout de la note", "Erreur d'ajout");
                }
            } catch (Exception $th) {
                die("Erreur: " . $th->getMessage());
            }
        }
    }
    

    
}
?>
