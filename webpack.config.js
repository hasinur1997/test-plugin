const path = require('path');
const { VueLoaderPlugin } = require('vue-loader');
const isProductionMode = process.env.NODE_ENV === 'production';

module.exports = {
    mode: isProductionMode ? 'production' : 'development',
    entry: './src/main.js',
    output: {
        path: path.resolve(__dirname, './assets/js'),
        filename: 'main.js'
    },

    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: 'babel-loader'
            },
            {
                test: /\.vue$/,
                use: 'vue-loader'
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader']
            },
            {
                test: /\.less$/i,
                use: [
                  // compiles Less to CSS
                  "vue-style-loader",
                  "css-loader",
                  "less-loader",
                ],
            },
        ]
    },

    plugins: [
        new VueLoaderPlugin(),
    ]
}