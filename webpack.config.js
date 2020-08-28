const path = require("path");
const webpack = require("webpack");
const webpack_dashboard = require("webpack-dashboard/plugin");

let entryfile = "./assets/js/index.js";
let bundlefile = "./bundle.js";
let publicfolder = "./public";

let mode = "development";

let config = {
    mode: mode,
    entry: entryfile,
    output: {
        path: path.resolve(__dirname, publicfolder),
        filename: bundlefile
    },
    plugins: [new webpack_dashboard()],
    module: {
        rules: [{
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader"
                }
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader']
            },
            {
                test: /\.scss$/,
                use: ['style-loader', 'css-loader', 'sass-loader']
            }
        ]
    }
};

module.exports = config;