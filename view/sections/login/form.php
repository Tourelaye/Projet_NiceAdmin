<div class="card mb-3">

<div class="card-body">

  <div class="pt-4 pb-2">
    <h5 class="card-title text-center pb-0 fs-4">Se connecter a votre compte</h5>
    <p class="text-center small">Entrer votre nom users & mot de passe pour se connecter</p>
  </div>

  <form  action="admin" class="row g-3 needs-validation" novalidate>

    <div class="col-12">
      <label for="yourUsername" class="form-label">Nom d'utilisateur</label>
      <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend">@</span>
        <input type="text" name="username" class="form-control" id="yourUsername" required>
        <div class="invalid-feedback">Entrer votre nom svp.</div>
      </div>
    </div>

    <div class="col-12">
      <label for="yourPassword" class="form-label">Mot de passe</label>
      <input type="password" name="password" class="form-control" id="yourPassword" required>
      <div class="invalid-feedback">Entrer votre mot de passe svp!</div>
    </div>

    <div class="col-12">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
        <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
      </div>
    </div>
    <div class="col-12">
      <button class="btn btn-primary w-100" type="submit">Se connecter</button>
    </div>
    <div class="col-12">
      <p class="small mb-0">Vous ne possedez pas de compte? <a href="pages-register.html">Creer un compte</a></p>
    </div>
  </form>

</div>
</div>