let $files = {};

// wponion-base.scss
$files[ 'node_modules/jQuery-QueryBuilder/dist/js/query-builder.standalone.min.js' ] = {
	dist: 'assets/js/',
	rename: 'query-builder.js',
};

$files[ 'node_modules/jQuery-QueryBuilder/dist/css/query-builder.default.min.css' ] = {
	dist: 'assets/css/',
	rename: 'query-builder.min.css',
};

$files[ 'src/js/addon.js' ] = {
	dist: 'assets/js',
	webpack: false,
	babel: true,
	combine_files: true,
	watch: true,
	sourcemaps: false,
	uglify: true,
	rename: 'addon.js',
};

$files[ 'src/scss/style.scss' ] = {
	dist: 'assets/css',
	scss: true,
	minify: true,
	combine_files: true,
	watch: true,
	sourcemaps: false,
	rename: 'addon.css',
};

module.exports = {
	files: $files,
	config: {
		combine_files: {
			append: 'wponion-append',
			prepend: 'wponion-prepend',
			inline: 'wponion-inline',
		},
		webpack_dev_eval: {
			devtool: 'eval',
			mode: 'development',
			target: 'node',
			externals: {
				jquery: 'jQuery'
			},
			output: {
				filename: '[name].js',
			},
			module: {
				rules: [
					{
						test: /\.js$/,
						loader: 'babel-loader',
						options: {
							presets: [ '@babel/env' ]
						}
					}
				]
			},
		},
	}
};
