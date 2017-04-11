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
gulp.task('serve', ['sass', 'scripts'], function () {
  bs.init({
    proxy: '192.168.33.15', // use localhost:8888 for MAMP
    open: false,
    port: 7777,
    plugins: ['bs-fullscreen-message'],
    notify: false
  })

  gulp.watch(src.scss, ['sass'])
  gulp.watch([src.js, ignore, '!**/**.min.js'], ['scripts-watch'])
  gulp.watch([src.php, ignore]).on('change', bs.reload)
})

// Compile sass into CSS
gulp.task('sass', function () {
  return gulp.src(src.scss)
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'compact'
    })
    .on('data', function () {
      bs.sockets.emit('fullscreen:message:clear')
    })
    .on('error', function (err) {
      bs.sockets.emit('fullscreen:message', {
        title: err.relativePath,
        body: err.message,
        timeout: 100000
      })
      gutil.log(err.message)
      this.emit('end')
    }))
    .pipe(autoprefixer())
    .pipe(rucksack())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(src.css))
    .pipe(bs.stream({
      match: '**/*.css'
    }))
})

gulp.task('scripts', function () {
  var b = browserify({
    entries: './js/main.js',
    debug: true,
    sourceMaps: true
  }).transform('babelify')
  return b.bundle()
    .on('error', function (err) {
      bs.sockets.emit('fullscreen:message', {
        title: 'JS Error',
        body: err.filename,
        timeout: 100000
      })
      gutil.log(err)
      this.emit('end')
    })
    .on('data', bs.reload)
    .pipe(source('./js/main.js'))
    .pipe(rename('main.min.js'))
    .pipe(buffer())
    .pipe(sourcemaps.init({loadMaps: true}))
    // .pipe(uglify())
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./js'))
})

gulp.task('scripts-watch', ['scripts'], function (done) {
  done()
})

gulp.task('default', ['serve'])
