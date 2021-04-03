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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/dashboard/app.js', 'public/js/dashboard')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/dashboard/app.scss', 'public/css/dashboard')
    // .postCss('resources/css/dashboard/app.css', 'public/css/dashboard', [
    //     require('postcss-import'),
    //     require('tailwindcss'),
    //     require('autoprefixer'),
    // ])
    .sourceMaps();
