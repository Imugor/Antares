import webpack from "webpack-stream";
import uglify from "gulp-uglify";
import babel from "gulp-babel";

export const js = () => {
  
   return app.gulp.src(app.path.src.js, { sourcemaps: true })
      .pipe(app.plugins.plumber(
         app.plugins.notify.onError({
            title: "JS",
            message: "Error: <%= error.message %>"
         })
      ))
      .pipe(babel({
        presets: ["@babel/preset-env"]
      }))
      .pipe(webpack({
         mode: 'development',
         devtool: 'eval-source-map',
         optimization: {
            minimize: false
        },
         output: {
            filename: 'script.js',
         }
      }))
      .pipe(app.gulp.dest(app.path.build.js))
      .pipe(app.plugins.browsersync.stream())
}

export const jsDOM = () => {
  return app.gulp.src(app.path.src.jsdom, { sourcemaps: true })
      .pipe(app.plugins.plumber(
         app.plugins.notify.onError({
            title: "JS",
            message: "Error: <%= error.message %>"
         })
      ))
      .pipe(babel({
        presets: ["@babel/preset-env"]
      }))
      .pipe(webpack({
         mode: 'development',
         devtool: 'eval-source-map',
         optimization: {
            minimize: false
        },
         output: {
            filename: 'DOMLoaded.js',
         }
      }))
      .pipe(app.gulp.dest(app.path.build.js))
      .pipe(app.plugins.browsersync.stream());
}

export const prodjsDOM = () => {
  return app.gulp.src(app.path.src.jsdom, { sourcemaps: true })
      .pipe(app.plugins.plumber(
         app.plugins.notify.onError({
            title: "JS",
            message: "Error: <%= error.message %>"
         })
      ))
      .pipe(babel({
        presets: ["@babel/preset-env"]
      }))
      .pipe(webpack({
         mode: 'production',
         devtool: 'eval-source-map',
         optimization: {
            minimize: false
        },
         output: {
            filename: 'DOMLoaded.js',
         }
      }))
      .pipe(app.gulp.dest(app.path.build.js))
      .pipe(app.plugins.browsersync.stream());
}

export const prodjs = () => {
   return app.gulp.src(app.path.src.js, { sourcemaps: true })
      .pipe(app.plugins.plumber(
         app.plugins.notify.onError({
            title: "JS",
            message: "Error: <%= error.message %>"
         })
      ))
      .pipe(babel({
        presets: ["@babel/preset-env"]
      }))
      .pipe(webpack({
         mode: 'production',
         devtool: false,
         output: {
            filename: 'script.js',
         }
      }))
      .pipe(uglify())
      .pipe(app.gulp.dest(app.path.build.js))
      .pipe(app.plugins.browsersync.stream());
}