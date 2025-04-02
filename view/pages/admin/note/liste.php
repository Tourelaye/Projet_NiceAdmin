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
            <tbody id="notesTableBody">
              <!-- Les notes seront affichées ici dynamiquement -->
            </tbody>
          </table>

        </div>
      </div>
    </section>

    <!-- MODAL AJOUT NOTE -->
    <div class="modal fade" id="addNoteModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter une note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form id="noteForm">
              <input type="hidden" id="noteId">

              <!-- Sélection de l'étudiant -->
              <div class="mb-3">
                <label for="etudiant" class="form-label">Étudiant</label>
                <select class="form-control" id="etudiant" required>
                  <!-- Options dynamiques -->
                </select>
              </div>

              <!-- Sélection de l'évaluation -->
              <div class="mb-3">
                <label for="evaluation" class="form-label">Évaluation</label>
                <select class="form-control" id="evaluation" required>
                  <!-- Options dynamiques -->
                </select>
              </div>

              <!-- Saisie de la note -->
              <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <input type="number" class="form-control" id="note" min="0" max="20" step="0.01" required>
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
