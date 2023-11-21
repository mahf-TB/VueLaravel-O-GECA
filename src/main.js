import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store';
import PrimeVue from 'primevue/config';

import './assets/css/tailwind.css';
import '@fortawesome/fontawesome-free/css/all.css';


createApp(App).use(PrimeVue).use(store).use(router).mount('#app')
