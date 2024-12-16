<template>
    <div class="text-center mt-5">
        <img :src="'/avatars/' + userStore.user.picture" class="rounded image" alt="picture">
        <div class="mb-3 row mt-3 mx-0">
            <div>
                <button type="click" class="btn btn-primary me-2" @click="profilPict">Modifier l'avatar</button>
                <input class="form-control" type="file" accept="image/*" id="avatar" @change="onProfil"
                    style="display: none" />
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <form>
                <div class="mb-3 row">
                    <div class="col-12">
                        <label for="labelFirst_name" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="inputFirst_name" name="first_name"
                            v-model="form.first_name">
                        <FormError :messages="errors?.first_name" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-12">
                        <label for="labelLast_name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="inputLast_name" name="last_name"
                            v-model="form.last_name">
                        <FormError :messages="errors?.last_name" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-12">
                        <label for="labelBirthday" class="form-label">Date de naissance</label>
                        <input type="date" class="form-control" id="inputBirthday" name="Birthday"
                            v-model="form.birthday">
                        <FormError :messages="errors?.birthday" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-12">
                        <label for="labelPhone" class="form-label">Numéro de téléphone</label>
                        <input type="text" class="form-control" id="inputPhone" name="phone" v-model="form.phone">
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
                    <button type="button" id="closeProfilModal" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
                    <button type="button" id="closeConfirmDeleteModal" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
    <contextHolder />
</template>

<script setup>
import FormError from './FormError.vue';
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useUserStore } from '../stores/User';
import * as AuthService from '../_services/AuthService';
import * as UserService from '../_services/UserService';
import { notification } from 'ant-design-vue';

const [api, contextHolder] = notification.useNotification();
const userStore = useUserStore();
const errors = ref({});
const router = useRouter();
const form = ref({
    first_name: userStore.user.first_name,
    last_name: userStore.user.last_name,
    birthday: userStore.user.birthday,
    phone: userStore.user.phone,
});

const confirmDelete = async () => {
    try {
        await AuthService.deleteProfil();
        document.getElementById('closeConfirmDeleteModal').click();
        router.push('/');
    } catch (error) {
        console.error("Erreur lors de la suppression du compte", error);
        errors.value = error.response.data.errors;
        api.error({ message: 'Erreur lors de la suppression du compte', description: error.message });
    }
};

const confirmProfil = async () => {
    try {
        const data = await UserService.update(form.value);
        userStore.setUser(data.user);
        document.getElementById('closeProfilModal').click();
        api.success({ message: 'Profil modifié avec succès' });
    } catch (error) {
        console.error("Erreur lors de la modification du compte", error);
        errors.value = error.response?.data?.errors;
        api.error({
            message: 'Erreur lors de la modification du profil', description: error.message
        });
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

    UserService.updateWithPicture({ ...form.value, picture: file }).then((data) => {
        userStore.setUser(data.user);
        api.success({ message: 'Avatar modifié avec succès' });
        router.push('/')
    }).catch(error => {
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors;
            api.error({
                message: 'Erreur lors de la modification du profil', description: error.response?.data?.message
            });
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
