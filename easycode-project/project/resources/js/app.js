import './bootstrap';
import {createApp} from 'vue';
import router from "./router/router.js";
import App from "./views/layouts/App.vue";

createApp(App).use(router).mount('#app');
