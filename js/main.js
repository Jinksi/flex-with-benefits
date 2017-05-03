import './_fastclick'
import './_fonts'
import featuredSlider from './components/_featured-slider'
import map from './components/_map'

function init () {
  featuredSlider()
  window.initMap = map
}

init()
