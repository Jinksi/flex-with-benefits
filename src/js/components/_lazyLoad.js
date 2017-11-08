import 'intersection-observer'

export default (args = {}) => {
  const options = {
    lazyParentClass: args.lazyParentClass || '.lazy-parent',
    lazyItemClass: args.lazyItemClass || '.lazy-child'
  }

  const lazyLoadParents = [
    ...document.querySelectorAll(options.lazyParentClass)
  ]

  const lazyLoad = new IntersectionObserver(entries => {
    entries.map(entry => {
      // check if observed entry is intersecting
      if (!entry.isIntersecting) return false

      // target = intersected element
      const children = [...entry.target.querySelectorAll(options.lazyItemClass)]

      if (children.length >= 0) {
        children.forEach(img => {
          if (img.dataset.srcset) {
            // move data-srcset to srcset
            img.srcset = img.dataset.srcset
            img.removeAttribute('data-srcset')
          }
          if (img.dataset.src) {
            // move data-src to src
            img.src = img.dataset.src
            img.removeAttribute('data-src')
          }
          // background-image
          if (img.dataset.bgSrc) {
            const dummyImage = new Image()
            dummyImage.src = img.dataset.bgSrc
            dummyImage.onload = () => {
              img.style.backgroundImage = `url(${img.dataset.bgSrc})`
              img.removeAttribute('data-bg-src')
              img.classList.add('loaded')
            }
          }
          // wait for image to load and addClass to fade in
          img.onload = () => img.classList.add('loaded')
        })
      }
    })
  })

  lazyLoadParents.forEach(item => {
    // add items to IntersectionObserver
    lazyLoad.observe(item)
  })
}
