let mix = require('laravel-mix');
var ex = require('extract-text-webpack-plugin');
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

mix.webpackConfig({
    entry : {
        app : "./resources/assets/js/app.js",
        bootstrap : "./resources/assets/js/bootstrap.js"
    },
    output : {
        filename : 'js/[name].js',
        path : path.resolve(__dirname,'public'),
        publicPath : path.resolve(__dirname,'public')
    }
    // plugins : [
    //     new ex('public/css/[name].css')
    // ]
    // resolve: {
    //     modules: [
    //         path.resolve(__dirname, 'vendor/laravel/spark/resources/assets/js')
    //     ]
    // }
});

mix.sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/admin.scss', 'public/css')
    .copy('resources/assets/img','public/img')
    .copy('resources/assets/fonts','public/fonts');