import Vue from 'vue'
import Vuetify from 'vuetify'

// vuetify
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
import ru from 'vuetify/es5/locale/ru'


Vue.use(Vuetify, {
	iconfont: 'mdi',
	lang: {
		locales: { ru },
		current: 'ru'
	}
});

export default new Vuetify();