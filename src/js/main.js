import fonts from './_fonts'
import featuredSlider from './components/_featured-slider'
import map from './components/_map'
import accordion from './components/_accordion'

function init () {
  fonts()
  featuredSlider()
  accordion()
  window.initMap = map
}

init()
