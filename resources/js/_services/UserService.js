import Axios from './CallerService';
import { useUserStore } from '../stores/User';

// requête pour récupérer les utilisateurs
export async function getUsers(data) {
    const res = await Axios.get('/users', data);
    return res.data.users;
}

// requête pour mettre à jour l'image
export const newAvatar = async (data) => {
    const userStore = useUserStore();
    const res = await Axios.patch('/newAvatar', {...data, user_id: userStore.user.id}, 
        {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }
    )

    return res.data;
}