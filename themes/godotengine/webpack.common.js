const path = require('path');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const webpack = require('webpack');
const ExtractTextPlugin = require("extract-text-webpack-plugin");

module.exports = {
  entry: './src/index.js',
  output: {
    filename: '[name].app.js',
    path: path.resolve(__dirname, './assets/packed'),
    publicPath: ''
  },
  // TODO: Change to something faster in the future
  devtool: 'inline-source-map',
  // TODO: Add webpack-dev-server
  plugins: [
    new CleanWebpackPlugin(['./assets/packed']),
    new webpack.optimize.CommonsChunkPlugin({
      name: 'common' // Specify the bundle name
    }),
    new ExtractTextPlugin('style.css')
  ],
  // TODO: Minimize css/js
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [{
            loader: 'css-loader', options: {
              sourceMap: true,
              minimize: true
            }
          }, {
            loader: 'postcss-loader', options: {
              sourceMap: true
            }
          }, {
            loader: 'sass-loader', options: {
              sourceMap: true
            },

          }],
          // use style loader in development
          fallback: 'style-loader'
        })
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        use: [
          'file-loader'
        ]
      }
    ]
  }
};
