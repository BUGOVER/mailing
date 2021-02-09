/** @format */
import { csrf } from './common/bootstrap';

import Vue from 'vue';
import Vuetify from 'vuetify';
import router from './plugins/routes';
import Lodash from 'lodash';
import VeeValidate, { Validator } from 'vee-validate';
import ru from 'vee-validate/dist/locale/ru';

// configure language

Vue.prototype.$lodash = Lodash;
Vue.prototype.$csrf = csrf;

Vue.use(Vuetify, { iconfont: 'mdi' });
Vue.use(VeeValidate, {
    locale: 'ru',
    mode: 'lazy'
});
Validator.localize('ru', ru);
Vue.config.devtools = true;

require('./components/index');
Vue.component('auth', require('./views/Auth').default);

/**
 * Next, we will CreateTariffComponents a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify(),
});
