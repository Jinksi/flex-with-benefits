/*eslint-env node*/

const MinifyPlugin = require('babel-minify-webpack-plugin')
const production = process.env.NODE_ENV === 'production'

const plugins = production ? [
    new MinifyPlugin()
  ] : []

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
  plugins
}
