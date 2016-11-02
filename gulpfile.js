
// Gulp - the streaming task runner and the plugins
var gulp    = require('gulp');
var plugins = require('gulp-load-plugins')();

// NPM dependencies
var argv        = require('yargs').argv;
var del         = require('del');
var browserify  = require('browserify');
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
    styles:     './app/Resources/styles/**/*.scss',
    appStyles:  './app/Resources/styles/app.scss',
    scripts:    './app/Resources/scripts/**/*.js',
    appScripts: './app/Resources/scripts/app.js'
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
    // Browserif app scripts
    scripts: function () {
        var bundler = browserify(paths.appScripts, {
            debug: !production,
            cache: {}
        });
        if( watch ) {
            bundler = watchify(bundler);
        }
        var rebundle = function() {
            var pipe =  bundler.bundle()
                .pipe(source('app.bundle.js'))
                .pipe(gulp.dest(paths.output + '/js'));

            if( watch ) {
                pipe.pipe(browserSync.stream({once: true}));
            }
            return pipe;
        };
        bundler.on('update', rebundle);
        return rebundle();
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
        //gulp.watch(paths.scripts, ['lint'])
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
gulp.task('serve', tasks.serve);

// TODO: integrate bootstrap in the toolchain above
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
