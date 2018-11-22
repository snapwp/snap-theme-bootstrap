const mix = require('laravel-mix');
const path = require('path');
const fs = require('fs');

let src = (relPath) => path.resolve(__dirname, 'resources/assets/src/', relPath),
	public = (relPath) => path.resolve(__dirname, 'public/', relPath);

if (process.env.NODE_ENV === 'installation') {

	/**
	 * Run the initial build process.
	 *
	 * Copy various assets into the current child theme.
	 */
	mix.copyDirectory('node_modules/bootstrap/scss', src('sass/sass/vendor/bootstrap'));
	mix.copyDirectory('node_modules/bootstrap/js', src('scripts/vendor/bootstrap'));
	mix.copy('node_modules/jquery/public/jquery.min.js', src('scripts/vendor/jquery/jquery.min.js'));
	mix.copy('node_modules/jquery/public/jquery.slim.min.js', src('scripts/vendor/jquery/jquery.slim.min.js'));
	mix.copy('node_modules/popper.js/public/popper.js', src('scripts/vendor/popper/popper.js'));
	mix.copy('node_modules/popper.js/public/popper.min.js', src('scripts/vendor/popper/popper.min.js'));

	if (! fs.existsSync(src('sass/_variables.scss'))) {
		mix.copy('node_modules/bootstrap/scss/_variables.scss', src('sass/_variables.scss'));
	}

} else {

	mix.webpackConfig({
	    externals: {
	        "jquery": "jQuery"
	    }
	});

	mix
		.setPublicPath('public')
    	.setResourceRoot('../')
		.options({ processCssUrls: false })
		.sass(src('sass/style.scss'), public('css'))
		.copyDirectory(src('images'), public('images'))
		.js(src('scripts/theme.js'), public('scripts'))
		.version();

	if (mix.inProduction()) {
		mix
			.options({ processCssUrls: false });
	} else {
		mix
			.webpackConfig({
		        devtool: 'source-map'
		    })
		    .sourceMaps();
	}
}
