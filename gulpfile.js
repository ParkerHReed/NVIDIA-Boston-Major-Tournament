/* GULP
----------------------------------------- */

var fs = require('fs');
var path = require('path');

var gulp = require('gulp');
var gutil = require('gulp-util');
var debug = require('gulp-debug');

var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var clean =  require('gulp-clean');

var watch = require('gulp-watch');

var concat = require('gulp-concat');
var css_min = require('gulp-csso');
var js_min = require('gulp-uglify');

var browserSync = require('browser-sync').create();
var reload      = browserSync.reload;


/* get paths
---------------------------------------- */

function getDirectories(srcpath)
{
  return fs.readdirSync(srcpath).filter(function(file)
  {
    return fs.statSync(path.join(srcpath, file)).isDirectory();
  });
}


/* loop over paths
---------------------------------------- */

var src_url    = 'assets';
var public_url = 'assets_min';
var groups     = getDirectories( src_url );
var tasks      = groups;

for ( var i in groups )
{
  (function()
  {
    var group     = groups[i];
    var group_url = src_url + '/' + group;
    var dest_url  = public_url + '/' + group;

    gulp.task( group, function()
    {
        // move all files

        gulp.src( [ group_url + '/**/*.*', '!'+group_url + '/css/**/*.css', '!'+group_url + '/css/**/*.scss', '!'+group_url + '/vue/**/*.vue' ] )
          .pipe( gulp.dest( dest_url ) );



        // move css

        gulp.src( [ group_url + '/css/**/*.css', group_url + '/css/**/*.css' ] )
          .pipe( sass().on('error', sass.logError) )
          .pipe( sourcemaps.write(public_url+'/maps') )
          .pipe( autoprefixer() )
          //.pipe( css_min() )
          .pipe( gulp.dest( dest_url+'/css' ) );

        // css

        gulp.src( [ group_url + '/css/**/*.css', group_url + '/css/**/*.scss' ] )
          .pipe( sass().on('error', sass.logError) )
          .pipe( sourcemaps.write(public_url+'/maps') )
          .pipe( autoprefixer() )
          //.pipe( css_min() )
          .pipe( concat('main.min.css') )
          .pipe( gulp.dest( dest_url+'/css' ) )
          .pipe( reload({stream: true}) );

        // js

        gulp.src( group_url + '/js/**/*.js' )
          .pipe( js_min().on('error', gutil.log) )
          .pipe( concat('main.min.js') )
          .pipe( gulp.dest( dest_url+'/js' ), { extension: '.js' } );

        // load custom config

        fs.stat('./'+group_url+'/gulpfile.js', function(err, stat)
        {
            if(err == null)
            {
                require('./'+group_url+'/gulpfile.js')( gulp, gutil, group_url, dest_url, tasks, css_min, js_min, concat );
            }
        });

    });

  })();

};


/* commands
---------------------------------------- */

gulp.task( 'install', function()
{
  gulp.start( tasks );
});

gulp.task( 'clean', function()
{
  gulp.src( public_url+'/*' ).pipe(clean());
});

gulp.task( 'clear', function()
{
  gulp.src( public_url+'/*' ).pipe(clean());
});


gulp.task( 'watch', ['install'], function()
{
  browserSync.init(
  {
    server: false,
    host: "http://localhost:8888/bostondota/",
    proxy: 'http://localhost:8888/bostondota/',
    ghostMode: {
      clicks: false,
      forms: false,
      scroll: false
    },
    open: false,
    injectChanges: true,
    notify: false
  });

  for ( var i in groups )
  {
    var group     = groups[i];
    var group_url = src_url + '/' + group;

    gulp.watch( [ group_url + '/**/*.css', group_url + '/**/*.js' ], [ group ] );
  }

	gulp.watch( 'app/views/**/*.php' ).on('change', reload );
  gulp.watch( src_url + '/**/*.scss' ).on('change', reload );
  //gulp.watch( src_url + '/**/*.js' ).on('change', reload );

});

gulp.task( 'default', ['watch'], function()
{

});
