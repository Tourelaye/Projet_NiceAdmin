<?php
    require_once("DBRepository.php");

    class EvaluationRepository extends DBRepository
    {
        public function register($etudiant_id,	$titre,	$description,	$date_limite, ): void
        {
                $sql = "INSERT INTO evaluations ()"
        }
    }

?>