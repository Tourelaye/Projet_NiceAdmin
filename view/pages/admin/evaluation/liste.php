<?php 
  require_once("../../../../model/EtudiantRepository.php");
  require_once("../../../../model/EvaluationRepository.php");

  $etudiantRepository = new EtudiantRepository();
  $evaluationRepository = new EvaluationRepository();

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
                <th>Nom de l'etudiant</th>
                <th>Nom de l'evaluation</th>
                <th>Semestre</th>
                <th>Type d'évaluation</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($evaluations)): ?>
                <?php foreach ($evaluations as $evaluation): ?>
                  <tr>
                    <td><?= htmlspecialchars($evaluation['id']) ?></td>
                    <td><?= htmlspecialchars($evaluation['etudiant_nom']) . ' ' . htmlspecialchars($evaluation['prenom'])?></td>
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

            <!-- Sélection de l'étudiant -->
            <div class="mb-3">
              <label for="etudiant_id" class="form-label">Étudiant</label>
              <select class="form-control" id="etudiant_id" name="etudiant_id" required>
                <?php foreach ($etudiants as $etudiant): ?>
                  <option value="<?= $etudiant['id'] ?>">
                    <?= $etudiant['nom'] . ' ' . $etudiant['prenom']?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Sélection de l'évaluation -->
            <div class="mb-3">
              <label for="nom" class="form-label">Nom de l'évaluation</label>
              <select class="form-control" id="nom" name="nom" required>
                <option value="1">Probabilité-Statistique</option>
                <option value="2">Recherche Opérationnelle</option>
                <option value="3">Algorithme et programmation</option>
                <option value="4">PHP</option>
                <option value="5">Bases de données</option>
                <option value="6">Merise</option>
                <option value="7">Python</option>
                <option value="8">JavaScript</option>
                <option value="9">Linux</option>
                <option value="10">CyberSécurité</option>
              </select>
            </div>

            <!-- Sélection du semestre -->
            <div class="mb-3">
              <label for="semestre" class="form-label">Semestre</label>
              <select class="form-control" id="semestre" name="semestre" required>
                <option value="">Sélectionnez un semestre</option>
                <option value="1">Semestre 1</option>
                <option value="2">Semestre 2</option>
              </select>
            </div>

            <!-- Sélection du type d'évaluation -->
            <div class="mb-3">
              <label for="type_evaluation" class="form-label">Type d'évaluation</label>
              <select class="form-control" id="type_evaluation" name="type_evaluation" required>
                <option value="Devoir">Devoir</option>
                <option value="Examen">Examen</option>
              </select>
            </div>

            <!-- Boutons de soumission et d'annulation -->
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
