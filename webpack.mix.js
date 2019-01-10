const mix = require('laravel-mix');
const path = require('path');
const fs = require('fs');

let src = (relPath) => path.resolve(__dirname, 'resources/assets/', relPath),
    dist = (relPath) => path.resolve(__dirname, 'public/', relPath);

if (process.env.NODE_ENV === 'installation') {

    /**
     * Run the initial build process.
     *
     * Copy various assets into the current child theme.
     */
    mix.copyDirectory('node_modules/bootstrap/scss', src('sass/sass/vendor/bootstrap'));
    mix.copyDirectory('node_modules/bootstrap/js', src('scripts/vendor/bootstrap'));
    mix.copy('node_modules/jquery/dist/jquery.min.js', src('scripts/vendor/jquery/jquery.min.js'));
    mix.copy('node_modules/jquery/dist/jquery.slim.min.js', src('scripts/vendor/jquery/jquery.slim.min.js'));
    mix.copy('node_modules/popper.js/dist/popper.js', src('scripts/vendor/popper/popper.js'));
    mix.copy('node_modules/popper.js/dist/popper.min.js', src('scripts/vendor/popper/popper.min.js'));

    if (!fs.existsSync(src('sass/_variables.scss'))) {
        mix.copy('node_modules/bootstrap/scss/_variables.scss', src('sass/_variables.scss'));
    }

} else {

    // If you are using jQuery via CDN, let webpack know.
    mix.webpackConfig({
        externals: {
            "jquery": "jQuery"
        }
    });

    // Set some basic options.
    mix.setPublicPath('public');
    mix.setResourceRoot('../');

    /**
     * @See https://laravel-mix.com/docs/4.0/css-preprocessors
     */
    mix.options({processCssUrls: false});

    mix.sass(src('sass/style.scss'), dist('css'), {
        implementation: require('node-sass')
    });

    mix.copyDirectory(src('images'), dist('images'));

    mix.js(src('scripts/theme.js'), dist('scripts'));

    mix.version();

    if (!mix.inProduction()) {
        // Include separate source maps in development builds.
        mix.webpackConfig({
            devtool: 'source-map'
        });
        mix.sourceMaps();
    }
}
