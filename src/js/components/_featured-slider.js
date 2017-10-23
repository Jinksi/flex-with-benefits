import Flickity from 'flickity-imagesloaded'

export default () => {
  const featuredSlider = document.querySelector('.features-slider')
  if (!featuredSlider) return

  Flickity(featuredSlider, {
    wrapAround: false,
    autoPlay: 4000,
    imagesLoaded: true
  })
}
