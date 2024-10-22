import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', () => {
  const user = ref({
    id: -1,
    email: '',
    role: ''
  });

  user.value.id = Number(localStorage.getItem('id'));
  user.value.email = localStorage.getItem('email');
  user.value.role = localStorage.getItem('role');

  const isLogged = computed(() => {
    return !!user.value.email;
  });

  function setUser(data) {
    user.value.id = data.id;
    user.value.email = data.email;
    user.value.role = data.role;
    localStorage.setItem('id', String(data.id));
    localStorage.setItem('email', data.email ?? '');
    localStorage.setItem('role', data.role ?? '');
  }

  function clearUser() {
    setUser({
      id: -1,
      email: '',
      role: ''
    });
    
    // localStorage.removeItem('id');
    // localStorage.removeItem('email');
    // localStorage.removeItem('role');
  }

  return {
    user,
    isLogged,
    setUser,
    clearUser
  };
});