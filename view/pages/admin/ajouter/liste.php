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
    <section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title text-center">Ajouter Étudiant</h5>

                        <!-- Message de succès caché par défaut -->
                        <div id="successMessage" class="alert alert-success d-none text-center">
                            ✅ Ajout fait avec succès !
                        </div>

                        <form id="registrationForm" class="row g-3 needs-validation" novalidate>
                            <!-- Nom -->
                            <div class="col-md-6">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-control" required>
                                <div class="invalid-feedback">Veuillez entrer votre nom.</div>
                            </div>
                            <!-- Prénom -->
                            <div class="col-md-6">
                                <label class="form-label">Prénom</label>
                                <input type="text" class="form-control" required>
                                <div class="invalid-feedback">Veuillez entrer votre prénom.</div>
                            </div>
                            <!-- Genre -->
                            <div class="col-md-6">
                                <label class="form-label">Genre</label>
                                <select class="form-select" required>
                                    <option selected disabled value="">Sélectionner...</option>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                                <div class="invalid-feedback">Veuillez sélectionner votre genre.</div>
                            </div>
                            <!-- Date de naissance -->
                            <div class="col-md-6">
                                <label class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" required>
                                <div class="invalid-feedback">Veuillez entrer votre date de naissance.</div>
                            </div>
                            <!-- Nationalité -->
                            <div class="col-md-6">
                                <label class="form-label">Nationalité</label>
                                <select class="form-select" id="nationalite" required>
                                    <option value="fr" data-flag="🇫🇷">France</option>
                                    <option value="sn" data-flag="🇸🇳">Sénégal</option>
                                    <option value="us" data-flag="🇺🇸">États-Unis</option>
                                    <option value="de" data-flag="🇩🇪">Allemagne</option>
                                    <option value="cn" data-flag="🇨🇳">Chine</option>
                                </select>
                                <div class="invalid-feedback">Veuillez sélectionner votre pays.</div>
                            </div>
                            <!-- Numéro de téléphone -->
                            <div class="col-md-6">
                                <label class="form-label">Numéro de téléphone</label>
                                <input type="tel" class="form-control" id="telephone" required>
                                <div class="invalid-feedback">Veuillez entrer un numéro valide.</div>
                            </div>
                            <!-- Email -->
                            <div class="col-md-12">
                                <label class="form-label">Adresse Email</label>
                                <input type="email" class="form-control" required>
                                <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
                            </div>
                            <!-- Bouton de soumission -->
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">S'inscrire</button>
                            </div>
                        </form><!-- Fin du formulaire -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

  </main> 

  <!-- ==================== Section Footer ==================== -->
  <?php require_once("../../../sections/admin/footer.php")?>  

  <!-- ==================== Section Base JS ==================== -->
  <?php require_once("../../../sections/admin/script.php")?>

</body>

</html>