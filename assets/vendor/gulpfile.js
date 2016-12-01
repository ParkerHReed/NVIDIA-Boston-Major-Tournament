module.exports = function (gulp, gutil, group_url, dest_url, tasks, css_min, js_min, concat )
{
	// /vendor/vendor.min.css

	gulp.src(
	[
		'assets/vendor/normalize.css/normalize.css'
	])
	.pipe( css_min() )
	.pipe( concat('vendor.min.css') )
	.pipe( gulp.dest( dest_url ) );


	// /vendor/vendor.min.js

	gulp.src(
	[
		'assets/vendor/jquery/jquery.min.js',
		'assets/vendor/lodash/lodash.min.js',
		'assets/vendor/numeral/numeral.min.js',
		'assets/vendor/countup/countUp.min.js'
	])
	.pipe( js_min().on('error', gutil.log) )
	.pipe( concat('vendor.min.js') )
	.pipe( gulp.dest( dest_url ) );

};