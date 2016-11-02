
// Gulp - the streaming task runner and the plugins
var gulp    = require('gulp');
var plugins = require('gulp-load-plugins')();

// NPM dependencies
var browserSync = require('browser-sync').create();;
var wiredep     = require('wiredep').stream;

//
// Main Tasks
//

// Default - npm start
//   starts the development
gulp.task('default', ['serve'] );

// Build - npm run build
//   nuilds the production version
gulp.task('build');

//
// Helper Tasks
//

// Dev Server via browsersync
gulp.task('serve', function() {
    browserSync.init({
        proxy: 'http://localhost:8000'
    });
});

gulp.task('bower', function () {
    gulp.src('./app/Resources/views/base.html.twig')
        .pipe(wiredep({
            devDependencies: true,
            ignorePath: /.*web/,
            fileTypes: {
                twig: {
                    block: /(([ \t]*)<!--\s*bower:*(\S*)\s*-->)(\n|\r|.)*?(<!--\s*endbower\s*-->)/gi,
                    detect: {
                        js: /<script.*src=['"]([^'"]+)/gi,
                        css: /<link.*href=['"]([^'"]+)/gi
                    },
                    replace: {
                        js: '<script src="{{filePath}}"></script>',
                        css: '<link rel="stylesheet" href="{{filePath}}" />'
                    }
                }
            }
        }))
        .pipe(gulp.dest('./app/Resources/views'));
});

gulp.task('styles', function () {
    return gulp.src('./app/Resources/styles/app.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./web/css'));
});

gulp.task('styles:watch', function () {
    gulp.watch('./app/Resources/styles/**/*.scss', ['styles']);
});
