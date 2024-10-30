import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

export const useArticleStore = defineStore('article', () => {
    const article = ref({
        id: -1,
        user_id: -1,
        category_id: -1,
        title: '',
        content: '',
        price: '',
    });

    article.value.id = Number(localStorage.getItem('id'));
    article.value.user_id = Number(localStorage.getItem('user_id'));
    article.value.category_id = Number(localStorage.getItem('category_id'));
    article.value.title = localStorage.getItem('title');
    article.value.content = localStorage.getItem('content');
    article.value.price = localStorage.getItem('price');

    function setArticle(data) {
        article.value.id = data.id;
        article.value.user_id = data.user_id;
        article.value.category_id = data.category_id;
        article.value.title = data.title;
        article.value.content = data.content;
        article.value.price = data.price;
        localStorage.setItem('id', String(data.id));
        localStorage.setItem('user_id', String(data.user_id));
        localStorage.setItem('category_id', String(data.category_id));
        localStorage.setItem('title', String(data.title));
        localStorage.setItem('content', String(data.content));
        localStorage.setItem('price', String(data.price));
    }

    function clearArticle() {
        setArticle({
            id: -1,
            user_id: -1,
            category_id: -1,
            title: '',
            content: '',
            price: '',
        });

        // localStorage.removeItem('id');
        // localStorage.removeItem('user_id');
        // localStorage.removeItem('category_id');
        // localStorage.removeItem('title');
        // localStorage.removeItem('content');
        // localStorage.removeItem('price');
    }

    return {
        article,
        setArticle,
        clearArticle
    }
});
