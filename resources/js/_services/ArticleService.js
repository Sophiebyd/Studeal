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
    console.log(res.data.article);
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
    const res = await Axios.post('/newArticle', {...data, user_id: userStore.user.id}, 
        {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }
    )

    return res.data;
}