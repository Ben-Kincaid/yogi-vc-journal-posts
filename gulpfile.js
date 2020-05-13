const gulp = require("gulp");
const sass = require("gulp-sass");
const babel = require("gulp-babel");
const sourcemaps = require("gulp-sourcemaps");
const zip = require("gulp-zip");

const fs = require("fs");

const packageJson = JSON.parse(fs.readFileSync("./package.json"));
const releaseVersion = packageJson.version;
const releaseName = packageJson.name || "release";

gulp.task("sass", function () {
  return gulp
    .src("elements/journal-posts/src/scss/main.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(gulp.dest("elements/journal-posts/dist/css"));
});

gulp.task("sass:watch", function () {
  gulp.watch("elements/journal-posts/src/scss/**/*.scss", gulp.series("sass"));
});

gulp.task("babel", function () {
  return gulp
    .src("elements/journal-posts/src/js/main.js")
    .pipe(sourcemaps.init())
    .pipe(
      babel({
        presets: ["@babel/preset-env"],
      })
    )
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest("elements/journal-posts/dist/js"));
});

gulp.task("babel:watch", function () {
  gulp.watch("elements/journal-posts/src/js/**/*.js", gulp.series("babel"));
});

gulp.task("dev", gulp.parallel("babel:watch", "sass:watch"));
gulp.task("build", gulp.parallel("sass", "babel"));

gulp.task("release", function () {
  return gulp
    .src(
      ["vc-journal-posts.php", "elements/**/*", "!elements/**/{src,src/**}"],
      {
        base: ".",
      }
    )
    .pipe(zip(`${releaseName}-${releaseVersion}.zip`))
    .pipe(gulp.dest(`releases/${releaseVersion}`));
});
