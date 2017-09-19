/* eslint-env node */
const gulp = require('gulp')
const postcss = require('gulp-postcss')
const sourcemaps = require('gulp-sourcemaps')
const rucksack = require('rucksack-css')
const autoprefixer = require('autoprefixer')
const webpack = require('webpack-stream')
const browserSync = require('browser-sync').create()
const sass = require('gulp-sass')
const reload = browserSync.reload
const gutil = require('gulp-util')

const proxy = 'http://flex-with-benefits.dev'
const output = 'dist/'
const src = {
  js: './src/js/main.js',
  jsWatch: './src/js/**/**.js',
  sass: './src/scss/**/**.scss',
  php: './**/**.php'
}

gulp.task('default', ['serve'])

gulp.task('serve', ['sass', 'js'], function() {
  browserSync.init({
    proxy,
    open: false,
    notify: false,
    plugins: ['bs-fullscreen-message']
  })

  gulp.watch(src.sass, ['sass'])
  gulp.watch(src.jsWatch, ['js-watch'])
  gulp.watch(src.php).on('change', reload)
})

gulp.task('sass', function () {
  return gulp.src(src.sass)
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'compact'
    })
    .on('data', function () {
      browserSync.sockets.emit('fullscreen:message:clear')
    })
    .on('error', function (err) {
      browserSync.sockets.emit('fullscreen:message', {
        title: err.relativePath,
        body: err.message,
        timeout: 100000
      })
      gutil.log(err.message)
      this.emit('end')
    }))

    .pipe(postcss([
      rucksack(),
      autoprefixer()
    ]))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(output))
    .pipe(reload({stream: true}))
})

gulp.task('js', function () {
  return gulp.src(src.js)
    .pipe(
      webpack(require('./webpack.config.js'))
    )
    .on('error', function (err) {
      browserSync.sockets.emit('fullscreen:message', {
        title: 'JS Error',
        body: err,
        timeout: 100000
      })
      this.emit('end')
    })
    .on('data', reload)
    .pipe(gulp.dest(output))
})

gulp.task('js-watch', ['js'], function (done) {
  done()
})

gulp.task('build', ['sass', 'js'])
