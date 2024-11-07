import Axios from './CallerService';

// Récupérer toutes les catégories
export async function getCategories() {
    const res = await Axios.get('/article_categories');
    return res.data;
    
}