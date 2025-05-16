const gulp = require("gulp");
const terser = require("gulp-terser");
const cleanCSS = require("gulp-clean-css");
const rename = require("gulp-rename");
const browserSync = require("browser-sync").create();

const paths = {
	scripts: {
		main: "src/js/main.js",
		external: "src/js/external.js",
		blog: "src/js/blog.js",
		dest: "dist/js/",
	},
	styles: {
		src: "src/css/style.css",
		dest: "dist/css/",
	},
};

function minifyJS() {
	return gulp
		.src(paths.scripts.main)
		.pipe(terser())
		.pipe(rename({ suffix: ".min" }))
		.pipe(gulp.dest(paths.scripts.dest))
		.pipe(browserSync.stream());
}

function minifyBlogJS() {
	return gulp
		.src(paths.scripts.blog)
		.pipe(terser())
		.pipe(rename({ suffix: ".min" }))
		.pipe(gulp.dest(paths.scripts.dest))
		.pipe(browserSync.stream());
}

function minifyExternalJS() {
	return gulp
		.src(paths.scripts.external)
		.pipe(terser())
		.pipe(rename({ suffix: ".min" }))
		.pipe(gulp.dest(paths.scripts.dest))
		.pipe(browserSync.stream());
}

function minifyCSS() {
	return gulp
		.src(paths.styles.src)
		.pipe(cleanCSS())
		.pipe(rename({ suffix: ".min" }))
		.pipe(gulp.dest(paths.styles.dest))
		.pipe(browserSync.stream());
}

function watchFiles() {
	browserSync.init({
		server: {
			baseDir: "./",
		},
	});

	gulp.watch("src/css/*", minifyCSS);
	gulp.watch("src/js/main.js", minifyJS);
	gulp.watch("src/js/external.js", minifyExternalJS);
	gulp.watch("src/js/blog.js", minifyBlogJS);
	gulp.watch("./*.html").on("change", browserSync.reload);
}

const build = gulp.series(
	gulp.parallel(minifyJS, minifyBlogJS, minifyExternalJS, minifyCSS)
);
const watch = gulp.series(build, watchFiles);

gulp.task("default", build);

exports.minifyJS = minifyJS;
exports.minifyBlogJS = minifyBlogJS;
exports.minifyExternalJS = minifyExternalJS;
exports.minifyCSS = minifyCSS;
exports.build = build;
exports.watch = watch;
exports.default = build;
