import { ref } from 'vue';
import { defineStore } from 'pinia';
import { getArticle } from '../_services/ArticleService';

export const useArticleStore = defineStore('article', () => {
    const newArticles = ref([]); 
    
    // Fonction pour récupérer les 10 derniers articles
    async function latestArticles() {
        try {
            const data = await getArticle();
            newArticles.value = data.articles.slice(-10).reverse();
        } catch (error) {
            console.error("Erreur lors de la récupération des articles :", error);
        }
    }

    return {
        newArticles,
        latestArticles
    };
});
