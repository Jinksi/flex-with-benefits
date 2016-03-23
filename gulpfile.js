var gulp        = require('gulp');
var browserSync = require('browser-sync');
var sass        = require('gulp-sass');
var rucksack = require('gulp-rucksack');
var sourcemaps = require('gulp-sourcemaps');
var reload      = browserSync.reload;

var src = {
  scss: 'scss/**/*.scss',
  css:  './',
  php: '**/**/*.php',
  js: '**/**/*.js'
};

// Static Server + watching scss/php files
gulp.task('serve', ['sass'], function() {

  browserSync({
    proxy: "localhost:8888",
    open: false
  });

  gulp.watch(src.scss, ['sass']);
  gulp.watch(src.php).on('change', reload);
  gulp.watch(src.js).on('change', reload);
});

// Compile sass into CSS
gulp.task('sass', function() {
  return gulp.src(src.scss)
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'expanded'})
    .on('error', function(err){
      browserSync.notify(err.message, 3000);
      this.emit('end');
    }))
    .pipe(rucksack({
      autoprefixer: true
    }))
    .pipe(sourcemaps.write('maps'))
    .pipe(gulp.dest(src.css))
    .pipe(reload({stream: true, match: ['**/*.css']}));
});

gulp.task('default', ['serve']);
gulp.task('build', ['sass']);
