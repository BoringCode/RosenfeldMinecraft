module.exports = function(grunt) {
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		watch: {
			src: {
				files: [
					'src/**/*', 
					'node_modules/bootstrap-sass',
					'node_modules/font-awesome/scss/'
				],
				tasks: ['dev'],
			}
		},
		copy: {
			fontAwesome: {
				files: [
					{expand: true, flatten: true, cwd: 'node_modules/font-awesome/fonts/', src: ['**'], dest: 'assets/fonts/', filter: "isFile"},
				]
			}
		},
		sass: {
			options: {
				includePaths: [
					'node_modules/bootstrap-sass/assets/stylesheets/', 
					'node_modules/font-awesome/scss/', 
					'src/scss/'
				]
			},
			dist: {
				files: {
					'assets/css/main.css': 'src/scss/main.scss'
				}
			}
		},
		postcss: {
    		options: {
    			map: true,
	    		processors: [
	        		require("pixrem")(), // add fallbacks for rem units
	        		require("autoprefixer")({browsers: "last 2 versions"}), // add vendor prefixes
	        		require("cssnano")() // minify the result
	      		]
    		},
    		dist: {
		    	src: "assets/css/*.css"
		    }
    	}
	})

	grunt.registerTask('default', ['dev', 'watch'])
	grunt.registerTask('dev', ['sass', 'postcss', 'copy'])
}
