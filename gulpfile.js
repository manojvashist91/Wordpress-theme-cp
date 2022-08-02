var gulp = require('gulp'),
	watch = require('gulp-watch'),
	autoPrefixer = require('gulp-autoprefixer'),
	cssMin = require('gulp-cssmin'),
	jsMin = require('gulp-jsmin'),
	rigger = require('gulp-rigger'),
	uglify = require('gulp-uglify'),
	concat = require('gulp-concat'),
	rename = require('gulp-rename'),
	sass = require('gulp-sass'),
	sass = require('gulp-sass')(require('sass'));
	replace = require('gulp-replace'),
	sourceMaps = require('gulp-sourcemaps'),
	imageMin = require('gulp-imagemin'),
	autoprefixer = require('gulp-autoprefixer'),
	browserSync = require('browser-sync').create();

var devURL = 'http://starter-theme.test';

var paths = {
	build: {
		branding: {
			img: 'assets/branding/img/',
			js: 'assets/branding/js/',
			css: 'assets/branding/css/'
		},
		pdfs: {
			img: 'assets/pdfs/img/',
			css: 'assets/pdfs/css/'
		},
		theme: {
			img: 'assets/theme/img/',
			js: 'assets/theme/js/',
			css: 'assets/theme/css/',
			fonts:'assets/theme/fonts/',
			webfonts:'assets/theme/webfonts',
		}
	},

	src: {
		branding: {
			img: 'assets-src/branding/img/**',
			js: 'assets-src/branding/js/*.js',
			css: 'assets-src/branding/css/main.scss'
		},
		pdfs: {
			img: 'assets-src/pdfs/img/**',
			css: 'assets-src/pdfs/css/main.scss'
		},
		theme: {
			img: 'assets-src/theme/img/**',
			js: 'assets-src/theme/js/*.js',
			css: 'assets-src/theme/scss/main.scss',
			css: 'assets-src/theme/scss/app.scss',
			fonts: 'assets-src/theme/fonts/**',
		}
	},

	watch: {
		img: 'assets-src/**/img/*',
		js: 'assets-src/**/*.js',
		css: 'assets-src/**/*.scss'
	}
};

gulp.task('images-branding', function() {
	return gulp.src( paths.src.branding.img )
		.pipe( imageMin([
			imageMin.gifsicle(),
			imageMin.mozjpeg(),
			imageMin.optipng()
		]) )
		.pipe( gulp.dest(paths.build.branding.img) );
});

gulp.task('images-pdfs', function() {
	return gulp.src( paths.src.pdfs.img )
		.pipe( imageMin([
			imageMin.gifsicle(),
			imageMin.mozjpeg(),
			imageMin.optipng()
		]) )
		.pipe( gulp.dest(paths.build.pdfs.img) );
});

gulp.task('images-theme', function() {
	return gulp.src( paths.src.theme.img )
		.pipe( imageMin(([
			imageMin.gifsicle(),
			imageMin.mozjpeg(),
			imageMin.optipng()
		])) )
		.pipe( gulp.dest(paths.build.theme.img) );
});

gulp.task('js-branding', function () {
	return gulp.src( paths.src.branding.js )
		.pipe( rigger() )
		.pipe( gulp.dest(paths.build.branding.js) );
});

gulp.task('js-theme', function () {
	return gulp.src( paths.src.theme.js )
		.pipe( rigger() )
		.pipe( gulp.dest(paths.build.theme.js) );
});

gulp.task('js-min-branding', function () {
	return gulp.src( paths.src.branding.js )
		.pipe( rigger() )
		.pipe( jsMin() )
		.pipe( gulp.dest(paths.build.branding.js) );
});

gulp.task('js-min-theme', function () {
	return gulp.src( paths.src.theme.js )
		.pipe( rigger() )
		.pipe( jsMin() )
		.pipe( gulp.dest(paths.build.theme.js) );
});

gulp.task('css-branding', function() {
	return gulp.src( paths.src.branding.css )
		.pipe( sourceMaps.init() )
		.pipe( sass().on('error', sass.logError) )
		.pipe( sourceMaps.write() )
		.pipe( rename('styles.css') )
		.pipe( gulp.dest(paths.build.branding.css) )
		.pipe( browserSync.stream() );
});

gulp.task('css-pdfs', function() {
	return gulp.src( paths.src.pdfs.css )
		.pipe( sourceMaps.init() )
		.pipe( sass().on('error', sass.logError) )
		.pipe( sourceMaps.write() )
		.pipe( rename('styles.css') )
		.pipe( gulp.dest(paths.build.pdfs.css) )
		.pipe( browserSync.stream() );
});

gulp.task('css-theme', function() {
	return gulp.src( paths.src.theme.css )
		.pipe( sourceMaps.init() )
		.pipe( sass().on('error', sass.logError) )
		.pipe(replace('./fonts/bootstrap','../fonts/bootstrap'))
		.pipe( sourceMaps.write() )
		.pipe( rename('styles.css') )
		.pipe(autoprefixer({
			browsers: ['last 99 versions'],
			cascade: false
		}))
		.pipe( gulp.dest(paths.build.theme.css) )
		.pipe( browserSync.stream() );
});

gulp.task('css-min-branding', function () {
	return gulp.src( paths.src.branding.css )
		.pipe( sourceMaps.init() )
		.pipe( sass().on('error', sass.logError) )
		.pipe( sourceMaps.write() )
		.pipe(
			autoPrefixer({
				cascade: false
			})
		)
		.pipe( cssMin() )
		.pipe( rename('styles.css') )
		.pipe( gulp.dest(paths.build.branding.css) );
});

gulp.task('css-min-pdfs', function () {
	return gulp.src( paths.src.pdfs.css )
		.pipe( sourceMaps.init() )
		.pipe( sass().on('error', sass.logError) )
		.pipe( sourceMaps.write() )
		.pipe(
			autoPrefixer({
				cascade: false
			})
		)
		.pipe( cssMin() )
		.pipe( rename('styles.css') )
		.pipe( gulp.dest(paths.build.pdfs.css) );
});

gulp.task('css-min-theme', function () {
	return gulp.src( paths.src.theme.css )
		.pipe( sourceMaps.init() )
		.pipe( sass().on('error', sass.logError) )
		.pipe( sourceMaps.write() )
		.pipe(
			autoPrefixer({
				cascade: false
			})
		)
		.pipe( cssMin() )
		.pipe( rename('styles.css') )
		.pipe( gulp.dest(paths.build.theme.css) );
});

gulp.task('images', gulp.parallel('images-branding', 'images-pdfs', 'images-theme'));
gulp.task('js', gulp.parallel('js-branding', 'js-theme'));
gulp.task('js-min', gulp.parallel('js-min-branding', 'js-min-theme'));
gulp.task('css', gulp.parallel('css-branding', 'css-pdfs', 'css-theme'));
gulp.task('css-min', gulp.parallel('css-min-branding', 'css-min-pdfs', 'css-min-theme'));
gulp.task('browser-sync', function() {
	browserSync.init({
		proxy: devURL
	});
});

gulp.task('vendor', function () {
	return gulp.src([
		'node_modules/bootstrap/dist/js/bootstrap.js',
		'node_modules/swiper/swiper-bundle.js',
	])
		.pipe(sourceMaps.init())
		.pipe(uglify())
		.pipe(concat('vendors.js'))
		.pipe(sourceMaps.write('.'))
		.pipe( gulp.dest(paths.build.theme.js) );
});

gulp.task('fonts', function() {
	return gulp.src(paths.src.theme.fonts)
		.pipe(gulp.dest(paths.build.theme.fonts));
});

gulp.task('bootstrap-fonts', function() {
	return gulp.src('node_modules/bootstrap-icons/font/fonts/**')
		.pipe(gulp.dest(paths.build.theme.fonts));
});
gulp.task('icons', function() {
	return gulp.src('node_modules/@fortawesome/fontawesome-free/webfonts/*')
		.pipe(gulp.dest(paths.build.theme.webfonts));
});
gulp.task('dev', gulp.parallel('images', 'js', 'css','vendor','fonts','icons'));

gulp.task('dev-watch', function() {
	watch(paths.watch.img, function(event, cb) {
		gulp.series('images')();

		browserSync.reload();
	});

	watch(paths.watch.js, function(event, cb) {
		gulp.series('js')();

		browserSync.reload();
	});

	watch(paths.watch.css, function(event, cb) {
		gulp.series('css')();
	});
});

gulp.task('prod', gulp.parallel('images', 'js-min', 'css-min'));

gulp.task('default', gulp.parallel('dev', 'browser-sync', 'dev-watch'));