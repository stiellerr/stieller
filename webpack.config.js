"use strict";

const autoprefixer = require("autoprefixer");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const ESLintPlugin = require("eslint-webpack-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const ImageMinimizerPlugin = require("image-minimizer-webpack-plugin");
const path = require("path");

module.exports = (a, b) => {
    return {
        entry: {
            "js/script": "./src/index.js",
            "js/admin": "./src/admin.js",
            "editor/js/script": "./src/editor/script.js"
        },
        output: {
            path: path.resolve(__dirname, "dist"),
            filename: "[name].js",
            clean: true
        },
        optimization: {
            minimizer: [new TerserPlugin(), new CssMinimizerPlugin()]
        },
        devtool: b.mode === "development" && "inline-source-map",
        plugins: [
            new ESLintPlugin(),
            new MiniCssExtractPlugin({
                filename: ({ chunk }) => {
                    return `${chunk.name.replace("script", "style").replace("js", "css")}.css`;
                }
            }),
            new ImageMinimizerPlugin({
                minimizerOptions: {
                    // Lossless optimization with custom option
                    // Feel free to experiment with options for better result for you
                    plugins: [
                        //["mozjpeg", { quality: 80 }]
                        ["jpegtran", { progressive: true }],
                        ["optipng", { optimizationLevel: 5 }]
                    ]
                }
            })
        ],
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    use: [
                        {
                            loader: "babel-loader"
                        }
                    ]
                },
                {
                    test: /\.(sa|sc|c)ss$/i,
                    use: [
                        {
                            loader: MiniCssExtractPlugin.loader
                        },
                        "css-loader",
                        {
                            loader: "postcss-loader",
                            options: {
                                postcssOptions: {
                                    plugins: [autoprefixer()]
                                }
                            }
                        },
                        "sass-loader"
                    ]
                },
                {
                    test: /\.(woff|woff2|eot|ttf|otf|svg)$/i,
                    type: "asset/resource",
                    generator: {
                        filename: "fonts/[name][ext]"
                    }
                },
                {
                    test: /\.(png|jpe?g|gif)$/i,
                    loader: "file-loader",
                    options: {
                        name: "img/[name].[ext]"
                    }
                }
            ]
        },
        externals: {
            jquery: "jQuery",
            lodash: "lodash",
            "@wordpress/block-editor": ["wp", "blockEditor"],
            "@wordpress/rich-text": ["wp", "richText"],
            "@wordpress/i18n": ["wp", "i18n"],
            "@wordpress/element": ["wp", "element"],
            "@wordpress/data": ["wp", "data"],
            "@wordpress/compose": ["wp", "compose"],
            "@wordpress/dom-ready": ["wp", "domReady"]
        }
    };
};
