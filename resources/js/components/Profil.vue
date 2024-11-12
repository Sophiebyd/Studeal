<template>
    <div class="text-center mt-5">
        <img src="../../../public/img/default.jpg" class="rounded image" alt="picture">
        <div class="mb-3 row mt-3 mx-0">
            <div>
                <button type="click" class="btn btn-primary me-2" @click="profilPict">Modifier l'avatar</button>
                <input class="form-control" type="file" id="avatar" @change="onProfil" style="display: none" />
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <form @submit.prevent="modification">
                <div class="mb-3 row">
                    <div class="col-12">
                        <label for="labelFirst_name" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="inputFirst_name" name="first_name"
                            v-model="user.first_name">
                        <FormError :messages="errors?.first_name" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-12">
                        <label for="labelLast_name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="inputLast_name" name="last_name"
                            v-model="user.last_name">
                        <FormError :messages="errors?.last_name" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-12">
                        <label for="labelEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email"
                            v-model="user.email">
                        <FormError :messages="errors?.email" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-12">
                        <label for="labelBirthday" class="form-label">Date de naissance</label>
                        <input type="date" class="form-control" id="inputBirthday" name="Birthday"
                            v-model="user.birthday">
                        <FormError :messages="errors?.birthday" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-12">
                        <label for="labelPhone" class="form-label">Numéro de téléphone</label>
                        <input type="text" class="form-control" id="inputPhone" name="phone"
                            v-model="user.phone">
                        <FormError :messages="errors?.phone" />
                    </div>
                </div>
                <div class="mb-3 row mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                            data-bs-target="#confirmProfilModal">Modifier le profil</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal">
                            Supprimer le compte
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal pour la modification du compte -->
    <div class="modal fade" id="confirmProfilModal" tabindex="-1" aria-labelledby="confirmProfilModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmProfilModalLabel">Confirmer la modification</h5>
                    <button type="button" id="closeProfilModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir modifier votre profil ?.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="confirmProfil">Oui</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour la suppression du compte -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="confirmDelete">Oui</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Non</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import FormError from './FormError.vue';
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import * as AuthService from '../_services/AuthService';
import * as UserService from '../_services/UserService';

const errors = ref({});
const router = useRouter();
const user = ref({});

onMounted(async () => {
    user.value = await UserService.getUserById(router.currentRoute.value.params.id);
});

const confirmDelete = async () => {
    try {
        await AuthService.deleteProfil()
        router.push('/');
    } catch (error) {
        console.error("Erreur lors de la suppression du compte", error);
        errors.value = error.response.data.errors
    }
};

const confirmProfil = async () => {
    try {
        await AuthService.modification();
        document.getElementById('closeProfilModal').click();
    } catch (error) {
        console.error("Erreur lors de la modification du compte", error);
        errors.value = error.response?.data?.errors;
    }
};

// Ajouter une image
function onProfil(event) {
    const file = event.target.files[0];

    if (!file) {
        console.error('Aucun fichier sélectionné');
        return;
    }

    if (!file.type.startsWith('image/')) {
        alert('Veuillez télécharger un fichier image.');
        return;
    }

    UserService.newAvatar({ picture: file }).then(() => {
        console.log("Changement d'avatar réussi");
    }).catch(error => {
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors;
        }
    });
}

function profilPict() {
    document.getElementById('avatar').click();
}

</script>

<style scoped>
.image {
    width: 150px;
    height: 150px;
}
</style>
