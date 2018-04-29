const mix = require('laravel-mix');
const path = require('path');
const fs = require('fs');

let variablesPath = path.resolve(__dirname, 'assets/styles/sass/_variables.scss');


if (process.env.NODE_ENV === 'installation') {
	/**
	 * Run the initial build process.
	 *
	 * Copy various assets into the current child theme.
	 */
	mix.copyDirectory('node_modules/bootstrap/scss', 'assets/styles/sass/vendor/bootstrap');
	mix.copyDirectory('node_modules/bootstrap/js', 'assets/js/vendor/bootstrap');
	mix.copy('node_modules/jquery/dist/jquery.min.js', 'assets/js/vendor/jquery/jquery.min.js');
	mix.copy('node_modules/jquery/dist/jquery.slim.min.js', 'assets/js/vendor/jquery/jquery.slim.min.js');
	mix.copy('node_modules/popper.js/dist/popper.js', 'assets/js/vendor/popper/popper.js');
	mix.copy('node_modules/popper.js/dist/popper.min.js', 'assets/js/vendor/popper/popper.min.js');

	if (! fs.existsSync(variablesPath)) {
		mix.copy('node_modules/bootstrap/scss/_variables.scss', variablesPath);
	}
} else {
	mix.webpackConfig({
	    externals: {
	        "jquery": "jQuery"
	    }
	});

	if (mix.inProduction()) {
		mix.setPublicPath('./')
			.sass('assets/styles/sass/style.scss', 'assets/styles/css')
			.js('assets/js/theme.js', 'assets/js/min')
			.version();
	} else {
		mix.setPublicPath('./')
			.sass('assets/styles/sass/style.scss', 'assets/styles/css')
			.js('assets/js/theme.js', 'assets/js/min')
			.webpackConfig({
		        devtool: 'source-map'
		    })
   			.sourceMaps();
	}
}