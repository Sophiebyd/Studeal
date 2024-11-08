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
                        data-bs-target="#addAnnouncementModal">
                        + Ajouter une annonce
                    </button>
                    <!-- Affiche le bouton Inscription si l'utilisateur est déconnecté -->
                    <button v-if="!userStore.isLogged" class="btn btn-outline-light" data-bs-toggle="modal"
                        data-bs-target="#signupModal">Inscription</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { useUserStore } from '@/stores/User';

const userStore = useUserStore();

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

</style>
