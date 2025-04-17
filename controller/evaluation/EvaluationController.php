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
            $nom = trim($_POST['nom'] ?? ''); // Nouveau champ nom
            $semestre = trim($_POST['semestre'] ?? ''); // Nouveau champ semestre
            $type_evaluation = trim($_POST['type_evaluation'] ?? '');
            $created_by = $_SESSION['id'] ?? null;
    
            // Validation des données
            if (empty($etudiant_id) || empty($nom) || empty($semestre) || empty($type_evaluation) ) {
                $this->setErrorAndRedirect("Tous les champs sont requis", "Erreur d'ajout");
            }
    
            try {
                // Ajout de l'évaluation en base de données
                $lastInsertId = $this->evaluationRepository->add(
                    $etudiant_id, 
                    $nom, // Nouveau champ nom
                    $semestre, // Nouveau champ semestre
                    $type_evaluation, 
                    $created_by
                );
    
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

    public function getAllEvaluations()
    {
        $repo = new EvaluationRepository();
        return $repo->getAll();
    }

    public function getAll()
    {
        return $this->evaluationRepository->getAll();
    }
}
?>
