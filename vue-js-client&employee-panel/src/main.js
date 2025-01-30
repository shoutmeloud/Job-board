import { createApp } from 'vue'
import App from './App.vue'
import router from './routes'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import '@/assets/css/Main/style.css'
import '@/assets/css/Dark/dark.css'
import store from "./store";
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';
import axios from 'axios';
import VueAxios from 'vue-axios';


// Axios request interceptor (this interceptors will sent Authorization Token in header with every api request)
axios.interceptors.request.use((config) => {
    const token = localStorage.getItem('authToken');
    if (token && !config.headers.hasOwnProperty('Authorization')) {
        config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
}, (error) => {
    return Promise.reject(error);
});

// Create a Vue instance
const app=createApp(App);
console.log(app.config);
app.config.globalProperties.$apiUrl = import.meta.env.VITE_VUE_APP_APIURL;
app.use(VueAxios,axios).use(router).use(store).use(ToastPlugin).mount('#app');