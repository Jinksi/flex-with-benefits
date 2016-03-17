# Flexxx with benefits
Wordpress theme for [Thrive](http://thriveweb.com.au).

Benefits include:

- [Gulp](http://gulpjs.com/): build system
- [Browsersync](http://browsersync.io/): for auto browser-refreshing and syncing.
- [Sass](http://sass-lang.com/)
- [Rucksack](http://simplaio.github.io/rucksack/) with Autoprefixer

Dependencies:

- [Node](https://nodejs.org/en/) & [npm](https://docs.npmjs.com/getting-started/installing-node)

Installation:

- Clone or download the repo into your theme folder
- Open terminal and `cd` to this directory
- `npm install`
- When it has finished, run `npm start`
- Open http://localhost:3000 in your browser
- Make a change and watch it refresh

Options:

- Browsersync is set to work via `localhost:8888` (MAMP) as a proxy. You can change this setting in `gulpfile.js`
- Open http://localhost:3001 in your browser for more Browsersync settings

TODO:

- Explain Git-based deployment with [dploy](https://github.com/LeanMeanFightingMachine/dploy)
