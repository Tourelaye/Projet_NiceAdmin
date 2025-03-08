<!DOCTYPE html>
<html lang="en">

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
      <h1>Liste des Étudiants</h1>
    </div>

    <section class="section">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Étudiants</h5>

          <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">
            Ajouter un étudiant
          </button>

          <table class="table table-bordered">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Date de naissance</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="studentTableBody">
              <!-- Les étudiants seront affichés ici dynamiquement -->
            </tbody>
          </table>

        </div>
      </div>
    </section>

    <!-- MODAL AJOUT ÉTUDIANT -->
    <div class="modal fade" id="addStudentModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter un étudiant</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form id="studentForm">
              <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" required>
              </div>
              <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
              </div>
              <div class="mb-3">
                <label for="dateNaissance" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" id="dateNaissance" required>
              </div>
              <button type="submit" class="btn btn-primary">Ajouter</button>
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