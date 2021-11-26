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
    .sass('resources/sass/app.scss', 'public/css').vue();

mix.webpackConfig({
    module: {
        rules: [
            {
                enforce: 'pre', // preを指定することで、付いてないローダーより先に実行できる。
                test: /\.(js|vue)$/,
                loader: 'eslint-loader',
                exclude: /node_modules/,
                options: {
                    fix: true // Lint実行時に自動整形を行うかどうか。（prettierのルールで自動整形してくれる）
                }
            }
        ]
    }
})
