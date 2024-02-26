import { createApp } from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
// import router from './router.js'
import router from './routes'
import VuetifyMask from 'vuetify-mask';

loadFonts()

createApp(App)
  .use(vuetify)
  .use(router)
  .use(VuetifyMask)
  .mount('#app')
