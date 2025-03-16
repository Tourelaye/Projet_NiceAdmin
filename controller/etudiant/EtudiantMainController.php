<?php
require_once("EtudiantController.php");

$etudiantController = new EtudiantController();

if (isset($_POST["frmAddEtudiant"])) {
    $etudiantController->addEtudiant();
}
?>
