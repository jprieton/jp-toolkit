const path                   = require("path")
const MiniCssExtractPlugin   = require("mini-css-extract-plugin")
const { CleanWebpackPlugin } = require("clean-webpack-plugin")
const cssnano                = require("cssnano")
const autoprefixer           = require("autoprefixer")

const JS_DIR    = path.resolve(__dirname, "src/js")
const BUILD_DIR = path.resolve(__dirname, "dist")

const entry = {
    "admin-scripts" : JS_DIR + "/admin-scripts.js",
    "admin-styles"  : JS_DIR + "/admin-styles.js",
    "public-scripts": JS_DIR + "/public-scripts.js",
    "public-styles" : JS_DIR + "/public-styles.js",
}
const output = {
    "path"    : BUILD_DIR,
    "filename": "js/[name].js"
}

const rules = [
    {
        "test"   : /\.js$/,
        "include": [JS_DIR],
        "exclude": /node_modules/,
        "use"    : "babel-loader"
    },
    {
        "test"   : /\.(scss|css)$/,
        "exclude": /node_modules/,
        "use"    : [
            MiniCssExtractPlugin.loader,
            {
                loader : 'css-loader',
                options: {
                    importLoaders: 2
                }
            },
            "postcss-loader",
            {
                loader : "sass-loader",
                options: {
                    implementation: require("sass"),
                    sassOptions   : {
                        fiber: false,
                    }
                }
            },
        ]
    },
    {
        "test"   : /\.(svg|png|jpe?g|gif)$/i,
        "exclude": /node_modules/,
        "use"    : [
            {
                loader : 'file-loader',
                options: {
                    name   : '[path][name].[ext]',
                    context: path.resolve(__dirname, "src/"),
                    outputPath: '/',
                    publicPath: '../',
                    useRelativePaths: true
                }
            },
        ]
    },
]

const plugins = (argv) => ([
    new CleanWebpackPlugin({
        "cleanStaleWebpackAssets": ("production" === argv.mode)
    }),
    new MiniCssExtractPlugin({
        "filename": "css/[name].css"
    }),
])

module.exports = (env, argv) => ({
    "entry"  : entry,
    "output" : output,
    "devtool": ("production" === argv.mode) ? false: "source-map",
    "module" : {
        "rules": rules
    },
    "plugins": plugins(argv),
    "stats"  : "verbose"
})