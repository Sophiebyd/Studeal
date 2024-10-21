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
                    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
                        + Ajouter une annonce
                    </button>
                    <button class="btn btn-outline-light"  data-bs-toggle="modal" data-bs-target="#addSignUpModal">Inscription</button>
                </div>
            </div>
        </div>

        <!-- Modal pour ajouter une annonce -->
        <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementLabel"
            aria-hidden="true">
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
    </div>
</template>

<script setup>
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

.modal-footer .btn {
    margin: 0 5px;
}
</style>