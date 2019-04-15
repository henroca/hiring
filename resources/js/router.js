import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Stories from './components/Stories.vue';

const routes = [
    { path: '/', redirect: '/stories/1'},
    { path: '/stories/:page', component: Stories },
]

export default new VueRouter({ routes });
