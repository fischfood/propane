'use strict';

var gulp         = require( 'gulp' ),
	sass         = require( 'gulp-sass' ),
	autoprefixer = require( 'gulp-autoprefixer' ),
	imagemin     = require( 'gulp-imagemin' ),
	pngquant     = require( 'imagemin-pngquant' ),
	watch        = require( 'gulp-watch' ),
	concat       = require( 'gulp-concat' );

// Uglify JS
gulp.task( 'scripts', function() {
	return gulp.src(['./bower_components/foundation-sites/dist/foundation.min.js', './assets/js/*.js'])
		.pipe( concat('propane.js') )
		.pipe( gulp.dest('./js') );
} );

// Sass
gulp.task( 'sass', function() {
	return gulp.src('./assets/scss/**/*.scss')
		.pipe( sass({
			outputStyle: 'compressed'
		}).on('error', sass.logError))
		.pipe( gulp.dest('./css') );
} );

// Autoprefixer
gulp.task( 'autoprefixer', ['sass'], function() {
	return gulp.src( './css/*.css' )
		.pipe( autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}) )
		.pipe( gulp.dest('./css') );
} );

// Imagemin
gulp.task( 'imagemin', function() {
	return gulp.src( './assets/images/*' )
		.pipe( imagemin({
			progressive: true,
			svgoPlugins: [
				{removeViewBox: false},
				{cleanupIDs: false}
			],
			use: [pngquant()]
		}) )
		.pipe( gulp.dest('./images') );
} );

// Watch
gulp.task( 'watch', ['sass'], function() {
	gulp.watch('./assets/scss/**/*.scss', ['sass', 'autoprefixer']);
	gulp.watch('./assets/js/*.js', ['scripts']);
} );

// Default "gulp" task
gulp.task('default', ['scripts', 'sass', 'imagemin', 'autoprefixer', 'watch']);