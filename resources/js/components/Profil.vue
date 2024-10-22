<template>
    <div class="text-center mt-5">
        <img src="../../../public/img/default.jpg" class="rounded image" alt="picture">
        <div class="mb-3 row mt-3">
            <div>
                <button type="submit" class="btn btn-primary me-2">Modifier l'avatar</button>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <form @submit.prevent="modification">
                <p v-if="errorMessage != ''" class="text-white bg-danger w-50 p-3 mx-auto">{{ errorMessage }}</p>
                <div class="mb-3 row">
                    <div class="col-12">
                        <label for="labelPseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" id="inputPseudo" name="pseudo"
                            v-model="userStore.pseudo">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-12">
                        <label for="labelEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" v-model="userStore.email">
                    </div>
                </div>
                <!-- <div class="mb-3 row">
                    <div class="col-12">
                        <label for="labelPassword" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="inputOldPassword" name="oldPassword"
                            placeholder="Ancien mot de passe" v-model="oldPassword">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-12">
                        <input type="password" class="form-control" id="inputNewPassword" name="newPassword"
                            placeholder="Nouveau mot de passe" v-model="newPassword">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-12">
                        <input type="password" class="form-control" id="inputPassword" name="confirmPassword"
                            placeholder="Confirmer mot de passe" v-model="confirmPassword">
                    </div>
                </div> -->
                <div class="mb-3 row mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary me-2">Modifier le profil</button>
                    </div>
                </div>
            </form>
            <button @click="deleteAccount" class="btn btn-danger">Supprimer le compte</button>
        </div>
    </div>

</template>

<script setup>
</script>