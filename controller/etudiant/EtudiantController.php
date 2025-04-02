<?php 
session_start();
require_once("../../model/EtudiantRepository.php");

class EtudiantController
{
    private $etudiantRepository;

    public function __construct()
    {
        $this->etudiantRepository = new EtudiantRepository();
    }

    // Permet de retourner un message d'erreur
    private function setErrorAndRedirect($message, $title, $redirectUrl = 'admin.php')
    {
        $_SESSION["error"] = $message;
        header("Location: $redirectUrl?error=1&message=" . urlencode($message) . "&title=" . urlencode($title));
        exit;
    }

    // Permet de retourner un message de succès
    private function setSuccessAndRedirect($message, $title, $redirectUrl = 'admin.php')
    {
        $_SESSION["success"] = $message;
        header("Location: $redirectUrl?success=1&message=" . urlencode($message) . "&title=" . urlencode($title));
        exit;
    }

    public function addEtudiant()
    {
        if ($_SERVER['REQUEST_METHOD']  == 'POST') {
            // Récupération des informations
            $nom = trim($_POST['nom'] ?? '');
            $photo = trim($_POST['photo'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $adresse = trim($_POST['adresse'] ?? '');
            $matricule = trim($_POST['matricule'] ?? '');
            $telephone = trim($_POST['telephone'] ?? '');
            $etat = trim($_POST['etat'] ?? '');
            $created_at = date("Y-m-d H:i:s");
            $created_by = $_SESSION['user_id'] ?? null;

            // Validation des données
            if (empty($nom) || empty($email) || empty($password) || empty($adresse) || empty($matricule) || empty($telephone)) {
                $this->setErrorAndRedirect("Tous les champs obligatoires sont requis", "Erreur d'ajout");
            }

            try {
                $lastInsertId = $this->etudiantRepository->addEtudiant($nom, $photo, $email, $password, $adresse, $matricule, $telephone, $etat, $created_at, $created_by);

                if ($lastInsertId) {
                    $this->setSuccessAndRedirect("Étudiant ajouté avec succès", "Ajout réussi");
                } else {
                    $this->setErrorAndRedirect("Une erreur est survenue lors de l'ajout", "Erreur d'ajout");
                }
            } catch (Exception $e) {
                die("Erreur : " . $e->getMessage());
            }
        }
    }

    public function getAll(){
        return $this->etudiantRepository->getAll();
    }

    public function getEtudiantById($id)
    {
        try {
            $etudiant = $this->etudiantRepository->getEtudiantById($id);
            if ($etudiant) {
                echo json_encode($etudiant);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Étudiant non trouvé."]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => "Erreur serveur lors de la récupération de l'étudiant."]);
        }
    }
}

// Gestion des requêtes GET pour AJAX
if (isset($_GET['action'])) {
    $controller = new EtudiantController();
    if ($_GET['action'] === 'list') {
        echo json_encode($controller->getAll());
    }
} elseif (isset($_GET['id'])) {
    $controller = new EtudiantController();
    $controller->getEtudiantById($_GET['id']);
}
