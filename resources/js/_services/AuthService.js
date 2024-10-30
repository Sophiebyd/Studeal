import Axios from './CallerService';
import { useUserStore } from '@/stores/User';

// requête inscription
export async function register(data) {
    const res = await Axios.post('/register', data);
    return res.data;
}

// requête connexion
export async function authenticate(data) {
    // await Axios.get('/sanctum/csrf-cookie', {
    //     baseURL: 'http://localhost:8000/'
    // });

    const res = await Axios.post('/login', data);

    const userStore = useUserStore();
    userStore.setUser({
        id: res.data.id,
        email: res.data.email,
        role: res.data.role.role,
        first_name: res.data.first_name,
        last_name: res.data.last_name,
        birthday: res.data.birthday,
        phone: res.data.phone
    });

    return res.data;
}

// requête modification du profil
export const modification = async () => {
    const userStore = useUserStore();
    await Axios.get('/sanctum/csrf-cookie', {
        baseURL: 'http://localhost:8000/'
    });
    await Axios.put('/users/' + userStore.user.id, {
        first_name: userStore.user.first_name,
        last_name: userStore.user.last_name,
        email: userStore.user.email,
        birthday: userStore.user.birthday,
        phone: userStore.user.phone
    })
    userStore.setUser(response.data.user);
    alert(response.data.message);
}

// requête supprimer le profil
export const deleteProfil = async () => {
    const userStore = useUserStore();
    await Axios.delete('/users/' + userStore.user.id)
    userStore.clearUser();  // Réinitialisation du store après suppression
    // Supprimer les cookies csrf + de session
    document.cookie.split(";").forEach((c) => {
        document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/");
    });
};

export async function logout() {
    // ....
}
