const path                   = require("path")
const MiniCssExtractPlugin   = require("mini-css-extract-plugin")
const { CleanWebpackPlugin } = require("clean-webpack-plugin")
// const cssnano                = require("cssnano")
// const autoprefixer           = require("autoprefixer")

const JS_DIR    = path.resolve(__dirname, "src/js")
const BUILD_DIR = path.resolve(__dirname, "dist")

const entry = {
	"admin"  : [JS_DIR + "/admin-scripts.js", JS_DIR + "/admin-styles.js"],
	"scripts": [JS_DIR + "/public-scripts.js", JS_DIR + "/public-styles.js"],
}
const output = {
	"path"    : BUILD_DIR,
	"filename": "js/[name].js"
}

const rules = (argv) => {
	return [
		{
			"test"   : /\.js$/,
			"include": [JS_DIR],
			"exclude": /node_modules/,
			"use"    : "babel-loader"
		},
		{
			"test"   : /\.(sass|scss|css)$/,
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
						// This options are enabled for generate a production stylesheet
						// without minify, you can remove this options if you want to
						// minify stylesheet
						sassOptions: {
							minimize   : ("production" === argv.mode),
							outputStyle: ("production" === argv.mode) ? 'compressed': 'expanded',
							indentType : "tab",
							indentWidth: 1,
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
						name            : '[path][name].[ext]',
						context         : path.resolve(__dirname, "src/"),
						outputPath      : '/',
						publicPath      : '../',
						useRelativePaths: true
					}
				},
			]
		},
	]
}

const plugins = (argv) => ([
	new CleanWebpackPlugin({
		"cleanStaleWebpackAssets": ("production" === argv.mode)
	}),
	new MiniCssExtractPlugin({
		"filename": `css/[name].css`
	}),
])

module.exports = (env, argv) => ({
	"entry"  : entry,
	"output" : output,
	"devtool": ("production" === argv.mode) ? false: "source-map",
	"module" : {
		"rules": rules(argv)
	},
	"plugins": plugins(argv),
	"stats"  : "verbose"
})
