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

/*
 +--------------------------------------------------------------------------
 | webpack.mix.js file holds the configuration files for laravel-mix which provides a wrapper
 | around Webpack. It lets us take advantage of webpack’s amazing asset compilation abilities
 | without having to write Webpack configurations by ourselves.
 */
mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/bootstrap.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');
