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
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
*/

mix.js('resources/assets/js/app.js', 'public/js');
//.sass('resources/assets/sass/app.scss', '/css');

//mix.copy('public/js/app.js', '/var/www/alert-system/js/app.js');
//mix.copy('public/css/app.css', '/var/www/alert-system/css/app.css');


mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve('resources/assets/sass')
        }
    }
});