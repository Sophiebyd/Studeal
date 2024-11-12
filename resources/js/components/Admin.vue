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
                <button class="nav-link" :class="{ active: activeTab === 'colocation' }"
                    @click="activeTab = 'colocation'">
                    Colocation
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" :class="{ active: activeTab === 'covoiturage' }"
                    @click="activeTab = 'covoiturage'">
                    Covoiturage
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" :class="{ active: activeTab === 'vente' }" @click="activeTab = 'vente'">
                    Vente
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" :class="{ active: activeTab === 'soutien' }" @click="activeTab = 'soutien'">
                    Soutien
                </button>
            </li>
        </ul>

        <!-- Barre de recherche et menu de tri -->
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
            <input type="text" class="form-control me-3 mb-3 mb-md-0" placeholder="Rechercher..." v-model="searchQuery"
                style="max-width: 300px;">
            <select class="form-select" v-model="selectedSort" style="max-width: 200px;">
                <option value="recent">Plus récents</option>
                <option value="oldest">Moins récents</option>
                <option v-if="activeTab !== 'users'" value="priceAsc">Prix croissants</option>
                <option v-if="activeTab !== 'users'" value="priceDesc">Prix décroissants</option>
            </select>
        </div>

        <!-- Modale de confirmation de suppression -->
        <div v-if="showDeleteModal" class="modal" tabindex="-1"
            style="display: block; background-color: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation de suppression</h5>
                        <button type="button" class="btn-close" @click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous supprimer l'article "<strong>{{ selectedArticle.title }}</strong>" ? Cette action
                            est irréversible.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="confirmDelete">Oui</button>
                        <button type="button" class="btn btn-secondary" @click="closeModal">Non</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des utilisateurs -->
        <div v-if="activeTab === 'users'" class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="equal-width">Utilisateur</th>
                        <th class="equal-width">Email</th>
                        <th class="equal-width">Téléphone</th>
                        <th class="equal-width">Date de naissance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in filteredUsers" :key="index">
                        <td>
                            <router-link :to="`/profil/${user.id}`" class="text-decoration-none">
                                {{ user.first_name }} {{ user.last_name }}
                            </router-link>
                        </td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.phone }}</td>
                        <td>{{ new Date(user.birthday).toLocaleDateString('fr-FR') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tableau des articles de la catégorie 1 -->
        <div v-if="activeTab === 'colocation'" class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="equal-width">Titre</th>
                        <th class="equal-width">Utilisateur</th>
                        <th class="equal-width">Prix</th>
                        <th class="equal-width">Date de publication</th>
                        <th class="equal-width"></th> <!-- Colonne pour le bouton de suppression -->
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(article, index) in filteredCategory1" :key="index">
                        <td>
                            <router-link :to="`/article/${article.id}`" class="text-decoration-none">
                                {{ article.title }}
                            </router-link>
                        </td>
                        <td>{{ getUserFullName(article.user_id) }}</td>
                        <td>{{ article.price }} €</td>
                        <td>{{ new Date(article.created_at).toLocaleDateString('fr-FR') }}</td>
                        <td>
                            <button class="btn btn-danger" @click="openDeleteModal(article)">
                                <img src="../../../public/img/trash_icon.png" alt="Supprimer"
                                    style="width: 24px; height: 24px;">
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tableau des articles de la catégorie 2 -->
        <div v-if="activeTab === 'covoiturage'" class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="equal-width">Titre</th>
                        <th class="equal-width">Utilisateur</th>
                        <th class="equal-width">Prix</th>
                        <th class="equal-width">Date de publication</th>
                        <th class="equal-width"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(article, index) in filteredCategory2" :key="index">
                        <td>
                            <router-link :to="`/article/${article.id}`" class="text-decoration-none">
                                {{ article.title }}
                            </router-link>
                        </td>
                        <td>{{ getUserFullName(article.user_id) }}</td>
                        <td>{{ article.price }} €</td>
                        <td>{{ new Date(article.created_at).toLocaleDateString('fr-FR') }}</td>
                        <td>
                            <button class="btn btn-danger" @click="openDeleteModal(article)">
                                <img src="../../../public/img/trash_icon.png" alt="Supprimer"
                                    style="width: 24px; height: 24px;">
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tableau des articles de la catégorie 3 -->
        <div v-if="activeTab === 'vente'" class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="equal-width">Titre</th>
                        <th class="equal-width">Utilisateur</th>
                        <th class="equal-width">Prix</th>
                        <th class="equal-width">Date de publication</th>
                        <th class="equal-width"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(article, index) in filteredCategory3" :key="index">
                        <td>
                            <router-link :to="`/article/${article.id}`" class="text-decoration-none">
                                {{ article.title }}
                            </router-link>
                        </td>
                        <td>{{ getUserFullName(article.user_id) }}</td>
                        <td>{{ article.price }} €</td>
                        <td>{{ new Date(article.created_at).toLocaleDateString('fr-FR') }}</td>
                        <td>
                            <button class="btn btn-danger" @click="openDeleteModal(article)">
                                <img src="../../../public/img/trash_icon.png" alt="Supprimer"
                                    style="width: 24px; height: 24px;">
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tableau des articles de la catégorie 4 -->
        <div v-if="activeTab === 'soutien'" class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="equal-width">Titre</th>
                        <th class="equal-width">Utilisateur</th>
                        <th class="equal-width">Prix</th>
                        <th class="equal-width">Date de publication</th>
                        <th class="equal-width"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(article, index) in filteredCategory4" :key="index">
                        <td>
                            <router-link :to="`/article/${article.id}`" class="text-decoration-none">
                                {{ article.title }}
                            </router-link>
                        </td>
                        <td>{{ getUserFullName(article.user_id) }}</td>
                        <td>{{ article.price }} €</td>
                        <td>{{ new Date(article.created_at).toLocaleDateString('fr-FR') }}</td>
                        <td>
                            <button class="btn btn-danger" @click="openDeleteModal(article)">
                                <img src="../../../public/img/trash_icon.png" alt="Supprimer"
                                    style="width: 24px; height: 24px;">
                            </button>
                        </td>
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
import { deleteArticle } from '../_services/ArticleService';

const activeTab = ref('users'); // Onglet par défaut

const getUsers = ref([]);
const category1 = ref([]);
const category2 = ref([]);
const category3 = ref([]);
const category4 = ref([]);
const searchQuery = ref('');
const selectedSort = ref('recent');

const showDeleteModal = ref(false);
const selectedArticle = ref(null);

onMounted(async () => {
    getUsers.value = await UserService.getUsers();
    category1.value = await ArticleService.getCategory1();
    category2.value = await ArticleService.getCategory2();
    category3.value = await ArticleService.getCategory3();
    category4.value = await ArticleService.getCategory4();
});

// Fonction pour obtenir le nom complet de l'utilisateur à partir de l'ID
const getUserFullName = (userId) => {
    const user = getUsers.value.find(user => user.id === userId);
    return user ? `${user.first_name} ${user.last_name}` : 'Utilisateur inconnu';
};

// Fonction pour ouvrir la modale de suppression
const openDeleteModal = (article) => {
    selectedArticle.value = article;
    showDeleteModal.value = true;
};

// Fonction pour fermer la modale de suppression
const closeModal = () => {
    showDeleteModal.value = false;
    selectedArticle.value = null;
};

// Fonction pour confirmer la suppression
const confirmDelete = async () => {
    if (selectedArticle.value) {
        try {
            await deleteArticle(selectedArticle.value.id);
            console.log(`Article supprimé: ${selectedArticle.value.title}`);
            switch (activeTab.value) {
                case 'colocation':
                    category1.value = category1.value.filter(article => article.id !== selectedArticle.value.id);
                    break;
                case 'covoiturage':
                    category2.value = category2.value.filter(article => article.id !== selectedArticle.value.id);
                    break;
                case 'vente':
                    category3.value = category3.value.filter(article => article.id !== selectedArticle.value.id);
                    break;
                case 'soutien':
                    category4.value = category4.value.filter(article => article.id !== selectedArticle.value.id);
                    break;
            }
        } catch (error) {
            console.error('Erreur lors de la suppression de l\'article:', error);
        }
        closeModal();
    }
};

// Fonction de filtrage des données
const filteredData = (data, type = 'article') => {
    let filtered;
    if (type === 'user') {
        filtered = data.filter(user =>
            (`${user.first_name} ${user.last_name}`.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
            (user.email && user.email.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
            (user.phone && user.phone.toLowerCase().includes(searchQuery.value.toLowerCase()))
        );
    } else {
        filtered = data.filter(item =>
            (item.title && item.title.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
            (item.user_id && getUserFullName(item.user_id).toLowerCase().includes(searchQuery.value.toLowerCase()))
        );
    }

    if (selectedSort.value === 'recent') {
        return filtered.sort((a, b) => new Date(b.created_at || b.birthday) - new Date(a.created_at || a.birthday));
    } else if (selectedSort.value === 'oldest') {
        return filtered.sort((a, b) => new Date(a.created_at || a.birthday) - new Date(b.created_at || b.birthday));
    } else if (selectedSort.value === 'priceAsc') {
        return filtered.sort((a, b) => a.price - b.price);
    } else if (selectedSort.value === 'priceDesc') {
        return filtered.sort((a, b) => b.price - a.price);
    }
    return filtered;
};

// Correction pour les `computed`
const filteredUsers = computed(() => filteredData(getUsers.value, 'user'));
const filteredCategory1 = computed(() => filteredData(category1.value));
const filteredCategory2 = computed(() => filteredData(category2.value));
const filteredCategory3 = computed(() => filteredData(category3.value));
const filteredCategory4 = computed(() => filteredData(category4.value));

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

.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-dialog {
    max-width: 500px;
}

.modal-content {
    background-color: white;
    padding: 1rem;
    border-radius: 0.5rem;
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
