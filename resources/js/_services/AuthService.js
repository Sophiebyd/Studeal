import Axios from './CallerService';
import { useUserStore } from '@/stores/User';

// requête inscription
export async function register(data) {
    const res = await Axios.post('/register', data);
    return res.data;
}

// requête connexion
export async function authenticate(data) {
    await Axios.get('/sanctum/csrf-cookie', {
        baseURL: '/'
    });

    const res = await Axios.post('/login', data);

    const userStore = useUserStore();
    userStore.setUser(res.data);
    return res.data;
}

// requête supprimer le profil
export const deleteProfil = async () => {
    const userStore = useUserStore();
    await Axios.delete('/users/' + userStore.user.id)
    await Axios.post('/logout')
    userStore.clearUser();  // Réinitialisation du store après suppression
    // Supprimer les cookies csrf + de session
    document.cookie.split(";").forEach((c) => {
        document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/");
    });
};

export async function logout() {
    const userStore = useUserStore();
    await Axios.post('/logout')
    userStore.clearUser();  // Réinitialisation du store après suppression
    // Supprimer les cookies csrf + de session
    document.cookie.split(";").forEach((c) => {
        document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/");
    });
}
