import { createApp } from 'vue'
import axios from 'axios'
import router from './router'
import App from './components/App.vue'

const app = createApp(App)

// Make axios available globally
app.config.globalProperties.$axios = axios

app.use(router)
app.mount('#app')