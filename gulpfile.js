var gulp = require('gulp')
var bs = require('browser-sync').create()
var sass = require('gulp-sass')
var rucksack = require('gulp-rucksack')
var autoprefixer = require('gulp-autoprefixer')
var sourcemaps = require('gulp-sourcemaps')
var gutil = require('gulp-util')

// js
var browserify = require('browserify')
var rename = require('gulp-rename')
var uglify = require('gulp-uglify')
var buffer = require('vinyl-buffer')
var source = require('vinyl-source-stream')


var src = {
  scss: 'scss/**/*.scss',
  css: './',
  php: '**/**/*.php',
  js: '**/**/*.js'
}

var ignore = '!node_modules/**'

// Static Server + watching scss/php files
gulp.task('serve', ['sass', 'scripts'], function() {

  bs.init({
    proxy: '192.168.33.15', // use localhost:8888 for MAMP
    open: false
  })

  gulp.watch(src.scss, ['sass'])
  gulp.watch([src.js, ignore, '!**/**.min.js'], ['scripts-watch'])
  gulp.watch([src.php, ignore]).on('change', bs.reload)
})

// Compile sass into CSS
gulp.task('sass', function() {
  return gulp.src(src.scss)
    .pipe(sourcemaps.init())
    .pipe(sass({
        outputStyle: 'compact'
      })
      .on('error', function(err) {
        bs.notify(err.message, 3000)
        gutil.log(err)
        this.emit('end')
      }))
    .pipe(autoprefixer({
      browsers: ['> 1% in AU']
    }))
    .pipe(rucksack())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(src.css))
    .pipe(bs.stream({
      match: '**/*.css'
    }))
})

gulp.task('scripts', function() {
  var b = browserify({
    entries: './js/main.js',
    debug: true,
    sourceMaps: true
  }).transform('babelify', {presets: ['es2015']})
  return b.bundle()
    .on('error', function(err) {
      gutil.log(err)
      bs.notify(err.message, 3000)
      this.emit('end')
    })
    .pipe(source('./js/main.js'))
    .pipe(rename('main.min.js'))
    .pipe(buffer())
    .pipe(sourcemaps.init({loadMaps: true}))
    // Uncomment for production
    // .pipe(uglify())
    .on('error', gutil.log)
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./js'))
})

gulp.task('scripts-watch', ['scripts'], function(done){
  bs.reload()
  done()
})

gulp.task('default', ['serve'])
