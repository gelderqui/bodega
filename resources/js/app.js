require('./bootstrap');
window.$ = window.jQuery = require('jquery');

// window.Vue = require('vue');
import Vue from 'vue'

import Producto from './components/Producto.vue';
import Proveedor from './components/Proveedor.vue';
import Usuario from './components/Usuario.vue';
import Factura from './components/Factura.vue';

Vue.component('producto', Producto);
Vue.component('proveedor', Proveedor);
Vue.component('usuario', Usuario);
Vue.component('factura', Factura);

const app = new Vue({
    el: '#app',
    data :{
        menu : 0,
        //ruta: 'http://panaderia.atwebpages.com/public_html'
        //   ruta: 'http://localhost:80/principal/7bodega/public'
         //ruta: 'http://192.168.0.105:80/sistemaprestamo/public'
         ruta: 'https://bodega.panaderiashaddai.com/public'
    }
});

