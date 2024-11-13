<template>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <router-link class="navbar-brand" to="/">
        <img src="../../../public/img/Logo.png" alt="Logo" class="logo" />
      </router-link>

      <!-- Affiche l'email uniquement si l'utilisateur est connecté -->
      <router-link class="userAddress" v-if="userStore.isLogged" to="/profil">
        {{ userStore.user.email }}
      </router-link>

      <div class="d-flex ms-auto align-items-center">
        <button  v-if="userStore.isLogged" class="btn btn-annonce me-3" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
          + Ajouter une annonce
        </button>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle menu-link" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <!-- Affiche le bouton Connexion si l'utilisateur n'est pas connecté -->
              <li v-if="!userStore.isLogged"><button class="dropdown-item" data-bs-toggle="modal"
                  data-bs-target="#loginModal">Connexion</button></li>

              <!-- Affiche le lien vers le profil avec l'ID de l'utilisateur si connecté -->
              <li v-if="userStore.isLogged">
                <router-link class="dropdown-item" to="/profil">Profil</router-link>
              </li>

              <!-- Affiche le lien vers le profil si l'utilisateur a le role = admin -->
              <li v-if="userStore.user.role === 'admin'">
                <router-link class="dropdown-item" to="/admin">Administration</router-link>
              </li>

              <li><router-link class="dropdown-item" to="/colocation">Colocation</router-link></li>
              <li><router-link class="dropdown-item" to="/covoiturage">Covoiturage</router-link></li>
              <li><router-link class="dropdown-item" to="/vente-meubles">Ventes de meubles</router-link></li>
              <li><router-link class="dropdown-item" to="/soutien-scolaire">Soutien scolaire</router-link></li>

              <!-- Affiche le bouton Déconnexion si l'utilisateur est connecté -->
              <li v-if="userStore.isLogged">
                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Déconnexion</button>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Modal pour ajouter une annonce -->
  <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementBannerLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addAnnouncementLabel">Ajouter une annonce</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            id="addArticleClose"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="addArticle">
            <div class="mb-3">
              <label for="title" class="form-label">Titre</label>
              <input type="text" class="form-control" id="title" v-model="article.title" />
              <FormError :messages="errors?.title" />
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Catégorie</label>
              <select v-model="article.category_id" class="form-select" id="category" required>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                  {{ category.name }}
                </option>
              </select>
              <FormError :messages="errors?.category_id" />
            </div>
            <div class="mb-3">
              <label for="address" class="form-label">Lieu</label>
              <input type="text" class="form-control" id="address" v-model="article.address" />
              <FormError :messages="errors?.address" />
            </div>
            <div class="mb-3">
              <label for="price" class="form-label">Prix</label>
              <input type="number" class="form-control" id="price" v-model="article.price" min="0" max="250"/>
              <FormError :messages="errors?.price" />
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" rows="3" v-model="article.content"></textarea>
              <FormError :messages="errors?.content" />
            </div>
            <div class="mb-3">
              <label for="imageUpload" class="form-label">Télécharger une image</label>
              <input class="form-control" type="file" id="imageUpload" @change="onPicture" />
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" value="Publier" />
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
            </div>
          </form>
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
          <button type="button" class="btn-close" id="loginModalClose" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="authenticate">
            {{ errorMessageConnexion }}
            <div class="mb-3">
              <label for="emailLogin" class="form-label">Adresse email</label>
              <input type="email" class="form-control" id="emailLogin" v-model="login.email" />
              <FormError :messages="errors?.email" />
            </div>
            <div class="mb-3">
              <label for="passwordLogin" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="passwordLogin" v-model="login.password" />
              <FormError :messages="errors?.password" />
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" value="Connexion" />
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
            </div>
          </form>
        </div>
        <div class="text-center mt-2">
          <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal"
            @click="changeModal">Inscription</button> |
          <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal"
            data-bs-dismiss="modal" @click="changeModal">Mot de passe oublié</button>
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
          <button type="button" class="btn-close" id="signupModalClose" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="register">
            <div class="mb-3">
              <label for="firstName" class="form-label">Prénom</label>
              <input type="text" class="form-control" id="firstName" v-model="subscribe.first_name" />
              <FormError :messages="errors?.first_name" />
            </div>
            <div class="mb-3">
              <label for="lastName" class="form-label">Nom</label>
              <input type="text" class="form-control" id="lastName" v-model="subscribe.last_name" />
              <FormError :messages="errors?.last_name" />
            </div>
            <div class="mb-3">
              <label for="emailSignup" class="form-label">Email</label>
              <input type="email" class="form-control" id="emailSignup" v-model="subscribe.email" />
              <FormError :messages="errors?.email" />
            </div>
            <div class="mb-3">
              <label for="date" class="form-label">Date de naissance</label>
              <input type="date" class="form-control" id="date" v-model="subscribe.birthday" />
              <FormError :messages="errors?.birthday" />
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Téléphone</label>
              <input type="text" class="form-control" id="phone" v-model="subscribe.phone" />
              <FormError :messages="errors?.phone" />
            </div>
            <div class="mb-3">
              <label for="passwordSignup" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="passwordSignup" v-model="subscribe.password" />
              <FormError :messages="errors?.password" />
            </div>
            <div class="mb-3">
              <label for="confirmPasswordSignup" class="form-label">Confirmer le mot de passe</label>
              <input type="password" class="form-control" id="confirmPasswordSignup"
                v-model="subscribe.password_confirmation" />
              <FormError :messages="errors?.password_confirmation" />
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" value="S'inscrire" />
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
            </div>
          </form>
        </div>

        <div class="text-center mt-2">
          <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal"
            @click="changeModal">Connexion</button> |
          <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal"
            data-bs-dismiss="modal" @click="changeModal">Mot de passe oublié</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal pour déconnexion -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Voulez-vous déconnecter ?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <button @click="logout" class="btn btn-primary" data-bs-dismiss="modal">Déconnecter</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal pour Mot de passe oublié -->
  <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
    aria-hidden="true">
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
          <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal"
            @click="changeModal">Inscription</button> |
          <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal"
            @click="changeModal">Connexion</button>
        </div>
      </div>
    </div>
  </div>

  <contextHolder />
</template>

<script setup>
import { notification } from 'ant-design-vue';
import { ref, onMounted } from 'vue';
import * as AuthService from '../_services/AuthService';
import * as CategoryService from '../_services/CategoryService';
import * as ArticleService from '../_services/ArticleService';
import FormError from './FormError.vue';
import { useUserStore } from '@/stores/User';
import { useRouter } from 'vue-router';

const [api, contextHolder] = notification.useNotification();
const userStore = useUserStore();
const router = useRouter();

let subscribe = ref({});
let login = ref({});
let errors = ref({});
const categories = ref([]);
const errorMessageConnexion = ref('');

let article = ref({
  title: '',
  address: '',
  content: '',
  price: '',
  category_id: '',
  picture: ''
});

function changeModal() {
  errors.value = {};
  subscribe.value = {};
}

function register() {
  AuthService.register(subscribe.value).then(() => {
    document.getElementById('signupModalClose').click();
    api.info({ message: `Inscription réussie` });
  }).catch(error => {
    if (error.response && error.response.data.errors) {
      errors.value = error.response.data.errors;
    }
  });
}

function authenticate() {
  AuthService.authenticate(login.value).then(() => {
    document.getElementById('loginModalClose').click();
    api.info({ message: `Connexion réussie` });
  }).catch(error => {
    if (error.status == 422 && error.response && error.response.data.errors) {
      errors.value = error.response.data.errors;
    }
    if (error.status == 401) {
      errorMessageConnexion.value = error.response.data.errors;
    }
  });
}

async function logout () {
  await AuthService.logout()
  api.info({ message: `Déconnexion réussie` });
  router.push('/');
}


// Fonction pour ajouter un article
function addArticle() {
  ArticleService.newArticle(article.value).then(() => {
    document.getElementById('addArticleClose').click();
    api.info({ message: `Création de l'article réussite` });
  }).catch(error => {
    if (error.response && error.response.data.errors) {
      errors.value = error.response.data.errors;
    }
  });
}

// Fonction pour récupérer et afficher les catégories
onMounted(async () => {
  try {
    const response = await CategoryService.getCategories();
    categories.value = response.categories;
  } catch (error) {
    console.error('Erreur lors du chargement des catégories:', error);
  }
});

// Ajouter une image
function onPicture(event) {
  const file = event.target.files[0];

  if (!file) {
    console.error('Aucun fichier sélectionné');
    return;
  }

  if (!file.type.startsWith('image/')) {
    alert('Veuillez télécharger un fichier image.');
    return;
  }

  // Assigner le fichier directement à la propriété `picture`
  article.value.picture = file;
}

</script>

<style scoped>

.navbar-nav .dropdown-menu {
  position: absolute;
}

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
  transition: transform 0.2s ease-in-out;
}

.btn-annonce:hover {
  transform: scale(1.05);
  background-color: white;
  color: #8B428F;
}

.menu-link {
  color: white !important;
  background-color: transparent;
  border: 2px solid white;
  border-radius: 5px;
  padding: 5px 15px;
}

.userAddress {
  color: white;
  text-decoration: none;
}

.modal-footer .btn {
  margin: 0 5px;
}

.text-center .btn-link {
  text-decoration: underline;
}

/* Responsive */
@media (max-width: 576px) {
  .userAddress {
    display: none;
  }

  .btn-annonce {
    font-size: 0.85rem;
    padding: 3px 10px;
  }

  .menu-link {
    font-size: 0.85rem;
  }
}
</style>
