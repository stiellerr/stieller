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
            //"js/admin": "./src/admin.js",
            //"js/customize-preview": "./src/customize-preview.js",
            //"js/customize-controls": "./src/customize-controls.js",
            //"editor/js/script": "./src/editor/script.js"
        },
        output: {
            path: path.resolve(__dirname, "dist"),
            filename: "[name].js",
            clean: true
        },
        /*
        output: {
            filename: "js/script.js",
            clean: true
        },
        */
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
            /*
            new MiniCssExtractPlugin({
                filename: "css/style.css"
            }),
            */
            new ImageMinimizerPlugin({
                minimizerOptions: {
                    // Lossless optimization with custom option
                    // Feel free to experiment with options for better result for you
                    plugins: [["mozjpeg", { quality: 20 }]]
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
            //underscore: "_",
            lodash: "lodash",
            "@wordpress/block-editor": ["wp", "blockEditor"],
            "@wordpress/rich-text": ["wp", "richText"],
            //"@wordpress/components": ["wp", "components"],
            "@wordpress/i18n": ["wp", "i18n"],
            //"@wordpress/dom": ["wp", "dom"],
            //"@wordpress/primitives": ["wp", "primitives"],
            "@wordpress/element": ["wp", "element"],
            "@wordpress/data": ["wp", "data"],
            "@wordpress/compose": ["wp", "compose"],
            "@wordpress/dom-ready": ["wp", "domReady"]
            //"@wordpress/core-data": ["wp", "coreData"],
            //"@wordpress/blob": ["wp", "blob"],
            //"@wordpress/viewport": ["wp", "viewport"],
            //"@wordpress/primitives": ["wp", "primitives"],
            //"@wordpress/blocks": ["wp", "blocks"],
            //"@wordpress/keycodes": ["wp", "keycodes"],
            //"@wordpress/hooks": ["wp", "hooks"],
            //"@wordpress/plugins": ["wp", "plugins"],
            //"@wordpress/edit-post": ["wp", "editPost"]
        }
    };
};
