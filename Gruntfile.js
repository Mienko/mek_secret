module.exports = function(grunt) {
	
	// Configuration
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		
		modernizr: {
			makefile: {
				"devFile": "remote", // Skip check for dev file
				"outputFile": "scripts/src/modernizr.js",
				"extra": {
					"shiv": false,
					"printshiv": true,
					"load": true,
					"mq": true,
					"cssclasses": true
				},
				"extensibility": {
					"addtest": false,
					"prefixed": false,
					"teststyles": true,
					"testprops": true,
					"testallprops": true,
					"hasevents": false,
					"prefixes": true,
					"domprefixes": true
				},
				"uglify": false,
				"tests": ['csstransforms', 'inlinesvg', 'touch', 'flexbox'],
				"parseFiles": false,
				"matchCommunityTests": false
			}
		},
		
		sass: {
			dist: {
				files: {
					'style.css': 'scss/style.scss'
				}
			}
		},
		
		csslint: {
			options: {
				'adjoining-classes': false,
				'box-model': false,
				'box-sizing': false,
				'unique-headings': false,
				'qualified-headings': false
			},
			lint: {
				expand: true,
				src: 'styles/*.css'
			}
		},

		autoprefixer: {
			options: {
				browsers: ['> 1%', 'last 2 versions', 'ie 9', 'ie 8', 'firefox 24', 'opera 12.1'],
				map: true
			},
			prefix: {
				expand: true,
				src: 'styles/*.css'
			}
		},

		cssmin: {
			minify: {
				expand: true,
				flatten: true,
				//cwd: 'styles/',
				src: '*.css',
				ext: '.css'
			}
		},
		
		copy: {
			fonts: {
				files: [ {
					expand: true,
					flatten: true,
					dest: 'fonts/',
					src: ['bower_components/fontawesome/fonts/**'],
					filter: 'isFile'
				} ]
			},
			build: {
				files: [
					{ expand: true , src: ['*.php'] , dest: 'build/mek_secret/' },
					{ expand: true , src: ['*.css'] , dest: 'build/mek_secret/' },
					{ expand: false, src: ['fonts/**'], dest: 'build/mek_secret/' },
					{ expand: true , src: ['inc/**'], dest: 'build/mek_secret/' },
					{ expand: true , src: ['js/**'], dest: 'build/mek_secret/' },
					{ expand: true , src: ['languages/**'], dest: 'build/mek_secret/' },
				]
			}
		},

		makepot: {
			target: {
				options: {
					cwd: '',
					domainPath: '/languages',
					mainFile: 'style.css',
					potFilename: 'mek_secret.pot',
					processPot: function( pot, options ) {
						pot.headers['report-msgid-bugs-to'] = 'http://mienko.no/kontakt/';
						pot.headers['language-team'] = 'Mienko <mienko@mienko.no>';
						return pot;
					},
					type: 'wp-theme'
				}
			}
		},

		image: {
			build: {
				files: {
					'build/mek_secret/screenshot.png': 'screenshot.png'
				}
			}
		},

		compress: {
			build: {
				options: {
					archive: 'build/mek_secret.zip'
				},
				files: [
					{
						expand: true,
						cwd: 'build/',
						src: '**',
					}
				]
			}
		},

		clean: {
			build: ["build/"],
			all: ["build/","languages/mek_secret.pot", "style.css"]
		},

		watch: {
/*
			scripts: {
				files: ['scripts/src/*.js'],
				tasks: ['uglify']
			},
*/
			css: {
				files: ['scss/*.scss'],
				tasks: ['sass', 'autoprefixer', 'cssmin']
			},
			livereload: {
				options: { livereload: true },
				files: ['*.php', '**/*.php', 'style.css', 'css/**', 'js/build/*.js']
			}
		}
		
	});
	
	// Plugin List
	//grunt.loadNpmTasks("grunt-modernizr");
	//grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-sass');
	//grunt.loadNpmTasks('grunt-csscomb');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-wp-i18n');
	grunt.loadNpmTasks('grunt-contrib-compress');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-image');
	
	// Workflows
	// $ grunt: Concencates, prefixes, minifies JS and CSS files, shrinks images, and generates docs. The works.
	grunt.registerTask('default', [
		//'modernizr',
		//'uglify',
		'sass',
		//'csscomb',
		'autoprefixer',
		'cssmin',
		//'markdown',
		'copy:fonts',
		'makepot'
	]);
		
	// $ grunt dev: Starts MAMP server, watches for changes while developing.
	grunt.registerTask('dev', [
		'default',
		'watch',
	]);

	grunt.registerTask('build' , [
		'default',
		'copy:build',
		'image:build',
		'compress:build',
	]);

};
