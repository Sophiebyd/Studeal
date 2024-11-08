<template>
    <section class="container my-5">
        <h1 class="text-center mb-4">Administration</h1>

        <!-- Navigation par onglets -->
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <button class="nav-link" :class="{ active: activeTab === 'users' }" @click="activeTab = 'users'">
                    Utilisateurs
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" :class="{ active: activeTab === 'articles' }" @click="activeTab = 'articles'">
                    Articles
                </button>
            </li>
        </ul>

        <!-- Barre de recherche et menu de tri -->
        <div v-if="activeTab === 'users'" class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
            <input type="text" class="form-control me-3 mb-3 mb-md-0" placeholder="Rechercher..." v-model="searchQuery" style="max-width: 300px;">
            <select v-if="activeTab === 'articles'" id="sortOptions" class="form-select" v-model="selectedSort" style="max-width: 200px;">
                <option value="recent">Plus récentes</option>
                <option value="oldest">Moins récentes</option>
            </select>
        </div>

        <div v-if="activeTab === 'articles'" class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
            <input type="text" class="form-control me-3 mb-3 mb-md-0" placeholder="Rechercher..." v-model="articleSearchQuery" style="max-width: 300px;">
            <select id="articleSortOptions" class="form-select" v-model="articleSort" style="max-width: 200px;">
                <option value="recent">Plus récents</option>
                <option value="oldest">Moins récents</option>
                <option value="priceAsc">Prix croissants</option>
                <option value="priceDesc">Prix décroissants</option>
            </select>
        </div>

        <!-- Tableau des utilisateurs -->
        <div v-if="activeTab === 'users'" class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="equal-width">Nom</th>
                        <th class="equal-width">Prénom</th>
                        <th class="equal-width">Email</th>
                        <th class="equal-width">Téléphone</th>
                        <th class="equal-width">Date de naissance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in filteredUsers" :key="index">
                        <td>{{ user.last_name }}</td>
                        <td>{{ user.first_name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.phone }}</td>
                        <td>{{ new Date(user.birthday).toLocaleDateString("fr-FR") }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tableau des articles -->
        <div v-if="activeTab === 'articles'" class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="equal-width">Titre</th>
                        <th class="equal-width">Id_user</th>
                        <th class="equal-width">Prix</th>
                        <th class="equal-width">Date de publication</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(article, index) in filteredArticles" :key="index">
                        <td>{{ article.title }}</td>
                        <td>{{ article.user_id }}</td>
                        <td>{{ article.price }} €</td>
                        <td>{{ new Date(article.created_at).toLocaleDateString("fr-FR") }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import * as UserService from '../_services/UserService';
import * as ArticleService from '../_services/ArticleService';

const activeTab = ref('users'); // Onglet par défaut
const getUsers = ref([]);
const articles = ref([]);
const searchQuery = ref('');
const articleSearchQuery = ref('');
const selectedSort = ref('recent');
const articleSort = ref('recent');

// Charger les utilisateurs
onMounted(async () => {
    getUsers.value = await UserService.getUsers();
    console.log(getUsers.value);

    // Charger les articles
    articles.value = await ArticleService.getArticles();
    console.log(articles.value);
});

// Filtrer et trier les utilisateurs
const filteredUsers = computed(() => {
    let filtered = getUsers.value.filter(user =>
        (user.last_name && user.last_name.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
        (user.first_name && user.first_name.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
        (user.email && user.email.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
        (user.phone && user.phone.toLowerCase().includes(searchQuery.value.toLowerCase()))
    );

    return filtered;
});

// Filtrer et trier les articles
const filteredArticles = computed(() => {
    let filtered = articles.value.filter(article =>
        (article.title && article.title.toLowerCase().includes(articleSearchQuery.value.toLowerCase())) ||
        (article.author && article.author.toLowerCase().includes(articleSearchQuery.value.toLowerCase()))
    );

    if (articleSort.value === 'recent') {
        return filtered.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
    } else if (articleSort.value === 'oldest') {
        return filtered.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
    } else if (articleSort.value === 'priceAsc') {
        return filtered.sort((a, b) => a.price - b.price);
    } else if (articleSort.value === 'priceDesc') {
        return filtered.sort((a, b) => b.price - a.price);
    }
    return filtered;
});
</script>

<style scoped>
.nav-tabs .nav-link {
    cursor: pointer;
}

.table td,
.table th {
    vertical-align: middle;
    text-align: center;
}

.equal-width {
    width: 20%;
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

@media (max-width: 576px) {
    h1 {
        font-size: 1.5rem;
    }

    .form-control,
    .form-select {
        width: 100%;
    }
}
</style>
