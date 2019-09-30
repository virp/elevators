require('./bootstrap');

window.Vue = require('vue');

Vue.component('elevators', require('./components/ElevatorsView').default);

const app = new Vue({
    el: '#app'
});
