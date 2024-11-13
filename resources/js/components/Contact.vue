<template>
    <div class="contact-form-container">
        <h2 class="text-center">Formulaire de Contact</h2>
        <p class="text-center mb-4">Utilisez ce formulaire pour toute question, réclamation ou signalement de bug sur le
            site.</p>

        <form class="text-center">
            <div class="mb-3">
                <input v-model="first_name" type="text" placeholder="Prénom" required class="form-input" />
                <FormError :messages="errors?.first_name" />
            </div>
            <div class="mb-3">
                <input v-model="last_name" type="text" placeholder="Nom" required class="form-input" />
                <FormError :messages="errors?.last_name" />
            </div>
            <div class="mb-3">
                <input v-model="mail" type="email" placeholder="Adresse Email" required class="form-input" />
                <FormError :messages="errors?.mail" />
            </div>
            <div class="mb-3">
                <input v-model="phone" type="tel" placeholder="Numéro de Téléphone" required class="form-input" />
                <FormError :messages="errors?.phone" />
            </div>
            <div class="mb-3">
                <textarea v-model="content" placeholder="Votre message" required class="form-input" rows="4"></textarea>
                <FormError :messages="errors?.content" />
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-blue" @click="confirmContact">Envoyer</button>
                <button type="button" class="btn btn-red">Annuler</button>
            </div>
        </form>
    </div>
    <contextHolder />
</template>

<script setup>
import FormError from './FormError.vue';
import axios from 'axios';
import { ref } from 'vue';
import { notification } from 'ant-design-vue';

const [api, contextHolder] = notification.useNotification();
const errors = ref({});

const first_name = ref('');
const last_name = ref('');
const mail = ref('');
const phone = ref('');
const content = ref('');

const confirmContact = async () => {
    try {
        const response = await axios.post('/api/contact', {
        first_name: first_name.value,
        last_name: last_name.value,
        email: mail.value,
        phone: phone.value,
        message: content.value
    });
        api.success({ message: response.data.message });
    } catch (error) {
        console.error("Erreur lors de l'envoi du mail", error);
        api.error({
            message: 'Erreur lors de l\'envoi de l\'email',
            description: error.response?.data?.message
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