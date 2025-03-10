<?php
require_once("EtudiantEtudiant.php");

// Objet
$etudiantController = new EtudiantController();

// Vérifier si le formulaire d'ajout d'étudiant est soumis
if (isset($_POST["frmAddEtudiant"])) {
    $etudiantController->addEtudiant();
}
?>
