var gulp        = require('gulp');
var bs = require('browser-sync').create();
var sass        = require('gulp-sass');
var rucksack = require('gulp-rucksack');
var sourcemaps = require('gulp-sourcemaps');

var src = {
  scss: 'scss/**/*.scss',
  css:  './',
  php: '**/**/*.php',
  js: '**/**/*.js'
};

// Static Server + watching scss/php files
gulp.task('serve', ['sass'], function() {

  bs.init({
    proxy: "localhost:8888",
    open: false
  });

  gulp.watch(src.scss, ['sass']);
  gulp.watch(src.php).on('change', bs.reload);
  gulp.watch(src.js).on('change', bs.reload);
});

// Compile sass into CSS
gulp.task('sass', function() {
  return gulp.src(src.scss)
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'expanded'})
    .on('error', function(err){
      bs.notify(err.message, 3000);
      this.emit('end');
    }))
    .pipe(rucksack({
      autoprefixer: true
    }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(src.css))
    .pipe(bs.stream({match: '**/*.css'}));
});

gulp.task('default', ['serve']);
