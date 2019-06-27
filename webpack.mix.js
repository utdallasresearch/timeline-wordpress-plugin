let mix = require('laravel-mix');

/**
 * Settings and Options
 */
const sass_options = {
  outputStyle: 'expanded',
}

mix.setPublicPath('public');

mix.options({
  processCssUrls: false,
  autoprefixer: {
    options: {
      // browsers are listed in package.json
      cascade: false,
    },
  },
});

if (!mix.inProduction()) {
  // Do non-inline source-maps
  mix.webpackConfig({
    devtool: "source-map",
  });
}

// Compile CSS
mix.sass('public/css/source/timeline.scss', 'css/timeline.css', sass_options);

// Compile JS
mix.js('public/js/source/timeline.js', 'js/timeline.js');

if (!mix.inProduction()) {
  mix.sourceMaps();
}