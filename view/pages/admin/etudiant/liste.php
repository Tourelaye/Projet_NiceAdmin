<?php
  require_once("../../../../model/EtudiantRepository.php");
  $etudiantRepository = new EtudiantRepository();
  $etudiant = $etudiantRepository->getAll();
?>

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

          <input type="text" id="searchStudent" class="form-control mb-3" placeholder="Rechercher un étudiant...">

          <table class="table table-bordered">
            <thead class="table-dark">
              <tr>
                <th width="1%">ID</th>
                <th class ="text-nowrap">Nom</th>
                <th class ="text-nowrap">Photo</th>
                <th class ="text-nowrap">Email</th>
                <!-- <th class ="text-nowrap">Password</th> -->
                <th class ="text-nowrap">Adresse</th>
                <th class ="text-nowrap">Matricule</th>
                <th class ="text-nowrap">Téléphone</th>
                <th class ="text-nowrap">État</th>
              </tr>
            </thead>
            <tbody>
              <!-- Les étudiants seront affichés ici dynamiquement -->
               <?php if (!empty($etudiant)): ?>
                  <?php foreach ($etudiant as $etudiant): ?>
                    <tr>
                      <td><?= htmlspecialchars($etudiant['id']) ?></td>
                      <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                      <td><img src="<?= htmlspecialchars($etudiant['photo']) ?>" alt="Photo" width="50"></td>
                      <td><?= htmlspecialchars($etudiant['email']) ?></td>
                      <!-- <td><?= htmlspecialchars($etudiant['password']) ?></td> -->
                      <td><?= htmlspecialchars($etudiant['adresse']) ?></td>
                      <td><?= htmlspecialchars($etudiant['matricule']) ?></td>  
                      <td><?= htmlspecialchars($etudiant['telephone']) ?></td>
                      <td><?= htmlspecialchars($etudiant['etat']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>    
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
            <form action="EtudiantController" method="POST" enctype="multipart/form-data">
              <input type="hidden" id="studentId">
              
              <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
              </div>

              <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" required>
              </div>
              
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              
              <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              
              <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required>
              </div>
              
              <div class="mb-3">
                <label for="matricule" class="form-label">Matricule</label>
                <input type="text" class="form-control" id="matricule" name="matricule" required>
              </div>
              
              <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" required>
              </div>
              
              <div class="mb-3">
                <label for="etat" class="form-label">État</label>
                <select class="form-control" id="etat" name="etat" required>
                  <option value="actif">Actif</option>
                  <option value="inactif">Inactif</option>
                </select>
              </div>
              
              <button type="submit" name="frmAddEtudiant" value="1" class="btn btn-primary">Enregistrer</button>
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
