const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = function (env, argv) {
  return {
    entry: './src/index.js',
    mode: env && env.production ? 'production' : 'development',
    output: {
      filename: '[name].app.js',
      path: path.resolve(__dirname, './assets/packed'),
      publicPath: '',
    },
    optimization: {
      splitChunks: {
        chunks: 'all',
      },
    },
    devtool: env && env.production ? 'source-maps' : 'eval',
    plugins: [
      new MiniCssExtractPlugin('style.css'),
    ],
    module: {
      rules: [
        {
          test: /\.scss$/,
          use: [
            MiniCssExtractPlugin.loader,
            'css-loader',
            'postcss-loader',
            'sass-loader',
          ],
        },
        {
          test: /\.(png|svg|jpg|gif)$/,
          use: [
            'file-loader',
          ],
        },
      ],
    },
  };
};
