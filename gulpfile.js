
// Gulp - the streaming task runner and the plugins
var gulp    = require('gulp');
var plugins = require('gulp-load-plugins')();

// NPM dependencies
var browserSync = require('browser-sync').create();;
var wiredep     = require('wiredep').stream;

//
// Project paths
var paths = {
    webRoot: './web/',
    appStyles: './app/Resources/styles/app.scss'
};

//
// Main Tasks
//

// Default - npm start
//   starts the development
gulp.task('default', ['serve'] );

// Build - npm run build
//   nuilds the production version
gulp.task('build');

// The assets pipeline
var pipes = {};

pipes.stylesDev = function () {
    return gulp.src(paths.appStyles)
        .pipe(plugins.sass())
        .pipe(gulp.dest(paths.webRoot + 'css'))
        .pipe(browserSync.stream());
};

//
// Helper Tasks
//

// Dev Server via browsersync
gulp.task('serve', function() {
    browserSync.init({
        proxy: 'http://localhost:8000'
    });
    gulp.watch(paths.appStyles, ['styles:dev']);
});

gulp.task('styles:dev', pipes.stylesDev);


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
