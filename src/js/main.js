import fonts from './_fonts'
import featuredSlider from './components/_featured-slider'
import map from './components/_map'

function init () {
  fonts()
  featuredSlider()
  window.initMap = map
}

init()
