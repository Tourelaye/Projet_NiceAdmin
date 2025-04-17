<?php
require_once("EtudiantController.php");

$etudiantController = new EtudiantController();

if (isset($_POST["frmAddEtudiant"])) {
    $etudiantController->addEtudiant();
}

if (isset($_POST['frmDeleteEtudiant'])){
    $id = $_POST['id'];
    var_dump($id); // Ajoute cette ligne pour tester
    die();
    // Appel a une methode de suppression dans ton modele
    $resultat = $etudiantController->deleteEtudiant($id);

    if($resultat){
        // Redirection ou message de succes
        header("Location: ListeEtudiants.php?success=1");
    }else{
        // Message d'erreur
        header("Location: ListeEtudiants.php?error=1");
    }
}
?>
