
// Gulp - the streaming task runner and the plugins
var gulp    = require('gulp');
var plugins = require('gulp-load-plugins')();

// NPM dependencies
var argv        = require('yargs').argv;
var del         = require('del');
var browserSync = require('browser-sync').create();
var source      = require('vinyl-source-stream');
var watchify    = require('watchify');
var wiredep     = require('wiredep').stream;

// Determine run configuration
// gulp [watch]
// gulp build
// gulp build --production
var build = argv._.length ? argv._[0] === 'build' : false;
var watch = argv._.length ? argv._[0] === 'watch' : true;
var production = !!argv['production'];

//
// Project paths
var paths = {
    output:     './web/assets/build',
    baseHtmlPath:   './app/Resources/views/',
    styles:     './app/Resources/styles/**/*.scss',
    appStyles:  './app/Resources/styles/*.scss',
    scripts:    './app/Resources/scripts/**/*.js'
};

// Task methods
var tasks = {
    // Delete output folder
    clean: function(cb) {
        del([paths.output + '/']).then(function () {
            cb();
        });
    },
    // Compile sass sources
    styles: function () {
        return gulp.src(paths.appStyles)
            .pipe(plugins.sass())
            .pipe(gulp.dest(paths.output + '/css'))
            .pipe(browserSync.stream());
    },
    // Copy and inject app scripts
    scripts: function () {
        return gulp.src(paths.baseHtmlPath + '/base.html.twig')
            .pipe(plugins.inject(
                gulp.src(paths.scripts)
                    .pipe(gulp.dest(paths.output + '/js'))
                    .pipe(plugins.angularFilesort()), { ignorePath: '/web/'})
            )
            .pipe(gulp.dest(paths.baseHtmlPath));
    },
    // Initialize browser-sync
    serve: function () {
        browserSync.init({
            proxy: 'http://localhost:8000'
        });
    },
    // Watch dependencies
    watchDeps: function () {
        // styles
        gulp.watch(paths.styles, ['styles']);
        // scripts
        gulp.watch(paths.scripts, ['scripts-watcher']);
    }
};

//
// Main Tasks: build and watch (default)
//
gulp.task('build', ['clean','styles','scripts']);
gulp.task('watch', ['styles','scripts','serve'], tasks.watchDeps );
gulp.task('default', ['watch']);

//
// Sub Tasks (dependency on clean forced on build tasks)
//
var deps = build ? ['clean'] : [];

gulp.task('clean', tasks.clean);
gulp.task('styles', deps, tasks.styles);
gulp.task('scripts', deps, tasks.scripts);
gulp.task('scripts-watcher',['scripts'],
    function (done) {
        browserSync.reload();
        done();
    });
gulp.task('serve', tasks.serve);

// TODO: integrate bootstrap in the toolchain above
gulp.task('bower', function () {
    gulp.src(paths.baseHtmlPath + '/base.html.twig')
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
