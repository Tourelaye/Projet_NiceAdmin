<?php 
session_start();
require_once("model/EtudiantRepository.php");

class EtudiantController
{
    private $etudiantRepository;

    public function __construct()
    {
        $this->etudiantRepository = new EtudiantRepository();
    }

    // Permet de retourner un message d'erreur
    private function setErrorAndRedirect($message, $title, $redirectUrl = 'etudiant')
    {
        $_SESSION["error"] = $message;
        header("Location:$redirectUrl?error=1&message=" . urlencode($message) . "&title=" . urlencode($title));
        exit;
    }

    // Permet de retourner un message de succès
    private function setSuccessAndRedirect($message, $title, $redirectUrl = 'etudiant')
    {
        $_SESSION["success"] = $message;
        header("Location:$redirectUrl?success=1&message=" . urlencode($message) . "&title=" . urlencode($title));
        exit;
    }

    public function addEtudiant()
    {
        if ($_SERVER['REQUEST_METHOD']  == 'POST') {
            // Récupération des informations
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $date_naissance = trim($_POST['date_naissance'] ?? '');

            // Validation des données
            if (empty($nom) || empty($prenom) || empty($email) || empty($date_naissance)) {
                $this->setErrorAndRedirect("Tous les champs sont requis", "Erreur d'ajout");
            }

            try {
                $lastInsertId = $this->etudiantRepository->add($nom, $prenom, $email, $date_naissance);

                if ($lastInsertId) {
                    $this->setSuccessAndRedirect("Étudiant ajouté avec succès", "Ajout réussi");
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
