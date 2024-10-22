import Axios from './CallerService';
import { useUserStore } from '@/stores/User';

export async function register(data) {
    const res = await Axios.post('/register', data);
    return res.data;
}

export async function authenticate(data) {
    const res = await Axios.post('/login', data, {
        baseURL: 'http://localhost:8000'
    });

    const userStore = useUserStore();
    userStore.setUser({
        id: res.data.id,
        email: res.data.email,
        role: res.data.role.role
    });

    return res.data;
}