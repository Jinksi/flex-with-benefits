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
  devServer: {
    proxy: {
      '/': 'http://flex.dev/'
    }
  }
}
