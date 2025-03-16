<?php 
session_start();
require_once("../../model/NoteRepository.php");

class NoteMainController
{
    private $noteRepository;

    public function __construct()
    {
        $this->noteRepository = new NoteRepository();
    }

    public function getAllNotes(){
        return $this->noteRepository->getAll();
    }
}
?>
