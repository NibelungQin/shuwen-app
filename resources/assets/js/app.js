
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('question-follow-button',require('./components/questionfollowbutton'));
Vue.component('comments',require('./components/Comments'));
Vue.component('user-vote-button',require('./components/UserVoteButton'));
Vue.component('user-follow-button',require('./components/UserFollowButton'));
Vue.component('send-message',require('./components/SendMessage'));
Vue.component('user-avatar', require('./components/Avatar.vue'));

const app = new Vue({
    el: '#app'
});
