import Axios from './CallerService';

// Récupérer tous les articles
export async function getArticles() {
    const res = await Axios.get('/articles');
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
