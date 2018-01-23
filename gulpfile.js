// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var minifyCss = require('gulp-clean-css');

// Define default destination folder
var dest_js = 'public/js';
var dest_css = 'public/css';
var own_js = 'js';
var own_css = 'css';
var node_js = 'node_modules';

// Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src([
        node_js + '/jquery/dist/jquery.js',
        node_js + '/bootstrap/dist/js/bootstrap.js',
        node_js + '/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        node_js + '/bootstrap-validator/dist/validator.min.js',
        own_js + '/*.js',
    ])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('dist'))
        .pipe(rename('all.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest( dest_js ));
});

// Convert SCSS to CSS
gulp.task('sass', function() {
    return gulp.src( own_css + '/*.scss' )
        .pipe(sass())
        .pipe(gulp.dest( own_css ));
});

// Concatenate & Minify CSS
gulp.task('css', ['sass'], function() {
    return gulp.src([
        node_js + '/bootstrap/dist/css/bootstrap.css',
        node_js + '/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        own_css + '/*.css',
    ])
        .pipe(concat('all.css'))
        .pipe(gulp.dest('dist'))
        .pipe(rename('all.min.css'))
        .pipe(minifyCss())
        .pipe(gulp.dest(dest_css));
});

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch(['js/*.js' , 'css/*.scss'], ['scripts', 'css']);
});

// Default Task
gulp.task('default', ['scripts', 'sass', 'css', 'watch']);
