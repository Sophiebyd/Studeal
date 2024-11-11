<template>
    <div class="article-container">
        <h1 class="article-title">{{ article.title }}</h1>
        <div class="article-image">
            <img :src="article.picture" alt="Image de l'article" />
        </div>
        <div class="article-details">
            <p class="article-description">{{ article.content }}</p>
            <div class="article-info">
                <p><strong>Adresse :</strong> {{ article.address }}</p>
                <p><strong>Prix :</strong> {{ article.price }} €</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import * as ArticleService from '../_services/ArticleService';

const article = ref({});
const route = useRoute();

onMounted(async () => {
    const articleId = route.params.id;
    try {
        const response = await ArticleService.getArticleById(articleId);
        article.value = response;
    } catch (error) {
        console.error('Erreur lors de la récupération de l\'article:', error);
    }
});
</script>

<style scoped>
.article-container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.article-title {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: #333;
}

.article-image {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.article-image img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
}

.article-details {
    font-size: 1.2rem;
    line-height: 1.6;
    color: #555;
}

.article-info p {
    margin: 10px 0;
}

.article-info strong {
    color: #8B428F;
}
</style>