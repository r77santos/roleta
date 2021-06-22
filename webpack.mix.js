const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css')
   .js('resources/js/pages/index.js', 'public/js')
   .js('resources/js/utils/preloader.js', 'public/js')
   .js('resources/js/pages/ganhadores.js', 'public/js')
   .options({
      processCssUrls: false
   });