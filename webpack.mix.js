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
    .sass('resources/sass/app.scss', 'public/css');

// mix.js('resources/js/app.js', 'public/admin/js');
//
// mix.styles(['resources/admin/css/dropzone.min.css'], 'public/admin/css/dropzone.min.css')
//     .scripts(['resources/admin/js/dropzone.js'], 'public/admin/js/dropzone.js')
//
// mix.styles(['resources/admin/css/persianDatepicker-default.css'], 'public/admin/css/persianDatepicker-default.css')
//     .scripts(['resources/admin/js/persianDatepicker.min.js'], 'public/admin/js/persianDatepicker.min.js')
//
// mix.styles(['resources/admin/css/admin.css'], 'public/admin/css/admin.css')

