'use strict';

var gulp         = require( 'gulp' ),
	sass         = require( 'gulp-sass' ),
	autoprefixer = require( 'gulp-autoprefixer' ),
	imagemin     = require( 'gulp-imagemin' ),
	pngquant     = require( 'imagemin-pngquant' ),
	watch        = require( 'gulp-watch' ),
	concat       = require( 'gulp-concat' ),
	bump         = require( 'gulp-bump' );

// Uglify JS
gulp.task( 'scripts', function() {
	return gulp.src([
		'./bower_components/foundation-sites/dist/js/foundation.min.js',

		/* Load all the util libraries */
		// './assets/js/utils/*.js',

		/* Or just some of them */
		// './assets/js/utils/jquery.infinitescroll.min.js',
		'./assets/js/utils/utils.js',

		'./assets/js/site/*.js'
	])
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
			browsers: ['last 3 versions', 'iOS 7'],
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
	gulp.watch('./assets/js/**/*.js', ['scripts']);
} );

gulp.task('bump:theme_version', function(type){
    var constant = "PROPANE_VERSION";
    var pattern = [
            // Match Key, e.g. "key", " OR 'key', '
            '([\'|\"]?(',
            constant,
            ')[\'|\"]?[ ]*?,[ ]*[\'|\"]?)',

            // Match Semver version identifier, e.g.: x.y.z
            '(\\d+\\.\\d+\\.\\d+)',

            // Match Semver pre-release identifier, e.g. -pre.0-1
            '(-[0-9A-Za-z\.-]+)?',

            // Match Semver metadata identifier, e.g. +meta.0-1
            '(\\+[0-9A-Za-z\.-]+)?',

            // Match end of version value: e.g. ", '
            '([\'|\"]?)'
        ].join('');

    gulp.src('./functions.php')
        .pipe(bump({
            regex: new RegExp( pattern, "gi" ),
        }))
        .pipe(gulp.dest('.'));
});

// Bump Style.css
gulp.task( 'bump:style_css_version', function(){
    return gulp.src('./style.css')
        .pipe(bump({key: "Version"}))
        .pipe(gulp.dest('.'));
});

// Bump Package.json
gulp.task('bump:package_json_version', function(){
    gulp.src('./package.json')
        .pipe(bump({key: "version"}))
        .pipe(gulp.dest('.'));
});

// Default "gulp" task
gulp.task('default', ['scripts', 'sass', 'autoprefixer', 'watch']);

// Bump Version Number
gulp.task('build:bump', ['bump:theme_version', 'bump:package_json_version', 'bump:style_css_version']);

// Build out production
// Same as default with out "watching"
gulp.task('build:production', ['scripts', 'sass', 'imagemin', 'autoprefixer']);