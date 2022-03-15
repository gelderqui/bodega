const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
 mix.styles([
    'resources/assets/css/styles.css',
], 'public/css/plantilla.css')
.scripts([
    'resources/assets/js/litepicker.js',
    // 'resources/assets/js/markdown.js',
    'resources/assets/js/scripts.js',
    'resources/assets/js/toasts.js',

    //proyecto antes
    'resources/assets/js/inicio/jquery.min.js',
    // 'resources/assets/js/inicio/popper.min.js',
    'resources/assets/js/inicio/bootstrap.min.js',
    'resources/assets/js/inicio/Chart.min.js',
    'resources/assets/js/inicio/pace.min.js',
    'resources/assets/js/inicio/template.js',
    'resources/assets/js/inicio/sweetalert2.all.js'


], 'public/js/plantilla.js')
.js(['resources/js/app.js'],'public/js/app.js')
.vue()
.postCss('resources/css/app.css', 'public/css', [

]);