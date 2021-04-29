import Vuelidate from 'vuelidate'

require('./bootstrap');

window.Vue = require('vue').default;

import CurrencyAPI from './components/CurrencyAPI'

const app = new Vue({

    el: '#currency',
    render: h => h(CurrencyAPI)
});
