
const Dotenv = require('dotenv-webpack');
module.exports = {
    publicPath: process.env.VUE_BASE_URL || '/',
    productionSourceMap: false,
    lintOnSave: true,
    // Server Configuration options
    devServer: {
        // .. rest of devserver options
        disableHostCheck: true
    },
    configureWebpack: {
        plugins: [
            new Dotenv(),
        ],
    },

    transpileDependencies: [
        'resize-detector', // vue-echarts
    ]
}