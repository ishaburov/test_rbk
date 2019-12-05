import Vue from 'vue';
import App from './App.vue';
import router from './router';
import vuetify from './modules/vuetify';
import store from './store/index';
import WebFont from 'webfontloader';



WebFont.load({google: {families: ['Nunito']}});
Vue.config.productionTip = false;

new Vue({
  store,
  vuetify,
  router,
  render: h => h(App)
}).$mount('#app');
