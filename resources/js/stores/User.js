import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', () => {
  const user = ref({
    id: -1,
    email: '',
    role: '',
    first_name: '',
    last_name: '',
    birthday: '',
    phone: '',
  });

  user.value.id = Number(localStorage.getItem('id'));
  user.value.email = localStorage.getItem('email');
  user.value.first_name = localStorage.getItem('first_name');
  user.value.last_name = localStorage.getItem('last_name');
  user.value.birthday = localStorage.getItem('birthday');
  user.value.phone = localStorage.getItem('phone');
  user.value.role = localStorage.getItem('role');

  const isLogged = computed(() => {
    return !!user.value.email;
  });

  //insère les données utilisateurs dans le store
  function setUser(data) {
    user.value.id = data.id;
    user.value.email = data.email;
    user.value.role = data.role ? data.role.role : '';
    user.value.first_name = data.first_name;
    user.value.last_name = data.last_name;
    user.value.birthday = data.birthday;
    user.value.phone = data.phone;
    localStorage.setItem('id', String(data.id));
    localStorage.setItem('email', data.email ?? '');
    localStorage.setItem('role', user.value.role);
    localStorage.setItem('first_name', data.first_name ?? '');
    localStorage.setItem('last_name', data.last_name ?? '');
    localStorage.setItem('birthday', data.birthday ?? '');
    localStorage.setItem('phone', data.phone ?? '');
  }

  function clearUser() {
    setUser({
      id: -1,
      email: '',
      role: '',
      first_name: '',
      last_name: '',
      birthday: '',
      phone: '',
    });

    // localStorage.removeItem('id');
    // localStorage.removeItem('email');
    // localStorage.removeItem('first_name');
    // localStorage.removeItem('last_name');
    // localStorage.removeItem('birthday');
    // localStorage.removeItem('phone');
  }

  return {
    user,
    isLogged,
    setUser,
    clearUser
  };
});