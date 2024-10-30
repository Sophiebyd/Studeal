import Axios from './CallerService';
import { useArticleStore } from '../stores/Article';

// récupérer les articles
export async function getArticle() {
    const res = await Axios.get('/articles');

    return res.data;
}