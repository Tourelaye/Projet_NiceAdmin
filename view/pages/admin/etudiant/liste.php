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
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Date de naissance</th>
                <th>Date d'inscription</th>
                <th>Adresse</th>
                <th>Nationalite</th>
                <th>Matricule</th>
                <th>Sexe</th>
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
            <form action="EtudiantController" method="POST">
              <input type="hidden" id="studentId">
              
              <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
                <p class="error-message"></p>
              </div>
              
              <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
                <p class="error-message"></p>
              </div>
              
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <p class="error-message"></p>
              </div>
              
              <div class="mb-3">
                <label for="date_naissance" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                <p class="error-message"></p>
              </div>
              
              <div class="mb-3">
                <label for="date_inscription" class="form-label">Date d'inscription</label>
                <input type="date" class="form-control" id="date_inscription" name="date_inscription" required>
                <p class="error-message"></p>
              </div>
              
              <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required>
                <p class="error-message"></p>
              </div>
              
              <div class="mb-3">
                <label for="nationalite" class="form-label">Nationalité</label>
                <input type="text" class="form-control" id="nationalite" name="nationalite" list="nationalites">
                <datalist id="nationalites">
                  <option value="Sénégalaise"></option>
                  <option value="Française"></option>
                  <option value="Malienne"></option>
                  <option value="Marocaine"></option>
                  <option value="Ivoirienne"></option>
                  <option value="Nigériane"></option>
                  <option value="Algérienne"></option>
                  <option value="Tunisienne"></option>
                  <option value="Américaine"></option>
                  <option value="Espagnole"></option>
                  <option value="Chinoise"></option>
                  <option value="Indienne"></option>
                  <option value="Canadienne"></option>
                  <option value="Allemande"></option>
                  <option value="Brésilienne"></option>
                  <option value="Portugaise"></option>
                  <option value="Italienne"></option>
                  <option value="Anglaise"></option>
                  <option value="Sud-africaine"></option>
                  <option value="Ghanéenne"></option>
                  <option value="Congolaise"></option>
                  <option value="Burkinabé"></option>
                  <option value="Égyptienne"></option>
                </datalist>
              </div>

              
              <div class="mb-3">
                <label for="matricule" class="form-label">Matricule</label>
                <input type="text" class="form-control" id="matricule" name="matricule" required>
                <p class="error-message"></p>
              </div>
              
              <div class="mb-3">
                <label for="sexe" class="form-label">Sexe</label>
                <select class="form-control" id="sexe" name="sexe" required>
                  <option value="M">Masculin</option>
                  <option value="F">Féminin</option>
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