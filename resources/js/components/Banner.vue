<template>
    <div>
        <div class="banner position-relative">
            <img src="../../../public/img/Banner.jpg" alt="Bannière" class="img-fluid w-100 banner-img" />

            <!-- Overlay -->
            <div
                class="banner-overlay d-flex flex-column justify-content-center align-items-center position-absolute top-0 start-0 w-100 h-100">
                <h1 class="text-white mb-4">Stu'deal, la plateforme de petites annonces des étudiants</h1>
                <p class="text-white text-center mb-5">
                    Vous êtes étudiant et à la recherche des bons plans ? Avec Stu'deal, trouvez votre bonheur
                    rapidement et efficacement.
                </p>
                <div class="mt-5">
                    <button class="btn btn-outline-light btn-annonce me-2" data-bs-toggle="modal"
                        data-bs-target="#addAnnouncementBannerModal">
                        + Ajouter une annonce
                    </button>
                    <!-- Affiche le bouton Inscription si l'utilisateur est déconnecté -->
                    <button v-if="!userStore.isLogged" class="btn btn-outline-light" data-bs-toggle="modal"
                        data-bs-target="#signupBannerModal">Inscription</button>
                </div>
            </div>
        </div>

        <!-- Modal pour ajouter une annonce -->
        <div class="modal fade" id="addAnnouncementBannerModal" tabindex="-1"
            aria-labelledby="addAnnouncementBannerLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAnnouncementBannerLabel">Ajouter une annonce</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="titleBanner" class="form-label">Titre</label>
                                <input type="text" class="form-control" id="titleBanner" />
                            </div>
                            <div class="mb-3">
                                <label for="categoryBanner" class="form-label">Catégorie</label>
                                <!-- Menu déroulant pour les catégories -->
                                <select v-model="selectedCategory" class="form-select" id="categoryBanner">
                                    <option value="colocation">Colocation</option>
                                    <option value="covoiturage">Covoiturage</option>
                                    <option value="vente_meubles">Vente de meubles</option>
                                    <option value="soutien_scolaire">Soutien Scolaire</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="addressBanner" class="form-label">Lieu</label>
                                <input type="text" class="form-control" id="addressBanner" />
                            </div>
                            <div class="mb-3">
                                <label for="priceBanner" class="form-label">Prix</label>
                                <input type="text" class="form-control" id="priceBanner" />
                            </div>
                            <div class="mb-3">
                                <label for="messageBanner" class="form-label">Message</label>
                                <textarea class="form-control" id="messageBanner" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="imageUploadBanner" class="form-label">Télécharger une image</label>
                                <input class="form-control" type="file" id="imageUploadBanner" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Envoyer</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal pour l'inscription -->
        <div class="modal fade" id="signupBannerModal" tabindex="-1" aria-labelledby="signupModalBannerLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="signupModalBannerLabel">Inscription</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="register">
                            <div class="mb-3">
                                <label for="firstNameBanner" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="firstNameBanner"
                                    v-model="signup.first_name" />
                                <FormError :messages="errors?.first_name" />
                            </div>
                            <div class="mb-3">
                                <label for="lastNameBanner" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="lastNameBanner"
                                    v-model="signup.last_name" />
                                <FormError :messages="errors?.last_name" />
                            </div>
                            <div class="mb-3">
                                <label for="emailSignupBanner" class="form-label">Email</label>
                                <input type="email" class="form-control" id="emailSignupBanner"
                                    v-model="signup.email" />
                                <FormError :messages="errors?.email" />
                            </div>
                            <div class="mb-3">
                                <label for="dateBanner" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" id="dateBanner" v-model="signup.birthday" />
                                <FormError :messages="errors?.birthday" />
                            </div>
                            <div class="mb-3">
                                <label for="phoneBanner" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="phoneBanner" v-model="signup.phone" />
                                <FormError :messages="errors?.phone" />
                            </div>
                            <div class="mb-3">
                                <label for="passwordSignupBanner" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="passwordSignupBanner"
                                    v-model="signup.password" />
                                <FormError :messages="errors?.password" />
                            </div>
                            <div class="mb-3">
                                <label for="ConfirmPasswordSignupBanner" class="form-label">Confirmer Mot de
                                    passe</label>
                                <input type="password" class="form-control" id="ConfirmPasswordSignupBanner"
                                    v-model="signup.password_confirmation" />
                                <FormError :messages="errors?.password_confirmation" />
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">S'inscrire</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <contextHolder />
</template>

<script setup>
import { ref } from 'vue';
import { notification } from 'ant-design-vue';
import * as AuthService from '../_services/AuthService';
import { useUserStore } from '@/stores/User';
import FormError from './FormError.vue';

const userStore = useUserStore();
const [api, contextHolder] = notification.useNotification();

let signup = ref({});
let errors = ref({});

function resetSignupFields() {
    signup.value = {
        first_name: '',
        last_name: '',
        email: '',
        birthday: '',
        phone: '',
        password: '',
        password_confirmation: ''
    };
}

// Fonction d'inscription de l'utilisateur
function register() {
    AuthService.register(signup.value).then(() => {
        errors.value = {};
        resetSignupFields();
        api.success({ message: 'Inscription réussie' });
        document.getElementById('signupBannerModal');
        router.push('/')
    }).catch(error => {
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors;
        }
    });
}
</script>

<style scoped>
.banner {
    position: relative;
    height: 440px;
}

.banner-img {
    height: 440px;
    object-fit: cover;
}

.banner-overlay {
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    text-align: center;
}

h1 {
    margin-bottom: 20px;
}

p {
    margin-bottom: 30px;
}

.mt-5 {
    margin-top: 3rem !important;
}

.btn-annonce {
    border: 2px solid white;
    background-color: transparent;
    color: white;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-annonce:hover {
    background-color: orange;
    color: white;
}

.modal-footer .btn {
    margin: 0 5px;
}
</style>
