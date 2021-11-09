import {
  terser
} from 'rollup-plugin-terser'
import commonjs from '@rollup/plugin-commonjs'
import resolve from '@rollup/plugin-node-resolve'
import babel from '@rollup/plugin-babel'
const autoprefixer = require('autoprefixer')
const buffer = require('vinyl-buffer')
const changed = require('gulp-changed')
const cssnano = require('cssnano')
const del = require('del')
const gulp = require('gulp')
const merge = require('merge-stream')
const postcss = require('gulp-postcss')
const rename = require('gulp-rename')
const rollup = require('rollup')
const sass = require('gulp-sass')
const spritesmith = require('gulp.spritesmith')
const squoosh = require('gulp-libsquoosh');

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
function clean() {
  // You can use multiple globbing patterns as you would with `gulp.src`,
  // for example if you are using del 2.0 or above, return its promise
  return del(['dist'])
}

/*
 * Define our tasks using plain functions
 */
function scss() {
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

function scripts() {
  return rollup.rollup({
    input: './src/js/main.js',
    plugins: [
      resolve(),
      commonjs(),
      babel({
        babelHelpers: 'bundled',
        exclude: 'node_modules/**'
      }),
      terser({
        keep_fnames: true,
        format: {
          quote_style: 1,
          comments: false
        }
      })
    ],
    watch: {
      exclude: 'node_modules/**',
      chokidar: {
        useFsEvents: false
      }
    }
  }).then(bundle => {
    return bundle.write({
      file: './dist/js/main.min.js',
      format: 'iife',
      name: 'bundle',
      sourcemap: false
    })
  })
}

function mceButton() {
  return rollup.rollup({
    input: './src/js/mce-button.js',
    plugins: [
      resolve(),
      commonjs(),
      babel({
        babelHelpers: 'bundled',
        exclude: 'node_modules/**'
      }),
      terser({
        keep_fnames: true,
        format: {
          quote_style: 1,
          comments: false
        }
      })
    ],
    watch: {
      exclude: 'node_modules/**',
      chokidar: {
        useFsEvents: false
      }
    }
  }).then(bundle => {
    return bundle.write({
      file: './dist/js/mce-button.min.js',
      format: 'iife',
      name: 'bundled',
      sourcemap: false
    })
  })
}

function images() {
  return gulp
    .src(paths.images.src)
    .pipe(changed(paths.images.dest))
    .pipe(squoosh())
    .pipe(gulp.dest(paths.images.dest))
}

function sprite() {
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
    .pipe(squoosh())
    .pipe(gulp.dest(paths.sprite.dest))
  const cssStream = spriteData.css
    .pipe(gulp.dest('src/sass/'))
  return merge(imgStream, cssStream)
}

function ajax() {
  return gulp
    .src(paths.ajax.src)
    .pipe(changed(paths.ajax.dest))
    .pipe(gulp.dest(paths.ajax.dest))
}

function fonts() {
  return gulp
    .src(paths.fonts.src)
    .pipe(changed(paths.fonts.dest))
    .pipe(gulp.dest(paths.fonts.dest))
}

function watch() {
  gulp.watch(paths.scss.src, scss)
  gulp.watch(paths.js.src, scripts)
  gulp.watch(paths.js.src, mceButton)
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
  // gulp.parallel(scss, scripts, images, sprite, ajax, fonts, watch)
  gulp.parallel(scss, scripts, mceButton, images,sprite,ajax, fonts, watch)
)

/*
 * You can use CommonJS `exports` module notation to declare tasks
 */
exports.clean = clean
exports.scss = scss
exports.scripts = scripts
exports.mceButton = mceButton
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
