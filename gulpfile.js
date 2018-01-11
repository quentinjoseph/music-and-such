'use strict';
// Get modules
var gulp         = require('gulp');
var sass         = require('gulp-sass');
var uglify       = require('gulp-uglify');
var rename       = require('gulp-rename');
var imagemin     = require('gulp-imagemin');
var livereload   = require('gulp-livereload');
var concat     	 = require('gulp-concat');
var plumber    	 = require('gulp-plumber');
var cssnano 		 = require('gulp-cssnano');
var autoprefixer = require('gulp-autoprefixer');

// Task sass
gulp.task('styles', function () {
  console.log('hello');
  gulp.src('source/style.scss')
    .pipe(plumber())
    .pipe(sass({errLogToConsole: true}))
    .pipe(autoprefixer())
    .pipe(cssnano())
    .pipe(gulp.dest('source'))
    .pipe(livereload());
});

// Task scripts
gulp.task('scripts', function() {
  gulp.src('js/source/*.js')
    .pipe(plumber())
    .pipe(uglify())
    .pipe(concat('main.js'))
    .pipe(gulp.dest('js/mini'));
});

// Task images
gulp.task('images', function () {
  gulp.src('images/img/*.{png,gif,jpg}')
    .pipe(plumber())
    .pipe(imagemin())
    .pipe(gulp.dest('img/'));
});

//Template Changes
gulp.task('templateChanges',function(){
  gulp.src('*.php')
    .pipe(livereload());
});

// Task watch
gulp.task('watch', function () {
  livereload.listen();
  gulp.watch('source/*.scss', ['styles']);
  gulp.watch('js/**', ['scripts']);
  // gulp.watch('img/**', ['images']);
  gulp.watch('*.php', ['templateChanges']);
  
});

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['styles', 'scripts', 'templateChanges', 'watch']);
