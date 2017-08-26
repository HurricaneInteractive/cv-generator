module.exports = function(grunt) {
    grunt.initConfig({
        sass: {
            options: {
                sourcemap: false,
                outputStyle: "compressed",
                sourceComments: false,
                indentWidth: 4
            },
            dist: {
                files: {
                    'style.css': 'css/style.scss'
                }
            }
        },
        autoprefixer: {
            options: {
                browsers: ['last 5 versions']
            },
            single_file: {
                src: 'style.css',
                dest: 'style.css'
            }
        },
        watch: {
            css: {
                files: 'css/**/*.scss',
                tasks: ['sass', 'autoprefixer']
            }
        }
    });
    
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.registerTask('default', ['sass', 'autoprefixer', 'watch']);
}