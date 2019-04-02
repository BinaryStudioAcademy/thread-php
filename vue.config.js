module.exports = {
    lintOnSave: true,
    publicPath: '/',
    outputDir: 'frontend/dist',
    indexPath: 'index.html',
    configureWebpack: {
        resolve: {
            alias: {
                '@': __dirname + '/frontend/src'
            }
        },
        entry: {
            app: './frontend/src/main.js'
        }
    },
    chainWebpack: config => {
        config.plugin('copy').tap(([options]) => {
            options[0].from = 'frontend/public'
        })
    }
}