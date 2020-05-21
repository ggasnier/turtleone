var gulp = require("gulp");
var sass = require("gulp-sass");
var autoprefixer = require("autoprefixer");
var postcss = require("gulp-postcss");
var cssnano = require("cssnano"); // minifies CSS

var browsersList = [
  "> 1%",
  "last 2 versions",
  "IE >= 10",
  "Edge >= 16",
  "Chrome >= 60",
  "Firefox >= 50",
  "Firefox ESR",
  "Safari >= 10",
  "ios_saf >= 10",
  "Android >= 5",
];

var pluginsProd = [
  //unprefix(),
  autoprefixer({
    grid: true,
  }),
  //flexbugs(),
  //gaps(),
  //cssnano()
];

gulp.task("sass", function () {
  return gulp
    .src("assets/sass/style.scss")
    .pipe(sass())
    .pipe(postcss(pluginsProd))
    .pipe(gulp.dest("assets/css"));
});

// Création de la tâche principale de surveillance
gulp.task("watch", function () {
  gulp.watch("assets/sass/*.scss", gulp.series("sass"));
});
