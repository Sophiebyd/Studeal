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
    console.log(res);
    return res.data.user;
}

// requête pour mettre à jour l'image
export const newAvatar = async (data) => {
    const userStore = useUserStore();
    const res = await Axios.put('/newAvatar', {...data, user_id: userStore.user.id}, 
        {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }
    )

    return res.data;
}