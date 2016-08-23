var gulp = require('gulp');
var bs = require('browser-sync').create();
var sass = require('gulp-sass');
var rucksack = require('gulp-rucksack');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');

var src = {
  scss: 'scss/**/*.scss',
  css: './',
  php: '**/**/*.php',
  js: '**/**/*.js'
};

var ignore = '!node_modules/**';

// Static Server + watching scss/php files
gulp.task('serve', ['sass'], function() {

  bs.init({
    proxy: "flex.dev", // use localhost:8888 for MAMP
    open: false
  });

  gulp.watch(src.scss, ['sass']);
  gulp.watch([src.php, src.js, ignore]).on('change', bs.reload);
});

// Compile sass into CSS
gulp.task('sass', function() {
  return gulp.src(src.scss)
    .pipe(sourcemaps.init())
    .pipe(sass({
        outputStyle: 'expanded'
      })
      .on('error', function(err) {
        bs.notify(err.message, 3000);
        this.emit('end');
      }))
    .pipe(autoprefixer({
      browsers: ['> 1% in AU']
    }))
    .pipe(rucksack())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(src.css))
    .pipe(bs.stream({
      match: '**/*.css'
    }));
});
gulp.task('default', ['serve']);
