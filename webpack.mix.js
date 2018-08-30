let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// admin
mix.styles([
    'resources/assets/admin/css/bootstrap.min.css',
    'resources/assets/admin/css/fonts/font-awesome.css',
    'resources/assets/admin/css/animate.css',
    'resources/assets/admin/css/style.css',
    'resources/assets/admin/css/forms/kforms.css',
    'resources/assets/admin/css/mainStyle.css'
], 'public/admin/css/adminIndex.css');

mix.scripts([
    'resources/assets/admin/js/jquery-2.1.1.js',
    'resources/assets/admin/js/bootstrap.min.js',
    'resources/assets/admin/js/metisMenu/jquery.metisMenu.js',
    'resources/assets/admin/js/slimscroll/jquery.slimscroll.min.js',
    'resources/assets/admin/js/main.js'
], 'public/admin/js/adminIndex.js');

mix.copy('resources/assets/admin/fonts', 'public/fonts');

// front
mix.styles([
    'resources/assets/front/css/bootstrap.css',
    'resources/assets/front/css/bootstrap-theme.min.css',
    'resources/assets/front/css/animate.css',
    'resources/assets/front/css/font-awesome.css',
    'resources/assets/front/css/font.css',
    'resources/assets/front/css/style.css',
    'resources/assets/front/css/mainStyle.css'
], 'public/front/css/frontIndex.css');

mix.scripts([
    'resources/assets/front/js/jquery-1.12.3.min.js',
    'resources/assets/front/js/bootstrap.js',
    'resources/assets/front/js/mainScript.js'
], 'public/front/js/frontIndex.js');

mix.copy('resources/assets/front/fonts', 'public/fonts');
mix.copy('resources/assets/front/img', 'public/front/img');