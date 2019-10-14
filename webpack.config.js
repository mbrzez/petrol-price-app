const {resolveProjectDir} = require('./project.utils');
const {CleanWebpackPlugin} = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    devtool: '',
    entry: {
        main: resolveProjectDir('resources/assets/js/index.js')
    },
    output: {
        path: resolveProjectDir('public/js')
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                loader: 'babel-loader'
            },
            {
                test: /\.(sass|scss|css)$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ]
            },
            {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[name].[ext]',
                            outputPath: '../fonts'
                        }
                    }
                ]
            }
        ]
    },
    optimization: {
        splitChunks: {
            name: 'vendors',
            chunks: 'all'
        }
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '../css/[name].css'
        }),
        new CleanWebpackPlugin({
            cleanOnceBeforeBuildPatterns: [
                resolveProjectDir('public/js'),
                resolveProjectDir('public/css'),
                resolveProjectDir('public/fonts')
            ]
        })
    ],
    watch: true
};