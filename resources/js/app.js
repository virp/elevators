require('./bootstrap');

window.Vue = require('vue');

Vue.component('elevators', require('./components/ElevatorsView').default);

const app = new Vue({
    el: '#app'
});

$('#elevator').on('change', (event) => {
    const elevator = $(event.target).val()
    const url = $(event.target).data('url')

    if (elevator) {
        window.location.href = `${url}?elevator=${elevator}`
    } else {
        window.location.href = url
    }
})
