<?php
require_once("EvaluationController.php");

$evaluationController = new EvaluationController();

//Ajout d'une evaluation
if (isset($_POST["frmAddEvaluation"])) {
    $evaluationController->addEvaluation();
}

//Affichage de toutes les evaluations
$evaluations = $evaluationController->getAllEvaluations();
include_once("view/pages/admin/evaluation/liste.php");

?>
