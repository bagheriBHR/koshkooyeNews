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



mix.styles(['resources/backend/css/dropzone.min.css'], 'public/backend/css/dropzone.min.css')
    .scripts(['resources/backend/js/dropzone.js'], 'public/backend/js/dropzone.js')

mix.styles(['resources/backend/css/persianDatepicker-default.css'], 'public/backend/css/persianDatepicker-default.css')
    .scripts(['resources/backend/js/persianDatepicker.min.js'], 'public/backend/js/persianDatepicker.min.js')

mix.styles(['resources/backend/css/bootstrap-tagsinput.css'], 'public/backend/css/bootstrap-tagsinput.css')
    .scripts(['resources/backend/js/bootstrap-tagsinput.min.js'], 'public/backend/js/bootstrap-tagsinput.min.js')


mix.styles([
    'resources/backend/css/admin.css',
], 'public/backend/css/admin.css')


mix.styles([
    'resources/frontend/css/style.css',
], 'public/css/all-frontend.min.css')



