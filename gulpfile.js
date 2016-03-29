// JavaScript Document

var gulp = require('gulp');
var babelify = require('babelify');
var uglify = require('gulp-uglify');
var buffer = require('vinyl-buffer');
var browserify = require('browserify');
var source = require('vinyl-source-stream');


gulp.task('js', function() {
	return browserify('./resources/javascript/app.js', { debug: true })
			.transform(babelify)
			.bundle()
			.pipe(source('app.js'))
			.pipe(buffer())
			//.pipe(uglify())
			.pipe(gulp.dest('./public/js'));
});

gulp.task('default', function() {
	gulp.watch('./resources/javascript/**/*.js', ['js']);
});