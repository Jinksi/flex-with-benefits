/*eslint-env node*/

const MinifyPlugin = require('babel-minify-webpack-plugin')

module.exports = {
  output: {
    filename: 'main.min.js'
  },
  devtool: 'source-map',
  module: {
    rules: [{
      test: /\.js/,
      exclude: /(node_modules|bower_components)/,
      use: [
        'babel-loader',
        'eslint-loader'
      ]
    }]
  },
  plugins: [
    new MinifyPlugin()
  ]
}
