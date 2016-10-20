var gulp = require('gulp');

var sass = require('gulp-sass');

var wiredep = require('wiredep').stream;

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
    gulp.watch('./app/Resources/styles/**/*.scss', ['sass']);
});
