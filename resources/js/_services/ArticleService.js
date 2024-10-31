import Axios from './CallerService';

// Récupérer tous les articles
export async function getArticles() {
    const res = await Axios.get('/articles');
    return res.data.article;
}

// Récupérer les 10 derniers articles, triés par date décroissante
export async function getLatestArticles() {
    const res = await Axios.get('/latest');
    return res.data.article;
}
