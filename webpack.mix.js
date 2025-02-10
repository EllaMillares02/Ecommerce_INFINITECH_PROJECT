const mix = require('laravel-mix');

// Compiling JavaScript
mix.js('home/js/main.js', 'public/js')
   
   // Compiling Sass
   .sass('home/sass/style.scss', 'public/home/css')
   
   // Set to false if you don't want to process URLs in CSS
   .options({
       processCssUrls: false,
   })

   .version();
