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
                <th>Matière</th>
                <th>Note Devoir</th>
                <th>Note Examen</th>
                <th>Actions</th>
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

              <!-- Sélection de la matière -->
              <div class="mb-3">
                <label for="matiere" class="form-label">Matière</label>
                <select class="form-control" id="matiere" required>
                  <!-- Options dynamiques -->
                </select>
              </div>

              <!-- Sélection de l'évaluation -->
              <div class="mb-3">
                <label for="evaluation" class="form-label">Type d'évaluation</label>
                <select class="form-control" id="evaluation" required>
                  <option value="1">Devoir</option>
                  <option value="2">Examen</option>
                  <!-- Ajoute d'autres types si nécessaire -->
                </select>
              </div>

              <!-- Saisie de la note -->
              <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <input type="number" class="form-control" id="note" min="0" max="20" step="0.01" required>
              </div>

              <!-- Saisie du coefficient -->
              <div class="mb-3">
                <label for="coefficient" class="form-label">Coefficient</label>
                <input type="number" class="form-control" id="coefficient" min="1" max="10" step="0.1" required>
              </div>

              <!-- Champ caché pour "created_by" -->
              <input type="hidden" id="created_by" value="1"> <!-- Modifier dynamiquement avec l'ID de l'utilisateur -->

              <button type="submit" class="btn btn-primary">Enregistrer</button>
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

  <script>
    document.getElementById('searchNote').addEventListener('input', function() {
      let searchValue = this.value.toLowerCase();
      let rows = document.querySelectorAll("#notesTableBody tr");
      rows.forEach(row => {
        let etudiant = row.children[1].textContent.toLowerCase();
        row.style.display = etudiant.includes(searchValue) ? "" : "none";
      });
    });

    function editNote(id) {
      // Implémentation de la modification d'une note
    }

    function deleteNote(id) {
      if (confirm("Voulez-vous vraiment supprimer cette note ?")) {
        // Implémentation de la suppression d'une note
      }
    }
  </script>
</body>
</html>