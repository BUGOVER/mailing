/** @format */

import Vue from 'vue';
import Router from 'vue-router';
import Mailing from '../views/Mailing';

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.MIX_APP_CORPORATE_URL,
    routes: [{ path: '/mailings', component: Mailing }],
});
