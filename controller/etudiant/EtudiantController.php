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

    public function addEtudiant()
    {
        if ($_SERVER['REQUEST_METHOD']  == 'POST') {
            // Récupération des informations
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $date_naissance = trim($_POST['date_naissance'] ?? '');
            $date_inscription = trim($_POST['date_inscription'] ?? '');
            $adresse = trim($_POST['adresse'] ?? '');
            $nationalite = trim($_POST['nationalite'] ?? '');
            $matricule = trim($_POST['matricule'] ?? '');
            $sexe = trim($_POST['sexe'] ?? '');
            $created_by = $_SESSION['user_id'] ?? null;

            // Validation des données
            if (empty($nom) || empty($prenom) || empty($email) || empty($date_naissance) || empty($date_inscription) || empty($adresse) || empty($nationalite) || empty($matricule) || empty($sexe)) {
                $this->setErrorAndRedirect("Tous les champs sont requis", "Erreur d'ajout");
            }

            try {
                $lastInsertId = $this->etudiantRepository->addEtudiant($nom, $prenom, $email, $date_naissance, $date_inscription, $adresse, $nationalite, $matricule, $sexe, $created_by);

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
    

    // Gestion des requêtes GET pour AJAX
    if (isset($_GET['action']) && $_GET['action'] === 'list') {
        $controller = new EtudiantController();
        echo json_encode($controller->getAll());
    } elseif (isset($_GET['id'])) {
        $controller = new EtudiantController();
        $controller->getEtudiantById($_GET['id']);
        }

    }
}
?>
