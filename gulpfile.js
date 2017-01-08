
// Gulp - the streaming task runner and the plugins
var gulp    = require('gulp');
var plugins = require('gulp-load-plugins')();

// NPM dependencies
var argv        = require('yargs').argv;
var del         = require('del');
var browserSync = require('browser-sync').create();
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
    output:  './web/assets/build',
    views:   './app/Resources/views/',
    styles:  './app/Resources/styles/*.scss',
    scripts: './app/Resources/scripts/*.js'
};

// Task methods
var tasks = {
    // Wire bower dependencies
    bower: function () {
        return gulp.src(paths.views + '/base.html.twig')
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
            .pipe(gulp.dest(paths.views));
    },
    // Delete output folder
    clean: function(cb) {
        del([paths.output + '/']).then(function () {
            cb();
        });
    },
    // Compile sass sources
    styles: function () {
        return gulp.src(paths.styles)
            .pipe(plugins.sass())
            .pipe(gulp.dest(paths.output + '/css'))
            .pipe(browserSync.stream());
    },
    // Copy and inject app scripts
    scripts: function () {
        return gulp.src(paths.scripts)
            .pipe(gulp.dest(paths.output + '/js'));
    },
    inject: function () {
        var target = gulp.src(paths.views + '/base.html.twig');
        var sources = gulp.src(paths.output + '/**/*', {read: false});

        return target.pipe(plugins.inject(sources, {ignorePath: '/web'} ))
            .pipe(gulp.dest(paths.views));
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
gulp.task('build', ['clean','inject']);
gulp.task('watch', ['inject','serve'], tasks.watchDeps );
gulp.task('default', ['watch']);

//
// Sub Tasks (dependency on clean forced on build tasks)
//
var deps = build ? ['clean'] : [];

gulp.task('bower', tasks.bower);
gulp.task('clean', tasks.clean);
gulp.task('styles', deps, tasks.styles);
gulp.task('scripts', deps, tasks.scripts);
gulp.task('inject', ['styles','scripts'], tasks.inject);

gulp.task('scripts-watcher',['scripts'],
    function (done) {
        browserSync.reload();
        done();
    });

gulp.task('serve', tasks.serve);
