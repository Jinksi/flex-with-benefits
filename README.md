# Flex with benefits
Wordpress theme for [Thrive Web](http://thriveweb.com.au).

### Benefits include:

- [Gulp](http://gulpjs.com/): build system
- [Browser-sync](http://browsersync.io/): for auto browser-refreshing and syncing.
- [Sass](http://sass-lang.com/) with [Sourcemaps](https://github.com/floridoo/gulp-sourcemaps)
- [Webpack](https://webpack.js.org/) & [Babel](http://babeljs.io/)

### Dependencies:

- [Node](https://nodejs.org/en/) & [npm](https://docs.npmjs.com/getting-started/installing-node)

### Installation:

- Clone or download the repo into your theme folder
- Open terminal and `cd` to this directory
- `npm install` or `yarn install`
- When it has finished, run `npm start` or `yarn start`
- Open http://localhost:3000 in your browser
- Make a change and watch it refresh
- `npm run build` or `yarn build` to build static assets to `dist/`

### Options:

- Browser-sync is set to work via `flex-with-benefits.dev` as a proxy. You will need to change this ( e.g. use `localhost:8888` for MAMP ). You can change this setting in `gulpfile.js`
- Open http://localhost:3001 in your browser for more Browser-sync settings
