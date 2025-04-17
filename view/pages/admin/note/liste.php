<?php 
  require_once("../../../../model/NoteRepository.php");
  require_once("../../../../model/EtudiantRepository.php");
  require_once("../../../../model/EvaluationRepository.php");

  $noteRepository = new NoteRepository();
  $etudiantRepository = new EtudiantRepository();
  $evaluationRepository = new EvaluationRepository();

  $notes = $noteRepository->getAll();
  $etudiants = $etudiantRepository->getAll();
  $evaluations = $evaluationRepository->getAll();
?>

<!DOCTYPE html>
<html lang="fr">

<!-- ==================== Section Header ==================== -->
<?php require_once("../../../sections/admin/header.php")?>

<body>
  <!-- ==================== Section Menu Haut ==================== -->
  <?php require_once("../../../sections/admin/menuHaut.php")?>  

  <!-- ==================== Section Menu gauche ==================== -->
  <?php require_once("../../../sections/admin/menuGauche.php")?>  

  <!-- ==================== Section Contenu ==================== -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Gestion des Notes</h1>
    </div>

    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Notes des Étudiants</h5>

          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addNoteModal">
            Ajouter une note
          </button>

          <input type="text" id="searchNote" class="form-control mb-3" placeholder="Rechercher par étudiant...">

          <table class="table table-bordered">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Étudiant</th>
                <th>Évaluation</th>
                <th>Note</th>
              </tr>
            </thead>
            <tbody>
              <!-- Les notes seront affichées ici dynamiquement -->
              <?php if (!empty($notes)):?>
                <?php foreach ($notes as $note): ?>
                  <tr>
                    <td><?= htmlspecialchars($note['id'])?></td>
                    <td><?= htmlspecialchars($note['etudiant_nom']) . ' ' . htmlspecialchars($note['etudiant_prenom'])?></td>
                    <td><?= htmlspecialchars($note['evaluation_nom'])?></td>
                    <td><?= htmlspecialchars($note['note'])?></td>
                  </tr>
                <?php endforeach?>
              <?php else: ?>
                <tr>
                  <td colspan='4' class='text-center'>Aucun note enregistree</td>
                </tr> 
              <?php endif; ?>     
            </tbody>
          </table>

        </div>
      </div>
    </section>
    <?php
    // Log pour vérifier la récupération des notes
    error_log("Notes récupérées : " . print_r($notes, true));
    ?>            
    <!-- MODAL AJOUT NOTE -->
    <div class="modal fade" id="addNoteModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter une note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="NoteController">
              <input type="hidden" id="note_id">

              <!-- Sélection de l'étudiant -->
              <div class="mb-3">
                <label for="etudiant_id" class="form-label">Étudiant</label>
                <select class="form-control" id="etudiant_id" name="etudiant_id" required>
                  <?php foreach ($etudiants as $etudiant): ?>
                    <option value="<?= $etudiant['id'] ?>">
                      <?= $etudiant['nom'] . ' ' . $etudiant['prenom']?>
                    </option>
                  <?php endforeach; ?>    
                  <!-- Options dynamiques -->
                </select>
              </div>

              <!-- Sélection de l'évaluation -->
              <div class="mb-3">
                <label for="evaluation_id" class="form-label">Évaluation</label>
                <select class="form-control" id="evaluation_id" name="evaluation_id" required>
                  <?php foreach ($evaluations as $evaluation): ?>
                    <option value="<?= $evaluation['id'] ?>">
                      <?= $evaluation['nom'] ?>
                    </option>
                  <?php endforeach; ?>  
                  <!-- Options dynamiques -->
                </select>
              </div>

              <!-- Saisie de la note -->
              <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <input type="number" class="form-control" id="note" name="note" min="0" max="20" step="0.01" required>
              </div>

              <!-- Champ caché pour "created_by" -->
              <input type="hidden" id="created_by" value="1"> <!-- Modifier dynamiquement avec l'ID de l'utilisateur -->

              <button type="submit" name="frmAddNote" value="1" class="btn btn-primary">Enregistrer</button>
              <button type="reset" class="btn btn-danger">Annuler</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- ==================== Section Footer ==================== -->
  <?php require_once("../../../sections/admin/footer.php")?>  

  <!-- ==================== Section Base JS ==================== -->
  <?php require_once("../../../sections/admin/script.php")?>

</body>
</html>
