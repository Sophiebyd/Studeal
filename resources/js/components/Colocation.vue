<template>
    <section class="container my-5">
        <h1 class="text-center mb-4">Colocation</h1>
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
            <input type="text" class="form-control me-3 mb-3 mb-md-0" placeholder="Rechercher une annonce..."
                v-model="searchQuery" style="max-width: 300px;">

            <div class="d-flex align-items-center">
                <select id="sortOptions" class="form-select" v-model="selectedSort" style="max-width: 200px;">
                    <option value="recent">Plus récentes</option>
                    <option value="oldest">Moins récentes</option>
                    <option value="priceAsc">Prix croissants</option>
                    <option value="priceDesc">Prix décroissants</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="title-column">Titre</th>
                        <th>Lieu</th>
                        <th>Prix (€)</th>
                        <th class="date-column">Date de publication</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(ad, index) in filteredAds" :key="index"
                        @click="$router.push({ name: 'Article', params: { id: ad.id } })" style="cursor: pointer;">
                        <td>{{ ad.title }}</td>
                        <td>{{ ad.address }}</td>
                        <td>{{ ad.price }}</td>
                        <td>{{ new Date(ad.created_at).toLocaleDateString('fr-FR') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import * as ArticleService from '../_services/ArticleService';

const ArticlesCategory = ref([]);
const searchQuery = ref('');
const selectedSort = ref('recent');

onMounted(async () => {
    ArticlesCategory.value = await ArticleService.getCategory1();
    console.log(ArticlesCategory.value);
});

const filteredAds = computed(() => {
    let filtered = ArticlesCategory.value.filter(ad =>
        ad.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        ad.address.toLowerCase().includes(searchQuery.value.toLowerCase())
    );

    if (selectedSort.value === 'recent') {
        return filtered.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
    } else if (selectedSort.value === 'oldest') {
        return filtered.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
    } else if (selectedSort.value === 'priceAsc') {
        return filtered.sort((a, b) => a.price - b.price);
    } else if (selectedSort.value === 'priceDesc') {
        return filtered.sort((a, b) => b.price - a.price);
    }
    return filtered;
});
</script>

<style scoped>
.table td,
.table th {
    vertical-align: middle;
}

.table td:nth-child(1),
.table th:nth-child(1) {
    font-size: 0.9rem;
}

h1 {
    font-size: 2rem;
    font-family: 'Arial', sans-serif;
}

.table {
    margin-top: 20px;
}

.table thead th {
    background-color: #EE7F23;
    color: white;
}

.title-column {
    width: 450px;
}

.date-column {
    width: 180px;
}

@media (max-width: 576px) {
    h1 {
        font-size: 1.5rem;
    }

    .form-control,
    .form-select {
        width: 100%;
    }

    .filter-bar {
        margin-top: 10px;
    }
}
</style>