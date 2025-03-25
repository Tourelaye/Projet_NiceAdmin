<?php
require_once("NoteController.php");

$noteController = new NoteController();

if (isset($_POST["frmAddNote"])) {
    $noteController->addNote();
}
?>
