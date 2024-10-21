<template>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="../../../public/img/Logo.png" alt="Logo" class="logo" />
      </a>
      <div class="d-flex ms-auto align-items-center">
        <!-- Bouton Ajouter une annonce-->
        <button class="btn btn-annonce me-3" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
          + Ajouter une annonce
        </button>
        <!-- Barre de recherche-->
        <form class="d-flex me-3" role="search">
          <input class="form-control search-bar" type="search" placeholder="Barre de recherche" aria-label="Search" />
        </form>

        <!-- Bouton Menu -->
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle menu-link" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#loginModal">Connexion</button></li>
              <li><router-link class="dropdown-item" to="/colocation">Colocation</router-link></li>
              <li><router-link class="dropdown-item" to="/covoiturage">Covoiturage</router-link></li>
              <li><router-link class="dropdown-item" to="/vente-meubles">Ventes de meubles</router-link></li>
              <li><router-link class="dropdown-item" to="/soutien-scolaire">Soutien scolaire</router-link></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Modal pour Ajouter une annonce -->
  <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addAnnouncementLabel">Ajouter une annonce</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <!-- Champs du formulaire pour l'annonce -->
            <div class="mb-3">
              <label for="title" class="form-label">Titre</label>
              <input type="text" class="form-control" id="title" />
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">Adresse</label>
              <input type="text" class="form-control" id="address" />
            </div>
            <div class="mb-3">
              <label for="price" class="form-label">Prix</label>
              <input type="text" class="form-control" id="price" />
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" rows="3"></textarea>
            </div>
            <div class="mb-3">
              <label for="imageUpload" class="form-label">Télécharger une image</label>
              <input class="form-control" type="file" id="imageUpload" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-primary">Envoyer</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal pour la Connexion -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="emailLogin" class="form-label">Adresse email</label>
              <input type="email" class="form-control" id="emailLogin" />
            </div>
            <div class="mb-3">
              <label for="passwordLogin" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="passwordLogin" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Connexion</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
        </div>
        <div class="text-center mt-2">
          <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Inscription</button> |
          <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" data-bs-dismiss="modal">Mot de passe oublié</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal pour l'inscription -->
  <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="signupModalLabel">Inscription</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="firstName" class="form-label">Prénom</label>
              <input type="text" class="form-control" id="firstName" />
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Nom</label>
              <input type="text" class="form-control" id="lastName" />
            </div>
            <div class="mb-3">
              <label for="emailSignup" class="form-label">Email</label>
              <input type="email" class="form-control" id="emailSignup" />
            </div>
            <div class="mb-3">
              <label for="dob" class="form-label">Date de naissance</label>
              <input type="date" class="form-control" id="dob" />
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Téléphone</label>
              <input type="text" class="form-control" id="phone" />
            </div>
            <div class="mb-3">
              <label for="passwordSignup" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="passwordSignup" />
            </div>
            <div class="mb-3">
              <label for="confirmPasswordSignup" class="form-label">Confirmer le mot de passe</label>
              <input type="password" class="form-control" id="confirmPasswordSignup" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">S'inscrire</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
        </div>
        <div class="text-center mt-2">
          <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Connexion</button> |
          <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" data-bs-dismiss="modal">Mot de passe oublié</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal pour Mot de passe oublié -->
  <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="forgotPasswordModalLabel">Mot de passe oublié</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="emailForgotPassword" class="form-label">Adresse email</label>
              <input type="email" class="form-control" id="emailForgotPassword" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Envoyer</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
        </div>
        <div class="text-center mt-2">
          <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Inscription</button> |
          <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Connexion</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  
</script>

<style scoped>
.navbar {
  background-color: #8B428F;
}

.logo {
  width: 50px;
  height: 50px;
}

.btn-annonce {
  height: 38px;
  padding: 5px 15px;
  background-color: white;
  color: #8B428F;
  border-radius: 5px;
  border: none;
  font-size: 1rem;
  white-space: nowrap;
}

.search-bar {
  height: 38px;
  width: 200px;
  border-radius: 5px;
}

.menu-link {
  color: white !important;
  background-color: transparent;
  border: 2px solid white;
  border-radius: 5px;
  padding: 5px 15px;
}

.dropdown-menu {
  position: absolute !important;
  top: 100%;
  left: 0;
  z-index: 1000;
  border: 1px solid white;
}

.modal-footer .btn {
  margin: 0 5px;
}

.text-center .btn-link {
  text-decoration: underline;
}

@media (max-width: 576px) {
  .navbar {
    padding: 10px 15px;
  }

  .btn-annonce {
    font-size: 0.85rem;
    padding: 3px 10px;
    height: 34px;
  }

  .search-bar {
    height: 34px;
    width: 150px;
  }

  .d-flex {
    flex-direction: column;
    align-items: flex-start;
  }

  .navbar-nav {
    margin-top: 10px;
  }

  .menu-link {
    font-size: 0.85rem;
    padding: 3px 10px;
  }
}
</style>
