const gulp = require('gulp')
const exec = require('child_process').exec

/**
 * Creates a server on the port 8080
 */
gulp.task('default', (cb) => {
  exec('php -S 0.0.0.0:8080 -t ./', (err, stdout, stderr) => {
    console.log(stdout)
    console.log(stderr)
    cb(err)
  })
})
