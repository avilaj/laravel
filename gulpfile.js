var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
  console.dir(mix.babel.config);
    mix
    	.sass('app.scss')
    	.babel(['app.js'])
    	.version(['public/css/app.css', 'public/js/all.js']);
});
