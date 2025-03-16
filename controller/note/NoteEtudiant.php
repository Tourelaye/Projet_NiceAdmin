<?php
    require_once("../../model/NoteRepository.php");
    class NoteEtudiant {
        private $noteRepository;

        public function __construct()
        {
            $this->noteRepository = new NoteRepository();    
        }
    }
?>