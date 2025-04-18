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

    private function setErrorAndRedirect($message, $title, $redirectUrl = 'admin.php')
    {
        $_SESSION["error"] = $message;
        header("Location: $redirectUrl?error=1&message=" . urlencode($message) . "&title=" . urlencode($title));
        exit;
    }

    private function setSuccessAndRedirect($message, $title, $redirectUrl = 'admin.php')
    {
        $_SESSION["success"] = $message;
        header("Location: $redirectUrl?success=1&message=" . urlencode($message) . "&title=" . urlencode($title));
        exit;
    }

    public function addEtudiant()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $adresse = trim($_POST['adresse'] ?? '');
            $matricule = trim($_POST['matricule'] ?? '');
            $telephone = trim($_POST['telephone'] ?? '');
            $etat = trim($_POST['etat'] ?? '');
            $created_at = date("Y-m-d H:i:s");
            $created_by = $_SESSION['user_id'] ?? null;
            $deleted_by = $_SESSION['user_id'] ?? null;

            // Gérer la photo (upload)
            $photoPath = "";
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['photo']['tmp_name'];
                $name = basename($_FILES['photo']['name']);
                $uploadDir = '../../uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $photoPath = $uploadDir . uniqid() . "_" . $name;
                move_uploaded_file($tmpName, $photoPath);
            }

            if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($adresse) || empty($matricule) || empty($telephone)) {
                $this->setErrorAndRedirect("Tous les champs obligatoires sont requis", "Erreur d'ajout");
            }

            try {
                $lastInsertId = $this->etudiantRepository->addEtudiant($nom, $prenom, $photoPath, $email, $password, $adresse, $matricule, $telephone, $etat, $created_at, $created_by);

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

    public function deleteEtudiant($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = trim($_POST['id'] ?? '');
            
            if (empty($id)) {
                $this->setErrorAndRedirect("ID requis pour supprimer", "Erreur de suppression");
            }

            try {
                $result = $this->etudiantRepository->desactivate($id);
                
                if ($result) {
                    $this->setSuccessAndRedirect("Étudiant supprimé avec succès", "Suppression réussie");
                } else {
                    $this->setErrorAndRedirect("Erreur lors de la suppression", "Erreur de suppression");
                }
            } catch (Exception $e) {
                $this->setErrorAndRedirect("Erreur interne : " . $e->getMessage(), "Erreur de suppression");
            }
        }
    }
    
    
    

    public function getAll()
    {
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

// -----------------------------
// GESTION DES REQUÊTES HTTP
// -----------------------------
$controller = new EtudiantController();

// Traitement suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['frmDeleteEtudiant'])) {
    $id = $_POST['id'] ?? null;
    if ($controller->deleteEtudiant($id)) {
        $_SESSION['success'] = "Étudiant supprimé avec succès.";
        header("Location: admin.php");
        exit;
    } else {
        $_SESSION['error'] = "Échec de la suppression de l'étudiant.";
        header("Location: admin.php");
        exit;
    }
}

// Pour AJAX (recherche/listing/etc.)
if (isset($_GET['action']) && $_GET['action'] === 'list') {
    echo json_encode($controller->getAll());
} elseif (isset($_GET['id'])) {
    $controller->getEtudiantById($_GET['id']);
}
