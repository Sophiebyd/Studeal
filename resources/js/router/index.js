import { createRouter, createWebHistory } from 'vue-router'

// // Import des composants/pages
import Home from '../components/Home.vue'
import Colocation from '../components/Colocation.vue'
import Covoiturage from '../components/Covoiturage.vue'
import VenteDeMeubles from '../components/VenteDeMeubles.vue' 
import SoutienScolaire from '../components/SoutienScolaire.vue'
import Profil from '../components/Profil.vue'
import Contact from '../components/Contact.vue'
import Condition from '../components/Condition.vue'
import Admin from '../components/Admin.vue'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        { path: '/', name: 'Home', component: Home },
        { path: '/colocation', name: 'Colocation', component: Colocation },
        { path: '/covoiturage', name: 'Covoiturage', component: Covoiturage},
        { path: '/vente-meubles', name: 'VenteDeMeubles', component: VenteDeMeubles},
        { path: '/soutien-scolaire', name: 'SoutienScolaire', component: SoutienScolaire },
        { path: '/profil', name: 'Profil', component: Profil },
        { path: '/contact', name: 'Contact', component: Contact },
        { path: '/condition', name: 'Condition', component: Condition },
        { path: '/admin', name: 'Admin', component: Admin },
    ]
});

export default router;