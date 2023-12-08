import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store';


import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';

import 'primevue/resources/primevue.min.css';
import 'primevue/resources/themes/saga-green/theme.css';
import 'primeicons/primeicons.css';


import './assets/css/tailwind.css';
import '@fortawesome/fontawesome-free/css/all.css';


createApp(App)
.use(PrimeVue).use(ToastService)
.use(store).use(router).mount('#app')
