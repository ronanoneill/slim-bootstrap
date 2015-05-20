module.exports = function(grunt) {
    require('jit-grunt')(grunt);
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        less: {
            development: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                files: {
                    "public/static/css/stylesheets/style.css": "public/static/css/compile/style.compile.less"
                }
            }
        },
        watch: {
            styles: {
                files: ['public/static/css/**/*.less'],
                tasks: ['less']
            }
        }
    });
    grunt.registerTask('default', ['less', 'watch']);
};