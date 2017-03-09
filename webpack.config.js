var path = require('path')
var BrowserSyncPlugin = require('browser-sync-webpack-plugin')

module.exports = {
  entry: './js/main.js',
  output: {
    filename: './js/main.min.js'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['es2015']
          }
        }
      }
    ]
  },
  devtool: 'cheap-eval-source-map',
  plugins: [
    new BrowserSyncPlugin({
      host: 'localhost',
      port: 5000,
      proxy: '192.168.33.15',
      open: false
    })
  ]
}
