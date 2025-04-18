<?php
require_once("EtudiantController.php");

$etudiantController = new EtudiantController();

if (isset($_POST["frmAddEtudiant"])) {
    $etudiantController->addEtudiant();
}

if (isset($_POST["deleteEtudiant"])) {
    $id = $_POST["etudiant_id"];
    $etudiantController->deleteEtudiant($id);
}


?>
