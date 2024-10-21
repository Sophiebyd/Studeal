import { createApp } from 'vue';
import App from './App.vue';  
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import '../css/app.css';
import 'ant-design-vue/dist/reset.css';
import router from './router'
import { createPinia } from 'pinia';

const app = createApp(App);
app.use(createPinia());
app.use(router).mount('#app');
