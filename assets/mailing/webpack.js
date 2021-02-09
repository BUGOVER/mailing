/** @format */

const mix = require('laravel-mix');
const CompressionPlugin = require('compression-webpack-plugin');

mix.js('assets/mailing/app.js', 'public/mailing/js/app.js')
    .sass('assets/mailing/sass/app.scss', 'public/mailing/css/app.css')
    .webpackConfig({
        output: {
            chunkFilename: 'mailing/chunk/[name].js',
        },
        module: {
            rules: [
                {
                    test: /\.html$/i,
                    loader: 'html-loader',
                    options: {
                        attributes: false,
                    },
                },
                {
                    test: /\.sass$/,
                    use: [
                        'vue-style-loader',
                        'css-loader',
                        {
                            loader: 'sass-loader',
                            options: {
                                indentedSyntax: true,
                                sassOptions: {
                                    indentedSyntax: true,
                                },
                            },
                        },
                    ],
                },
            ],
        },
    })
    .options({
        processCssUrls: true,
        imgLoaderOptions: {
            enabled: false,
        },
    })
    .sourceMaps();
