<?php 
  require_once("../../../../model/EvaluationRepository.php");
  $evaluationRepository = new EvaluationRepository();
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
      <h1>Liste des Évaluations</h1>
    </div>

    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Évaluations</h5>

          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEvaluationModal">
            Ajouter une évaluation
          </button>

          <table class="table table-bordered">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Étudiant ID</th>
                <th>Nom</th>
                <th>Semestre</th>
                <th>Type d'évaluation</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($evaluations)): ?>
                <?php foreach ($evaluations as $evaluation): ?>
                  <tr>
                    <td><?= htmlspecialchars($evaluation['id']) ?></td>
                    <td><?= htmlspecialchars($evaluation['etudiant_id']) ?></td>
                    <td><?= htmlspecialchars($evaluation['nom']) ?></td>
                    <td><?= htmlspecialchars($evaluation['semestre']) ?></td>
                    <td><?= htmlspecialchars($evaluation['type_evaluation']) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
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
            <form action="EvaluationController" method="POST" enctype="multipart/form-data">
            
  
              <div class="mb-3">
                <label for="etudiant_id" class="form-label">ID Étudiant</label>
                <input type="number" class="form-control" id="etudiant_id" name="etudiant_id" required>
              </div>

              <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
              </div>

              <!-- Champ pour le semestre -->
              <div class="mb-3">
                <label for="semestre" class="form-label">Semestre</label>
                <select class="form-control" id="semestre" name="semestre" required>
                  <option value="">Sélectionnez un semestre</option>
                  <option value="1">Semestre 1</option>
                  <option value="2">Semestre 2</option>
                </select>
              </div>
              
              <div class="mb-3">
                <label for="type_evaluation" class="form-label">Type d'évaluation</label>
                <select class="form-control" id="type_evaluation" name="type_evaluation" required>
                  <option value="Devoir">Devoir</option>
                  <option value="Examen">Examen</option>
                </select>
              </div>
              <button type="submit" name="frmAddEvaluation" class="btn btn-primary">Enregistrer</button>
              <button type="reset" class="btn btn-danger">Annuler</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- ==================== Section Footer ==================== -->
  <?php require_once("../../../sections/admin/footer.php")?>  

</body>
</html>
