import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router'
import auth from './store/auth'

auth.initFromStorage()

createApp(App).use(router).mount('#app')
