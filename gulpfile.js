var gulp = require('gulp');

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