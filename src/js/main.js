import fonts from './_fonts'
import lazyLoad from './components/_lazyLoad'
import featuredSlider from './components/_featured-slider'
import map from './components/_map'
import accordion from './components/_accordion'

function init () {
  lazyLoad()
  fonts()
  featuredSlider()
  accordion()
  window.initMap = map
}

init()
