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

mix.copyDirectory('node_modules/font-awesome/fonts', 'public/storage/siec/dist/fonts/font-awesome');
mix.copyDirectory('resources/assets/sass/fonts', 'public/storage/siec/dist/fonts');
mix.copyDirectory('node_modules/bootstrap/dist/fonts', 'public/storage/siec/dist/fonts/bootstrap');
mix.copyDirectory('resources/assets/images', 'public/storage/siec/dist/images');
mix.copyDirectory('resources/assets/apk', 'public/storage/siec/dist/apk');
mix.copyDirectory('resources/assets/js/plugins/signature/signature_pad.min.js', 'public/storage/siec/dist/js');
mix.sass('resources/assets/sass/app.scss', 'public/storage/siec/dist/css/app.css').options({
   processCssUrls: false
});

mix.js([
   'resources/assets/js/app.js',
   'resources/assets/js/plugins/slimscroll/jquery.slimscroll.min.js',
   'resources/assets/js/inspinia.js',
   'resources/assets/js/plugins/iCheck/icheck.min.js',
   'resources/assets/js/plugins/datapicker/bootstrap-datepicker.js',
   'resources/assets/js/plugins/jasny/jasny-bootstrap.min.js',
   'resources/assets/js/adicional.js'
  ], 'public/storage/siec/dist/js/app.js');
if (mix.inProduction()) {
   mix.version();
}
//Scripts para Talento Humano
//mix.copy('resources/assets/js/siec/tthh/adduser.js', 'public/storage/siec/dist/js/tthh/adduser.js');
