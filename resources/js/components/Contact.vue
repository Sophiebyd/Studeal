<template>
    <div class="contact-form-container">
        <h2 class="text-center">Formulaire de Contact</h2>
        <p class="text-center mb-4">Utilisez ce formulaire pour toute question, réclamation ou signalement de bug sur le
            site.</p>

        <form class="text-center">
            <div class="mb-3">
                <input type="text" placeholder="Prénom" required class="form-input" />
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Nom" required class="form-input" />
            </div>
            <div class="mb-3">
                <input type="email" placeholder="Adresse Email" required class="form-input" />
            </div>
            <div class="mb-3">
                <input type="tel" placeholder="Numéro de Téléphone" required class="form-input" />
            </div>
            <div class="mb-3">
                <textarea placeholder="Votre message" required class="form-input" rows="4"></textarea>
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-blue" @click="confirmContact">Envoyer</button>
                <button type="button" class="btn btn-red">Annuler</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { notification } from 'ant-design-vue';

const form = ref({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    message: ''
});

const confirmContact = async () => {
    try {
        const response = await axios.post('/send-contact', form.value);
        notification.success({ message: response.data.message });
    } catch (error) {
        console.error("Erreur lors de l'envoi du mail", error);
        notification.error({
            message: 'Erreur lors de l\'envoi de l\'email',
            description: error.response?.data?.message || 'Une erreur est survenue.'
        });
    }
};
</script>

<style scoped>
.contact-form-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    text-align: center;
    font-family: 'Arial', sans-serif;
}

.form-input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.button-group {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.btn {
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-blue {
    background-color: #007bff;
    color: white;
}

.btn-red {
    background-color: #dc3545;
    color: white;
}
</style>