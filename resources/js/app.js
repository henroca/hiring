
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('stories', require('./components/stories/Stories.vue').default);
Vue.component('pagination', require('./components/Pagination.vue').default);
Vue.component('story', require('./components/stories/Story.vue').default);
Vue.component('spinner', require('epic-spinners').AtomSpinner);


Vue.filter('host', function (path) {
    if (!path) return '';

    let pathArray = path.split( '/' );
    var protocol = pathArray[0];
    var host = pathArray[2];

    return protocol + '//' + host;
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const App = require('./components/App.vue').default;
const store = require('./store').default;
const router = require('./router').default;

new Vue({
    el: '#app',
    store,
    router,
    render: h => h(App)
});
