<?php
require_once(__DIR__ . "/EtudiantEtudiant.php");

$etudiantController = new EtudiantController();

if (isset($_POST["frmAddEtudiant"])) {
    $etudiantController->addEtudiant();
}
?>
