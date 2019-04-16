import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Stories from './components/stories/Stories.vue';
import Story from './components/Story.vue';
import Error from './components/Error.vue';

const routes = [
    { path: '/', redirect: '/stories/1'},
    { path: '/stories/:page', component: Stories },
    { path: '/story/:id', component: Story },
    { path: '/error', component: Error },
]

export default new VueRouter({ routes });
