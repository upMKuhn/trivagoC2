module.exports = function(grunt) {

    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.initConfig({

        sass: {
            options: {
                sourceMap: true,
                'outputStyle': 'compressed'
            },
            styles: {
                files: {
                    'web/css/style.css': 'web/scss/style.scss'
                }
            }
        },

        watch: {
            styleWatch: {
                files: '**/*.scss',
                tasks: ['sass'],
                options: {
                    interrupt: true
                },
            },
        },

    });


    grunt.registerTask('default', ['sass']);
};