import Axios from './CallerService';
import { useUserStore } from '../stores/User';

// requête pour récupérer les utilisateurs
export async function getUsers(data) {
    const res = await Axios.get('/users', data);
    return res.data.users;
}

// Récupérer un utilisateur par ID
export async function getUserById(userId) {
    const res = await Axios.get(`/users/${userId}`);
    return res.data.user;
}

export async function update(data) {
    const userStore = useUserStore();
    await Axios.get('/sanctum/csrf-cookie', {
        baseURL: '/'
    });
    const res = await Axios.put(`/users/${userStore.user.id}`, data).catch(error => {
        console.error(error);
    })

    return res.data;
}

// requête pour mettre à jour l'image
export const updateWithPicture = async (data) => {
    const userStore = useUserStore();
    const res = await Axios.post(`/newAvatar/${userStore.user.id}`, {...data, _method: 'PUT' }, {
        headers: { 'Content-Type': 'multipart/form-data' }
    });

    return res.data;
}