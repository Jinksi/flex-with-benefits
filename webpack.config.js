var BrowserSyncPlugin = require('browser-sync-webpack-plugin')
var ExtractTextPlugin = require('extract-text-webpack-plugin') // extract the css!

module.exports = {
  entry: {
    main: './js/main.js',
    style:  './scss/style.scss'
  },
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
      }, {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract(['css-loader', 'sass-loader'])
      }
    ]
  },
  devtool: 'source-map',
  plugins: [
    new BrowserSyncPlugin({
      host: 'localhost',
      port: 5000,
      proxy: '192.168.33.15',
      open: false
    }),
    new ExtractTextPlugin({
      filename: './style.css',
      allChunks: true
    })
  ]
}
