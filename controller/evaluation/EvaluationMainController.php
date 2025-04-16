<?php
require_once("EvaluationController.php");

$evaluationController = new EvaluationController();

if (isset($_POST["frmAddEvaluation"])) {
    $evaluationController->addEvaluation();
}
?>
