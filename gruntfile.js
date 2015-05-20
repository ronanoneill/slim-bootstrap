// Grunt wrapper
module.exports = function(grunt) {
    // Require the just in time plugin loader
    require('jit-grunt')(grunt);
    // Init the config object, define the less & watch options
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        less: {
            development: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                // @TODO, ideally we should define the source files dynamically based on location
                files: {
                    "public/static/css/stylesheets/style.css":
                        "public/static/css/compile/style.compile.less"
                }
            }
        },
        watch: {
            styles: {
                // Location of the less files on which we want to catch updates
                files: ['public/static/css/**/*.less'],
                tasks: ['less']
            }
        }
    });
    // Register the less and watch tasks by default
    grunt.registerTask('default', ['less', 'watch']);
};