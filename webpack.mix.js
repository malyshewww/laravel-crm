const mix = require('laravel-mix');
var LiveReloadPlugin = require('webpack-livereload-plugin');

mix.webpackConfig({
    plugins: [new LiveReloadPlugin()]
});
mix.browserSync({
    proxy: 'laravel-crm',
    notify: false,
    online: true,
});
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

mix.js('resources/js/app.js', 'public/js/')
    // .version();
    // .sass('resources/sass/app.scss', 'public/css').options({
    //     processCssUrls: false
    // })
    // .copy('resources/fonts/**/*', 'public/fonts')
    // .copy('resources/images/', 'public/images/', false)
    // .sourceMaps()
    // .version()
