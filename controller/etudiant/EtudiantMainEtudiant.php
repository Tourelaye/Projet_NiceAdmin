<?php
require_once("EtudiantEtudiant.php");

$etudiantController = new EtudiantController();

if (isset($_POST["frmAddEtudiant"])) {
    $etudiantController->addEtudiant();
}
?>
