const mix = require('laravel-mix');

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
 mix.webpackConfig({
    stats: {
        children: true,
    },});
mix.js('assets/js/app.js', 'public/js/lara-admin.js')
    .sass('assets/sass/app.scss', 'public/css/lara-admin.css');