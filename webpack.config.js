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
    publicPath: '/wp-content/themes/flex-with-benefits/',
    proxy: {
      '/': 'http://192.168.33.15',
    },
    overlay: true
  }
}
