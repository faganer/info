const babel = require('gulp-babel')
const gulp = require('gulp')
const postcss = require('gulp-postcss')
const rename = require('gulp-rename')
const sass = require('gulp-sass')
const terser = require('gulp-terser')
const autoprefixer = require('autoprefixer')
const cssnano = require('cssnano')
const buffer = require('vinyl-buffer')
const imagemin = require('gulp-imagemin')
const merge = require('merge-stream')
const spritesmith = require('gulp.spritesmith')
const changed = require('gulp-changed')
const del = require('del')

sass.compiler = require('node-sass')

const paths = {
  scss: {
    src: 'src/sass/**/*.scss',
    dest: 'dist/css/'
  },
  js: {
    src: 'src/js/**/*.js',
    dest: 'dist/js/'
  },
  images: {
    src: 'src/images/**/*.*',
    dest: 'dist/images/'
  },
  sprite: {
    src: 'src/images/sprite/**/*.*',
    dest: 'dist/images/sprite/'
  },
  ajax: {
    src: 'src/ajax/**/*.*',
    dest: 'dist/ajax/'
  },
  fonts: {
    src: 'src/fonts/**/*.*',
    dest: 'dist/fonts/'
  }
}

/* Not all tasks need to use streams, a gulpfile is just another node program
 * and you can use all packages available on npm, but it must return either a
 * Promise, a Stream or take a callback and call it
 */
function clean () {
  // You can use multiple globbing patterns as you would with `gulp.src`,
  // for example if you are using del 2.0 or above, return its promise
  return del(['dist'])
}

/*
 * Define our tasks using plain functions
 */
function scss () {
  const plugins = [autoprefixer(), cssnano()]
  return (
    gulp
      .src(paths.scss.src)
      .pipe(changed(paths.scss.dest))
      .pipe(sass().on('error', sass.logError))
      .pipe(postcss(plugins))
      .pipe(
        rename({
          suffix: '.min'
        })
      )
      .pipe(gulp.dest(paths.scss.dest))
  )
}

function scripts () {
  return gulp.src(paths.js.src)
    .pipe(changed(paths.js.dest))
    .pipe(babel())
    .pipe(
      rename({
        suffix: '.min'
      })
    )
    .pipe(terser({
      keep_fnames: true,
      format: {
        quote_style: 1,
        comments: false
      }
    }))
    .pipe(gulp.dest('./dist/js'))
}

function images () {
  return gulp
    .src(paths.images.src)
    .pipe(changed(paths.images.dest))
    .pipe(imagemin())
    .pipe(gulp.dest(paths.images.dest))
}

function sprite () {
  const spriteData = gulp.src(paths.sprite.src).pipe(
    spritesmith({
      imgName: '../sprite.png',
      imgPath: '../images/sprite.png',
      cssName: '_sprite.scss',
      cssFormat: 'css'
    })
  )

  const imgStream = spriteData.img
    .pipe(changed(paths.sprite.dest))
    .pipe(buffer())
    .pipe(imagemin())
    .pipe(gulp.dest(paths.sprite.dest))
  const cssStream = spriteData.css
    .pipe(gulp.dest('src/sass/'))
  return merge(imgStream, cssStream)
}

function ajax () {
  return gulp
    .src(paths.ajax.src)
    .pipe(changed(paths.ajax.dest))
    .pipe(gulp.dest(paths.ajax.dest))
}

function fonts () {
  return gulp
    .src(paths.fonts.src)
    .pipe(changed(paths.fonts.dest))
    .pipe(gulp.dest(paths.fonts.dest))
}

function watch () {
  gulp.watch(paths.scss.src, scss)
  gulp.watch(paths.js.src, scripts)
  gulp.watch(paths.images.src, images)
  gulp.watch(paths.sprite.src, sprite)
  gulp.watch(paths.ajax.src, ajax)
  gulp.watch(paths.fonts.src, fonts)
}

/*
 * Specify if tasks run in series or parallel using `gulp.series` and `gulp.parallel`
 */
// var build = gulp.series(clean, gulp.parallel(scss, js, images, sprite, ajax, fonts, watch));
const build = gulp.series(
  gulp.parallel(scss, scripts, images, sprite, ajax, fonts, watch)
  // gulp.parallel(scss, scripts, ajax, fonts, watch)
)

/*
 * You can use CommonJS `exports` module notation to declare tasks
 */
exports.clean = clean
exports.scss = scss
exports.scripts = scripts
exports.images = images
exports.sprite = sprite
exports.ajax = ajax
exports.fonts = fonts
exports.watch = watch
exports.build = build

/*
 * Define default task that can be called by just running `gulp` from cli
 */
exports.default = build
