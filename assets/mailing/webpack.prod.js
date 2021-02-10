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
                        attributes: [':data'],
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
        plugins: [
            new CompressionPlugin({
                algorithm: 'gzip',
                test: /\.js$|\.css$|\.html$|\.jp2$|\.svg$/,
                threshold: 10240,
                minRatio: 1,
            }),
        ],
    })
    .options({
        processCssUrls: true,
        purifyCss: false,
        extractVueStyles: false,
        imgLoaderOptions: {
            enabled: false,
        },
        uglify: {
            uglifyOptions: {
                compress: {
                    drop_debugger: true,
                    sequences: true,
                    booleans: true,
                    loops: true,
                    unused: true,
                    warnings: false,
                    drop_console: true,
                    unsafe: true,
                },
            },
        },
    })
    .version();
