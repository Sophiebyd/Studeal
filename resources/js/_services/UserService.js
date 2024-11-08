import Axios from './CallerService';

// requête pour récupérer les utilisateurs
export async function getUsers(data) {
    const res = await Axios.get('/users', data);
    return res.data.users;
}
