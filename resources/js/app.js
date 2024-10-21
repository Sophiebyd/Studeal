import { createApp } from 'vue';
import HomePage from '../views/Layout.vue';  
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import '../css/app.css';
import router from './router'

createApp(HomePage).use(router).mount('#app');
