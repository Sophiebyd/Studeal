import { createRouter, createWebHistory } from 'vue-router'

// // Import des composants/pages
import Colocation from '../js/components/Colocation.vue'
import Covoiturage from '../js/components/Covoiturage.vue'
import VenteDeMeubles from '../js/components/VenteDeMeubles.vue' 
import SoutienScolaire from '../js/components/SoutienScolaire.vue'
import Layout from '../views/Layout.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'public',
            component: Layout,
            children: [
                // { path: '', name: 'home', component: Home },
                { path: 'colocation', name: 'Colocation', component: Colocation },
                { path: 'covoiturage', name: 'Covoiturage', component: Covoiturage},
                { path: 'vente-meubles', name: 'VenteDeMeubles', component: VenteDeMeubles},
                { path: 'soutien-scolaire', name: 'SoutienScolaire', component: SoutienScolaire },
            ]
        },
        {
            path: '/:pathMatch(.*)*', redirect: '/'
        }
    ]
});