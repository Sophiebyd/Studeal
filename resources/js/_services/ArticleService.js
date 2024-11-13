import Axios from './CallerService';
import { useUserStore } from '@/stores/User';

// Récupérer tous les articles
export async function getArticles() {
    const res = await Axios.get('/articles');
    return res.data.article;

}
// Récupérer tous les articles_id
export async function getArticleById(articleId) {
    const res = await Axios.get(`/articles/${articleId}`);
    return res.data.article;
    
}

// Récupérer les 10 derniers articles
export async function getLatestArticles() {
    const res = await Axios.get('/latest');
    return res.data.article;
}

// Récupérer les articles de la category_1
export async function getCategory1() {
    const res = await Axios.get('/category_1');
    return res.data.article;
}

// Récupérer les articles de la category_2
export async function getCategory2() {
    const res = await Axios.get('/category_2');
    return res.data.article;
}

// Récupérer les articles de la category_3
export async function getCategory3() {
    const res = await Axios.get('/category_3');
    return res.data.article;
}
// Récupérer les articles de la category_4
export async function getCategory4() {
    const res = await Axios.get('/category_4');
    return res.data.article;
}

// créer un article
export const newArticle = async (data) => {
    const userStore = useUserStore();
    try {
        // Envoyer la requête avec le cookie CSRF et les credentials
        const res = await Axios.post('/newArticle', { ...data, user_id: userStore.user.id }, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'Accept': 'application/json'
            }
        });

        return res.data;
    } catch (error) {
        console.error('Erreur lors de la création de l\'article:', error);
        throw error;
    }
}

// Supprimer un article
export const deleteArticle = async (articleId) => {
    try {
        const res = await Axios.delete(`/articles/${articleId}`);
        return res.data;
    } catch (error) {
        console.error('Erreur lors de la suppression de l\'article:', error);
        throw error;
    }
};