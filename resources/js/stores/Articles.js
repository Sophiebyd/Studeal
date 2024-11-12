import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

export const useArticlesStore = defineStore('articles', () => {
    const article = ref({
        id: -1,
        title: '',

    });
});


