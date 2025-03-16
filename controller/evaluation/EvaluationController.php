<?php 
session_start();
require_once("../../model/EvaluationRepository.php");

class EvaluationController
{
    private $evaluationRepository;

    public function __construct()
    {
        $this->evaluationRepository = new EvaluationRepository();
    }

    // Permet de retourner un message d'erreur
    private function setErrorAndRedirect($message, $title, $redirectUrl = 'admin')
    {
        $_SESSION["error"] = $message;
        header("Location:$redirectUrl?error=1&message=" . urlencode($message) . "&title=" . urlencode($title));
        exit;
    }

    // Permet de retourner un message de succès
    private function setSuccessAndRedirect($message, $title, $redirectUrl = 'admin')
    {
        $_SESSION["success"] = $message;
        header("Location:$redirectUrl?success=1&message=" . urlencode($message) . "&title=" . urlencode($title));
        exit;
    }

    public function addEvaluation()
    {
        if ($_SERVER['REQUEST_METHOD']  == 'POST') {
            // Récupération des informations du formulaire
            $etudiant_id = trim($_POST['etudiant_id'] ?? '');
            $titre = trim($_POST['titre'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $type_evaluation = trim($_POST['type_evaluation'] ?? '');
            $date_limite = trim($_POST['date_limite'] ?? '');
            $created_by = $_SESSION['user_id'] ?? null;
    
            // Validation des données
            if (empty($etudiant_id) || empty($titre) || empty($description) || empty($type_evaluation) || empty($date_limite)) {
                $this->setErrorAndRedirect("Tous les champs sont requis", "Erreur d'ajout");
            }
    
            try {
                // Ajout de l'évaluation en base de données
                $lastInsertId = $this->evaluationRepository->addEvaluation($etudiant_id, $titre, $description, $type_evaluation, $date_limite, $created_by);
    
                if ($lastInsertId) {
                    $this->setSuccessAndRedirect("Évaluation ajoutée avec succès", "Ajout réussi");
                } else {
                    $this->setErrorAndRedirect("Une erreur est survenue lors de l'ajout", "Erreur d'ajout");
                }
            } catch (Exception $th) {
                die("Erreur : " . $th->getMessage());
            }
        }
    }
    


    public function getAll(){
        return $this->evaluationRepository->getAll();
    }
}
?>
