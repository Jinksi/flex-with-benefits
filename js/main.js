(function(document, window, $){
	'use strict'
	const _padEnd = require('lodash/padEnd')

	console.log(_.padEnd('abc', 6, '0'))

	//Fast CLick
	FastClick.attach(document.body)

})(document, window, jQuery)
