

require('./bootstrap');

window.Vue = require('vue');

import VeeValidate from 'vee-validate';

const config = {
    errorBagName: 'val_errors',
    events: '',
};

Vue.use(VeeValidate, config);


Vue.component('todo', require('./components/Todo.vue'));

const app = new Vue({
    el: '#app'
});
