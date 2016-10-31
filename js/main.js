'use strict'

const FastClick = require('fastclick')

FastClick(document.body)

const _padEnd = require('lodash/padEnd')

console.log(_padEnd('abc', 6, '0'))
