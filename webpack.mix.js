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


//
// mix.styles(['resources/admin/css/dropzone.min.css'], 'public/admin/css/dropzone.min.css')
//     .scripts(['resources/admin/js/dropzone.js'], 'public/admin/js/dropzone.js')
//

mix.styles([
    'resources/backend/css/persianDatepicker-default.css',
    'resources/backend/css/admin.css',
    'resources/backend/css/bootstrap-tagsinput.css',
    'resources/backend/css/dropzone.min.css',
], 'public/css/all-admin.css')
    .scripts([
        'resources/backend/js/bootstrap-tagsinput.min.js',
        'resources/backend/js/dropzone.js',
        'resources/backend/js/persianDatepicker.min.js',
    ], 'public/js/all-admin.js')

mix.styles([
    'resources/frontend/css/persianDatepicker-default.css',
    'resources/backend/css/admin.css',
    'resources/backend/css/bootstrap-tagsinput.css',
    'resources/backend/css/dropzone.min.css',
], 'public/css/all-admin.css')
    .scripts([
        'resources/backend/js/bootstrap-tagsinput.min.js',
        'resources/backend/js/dropzone.js',
        'resources/backend/js/persianDatepicker.min.js',
    ], 'public/js/all-admin.js')


