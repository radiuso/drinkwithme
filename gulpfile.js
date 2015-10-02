var gulp        = require('gulp'),
    minimist    = require('minimist'),
    summary     = require('jshint-summary'),
    del         = require('del'),
    plugins     = require('gulp-load-plugins')();

var paths = {
    js  : ['application/assets/javascripts/**/*.js'],
    scss: ['application/assets/stylesheets/**/*.scss']
};

function watcherWithCache(name, src, tasks) {
    var watcher = gulp.watch(src, tasks);
    watcher.on('change', function(event) {
        if (event.type === 'deleted') {
            delete plugins.cached.caches.scripts[event.path];
            plugins.remember.forget(name, event.path);
        }
    });
}

var knownOptions = {
    string: 'version',
    default: { version: '1.0' }
};

var options = minimist(process.argv.slice(2), knownOptions);

// Clean
gulp.task('clean:build', function(cb) {
    del(['application/assets/dist/stylesheets/*', 'application/assets/dist/javascripts/*'], cb);
});

gulp.task('build:css', [], function()
{
    return gulp.src(['application/assets/stylesheets/app.scss'])
        .pipe(plugins.plumber())
        .pipe(plugins.rename('app.min.scss'))
        .pipe(plugins.sass())
        //.pipe(plugins.minifyCss({ keepSpecialComments: 0 }))
        .pipe(plugins.insert.prepend('/*\n E-Vento DrinkWithMe ' + options.version + '\n (c) 2015-' + new Date().getFullYear() + ' */\n'))
        .pipe(gulp.dest('application/assets/dist/stylesheets'));
});

gulp.task('build:scripts', [], function()
{
    return gulp.src(paths.js.concat(paths.js))
        .pipe(plugins.plumber())
        .pipe(plugins.concat('app.min.js'))
        .pipe(plugins.insert.prepend('"use strict";\n\n/*\n E-Vento DrinkWithMe' + options.version + '\n (c) 2015-' + new Date().getFullYear() + ' */\n'))
        //.pipe(plugins.uglify())
        .pipe(gulp.dest('application/assets/dist/javascripts'));
});

gulp.task('watch', ['build'], function()
{
    watcherWithCache('build', [paths.js, paths.scss], ['build']);
});

gulp.task('clean', ['clean:build']);

gulp.task('build', ['clean:build'], function()
{
    gulp.start('build:css');
    //gulp.start('build:scripts');
});

gulp.task('default', ['build']);
