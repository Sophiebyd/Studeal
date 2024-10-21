import { createRouter, createWebHistory } from 'vue-router'

// // Import des composants/pages
import Home from '../components/Home.vue'
import Colocation from '../components/Colocation.vue'
import Covoiturage from '../components/Covoiturage.vue'
import VenteDeMeubles from '../components/VenteDeMeubles.vue' 
import SoutienScolaire from '../components/SoutienScolaire.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        { path: '/', name: 'Home', component: Home },
        { path: '/colocation', name: 'Colocation', component: Colocation },
        { path: '/covoiturage', name: 'Covoiturage', component: Covoiturage},
        { path: '/vente-meubles', name: 'VenteDeMeubles', component: VenteDeMeubles},
        { path: '/soutien-scolaire', name: 'SoutienScolaire', component: SoutienScolaire },
    ]
});

export default router;