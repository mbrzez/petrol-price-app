const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { resolveProjectDir } = require('./project.utils');

module.exports = {
    entry: resolveProjectDir('resources/assets/js/index.js'),
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
                    {
                        loader: 'css-loader'
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true,
                        }
                    }
                ],
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '../css/[name].css'
        }),
    ],
    watch: true
};