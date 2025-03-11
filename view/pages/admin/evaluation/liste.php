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
      <h1>Liste des Évaluations</h1>
    </div>

    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Évaluations</h5>

          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEvaluationModal">
            Ajouter une évaluation
          </button>

          <input type="text" id="searchEvaluation" class="form-control mb-3" placeholder="Rechercher une évaluation...">

          <table class="table table-bordered">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Étudiant</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Date limite</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="evaluationTableBody">
              <!-- Les évaluations seront affichées ici dynamiquement -->
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- MODAL AJOUT ÉVALUATION -->
    <div class="modal fade" id="addEvaluationModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter une évaluation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form id="evaluationForm">
              <div class="mb-3">
                <label for="etudiant_id" class="form-label">Étudiant</label>
                <select class="form-control" id="etudiant_id" required>
                  <!-- Options des étudiants seront chargées ici -->
                </select>
              </div>
              <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="titre" required>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" required></textarea>
              </div>
              <div class="mb-3">
                <label for="date_limite" class="form-label">Date limite</label>
                <input type="date" class="form-control" id="date_limite" required>
              </div>
              <button type="submit" class="btn btn-primary">Enregistrer</button>
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
    document.getElementById('searchEvaluation').addEventListener('input', function() {
      let searchValue = this.value.toLowerCase();
      let rows = document.querySelectorAll("#evaluationTableBody tr");
      rows.forEach(row => {
        let titre = row.children[2].textContent.toLowerCase();
        let description = row.children[3].textContent.toLowerCase();
        row.style.display = titre.includes(searchValue) || description.includes(searchValue) ? "" : "none";
      });
    });
  </script>
</body>
</html>