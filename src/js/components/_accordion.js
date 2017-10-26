export default () => {
  const accordions = [...document.querySelectorAll('.accordion')]
  if (!accordions) return false

  const initAccordion = accordion => {
    const accordionItems = [...accordion.children]
    if (!accordionItems) return false

    const addListener = el => {
      const title = el.querySelector('.accordion--item--title')
      if (!title) return false
      title.addEventListener('click', e => {
        e.preventDefault()
        el.classList.toggle('open')
      })
    }

    accordionItems.map(addListener)
  }

  accordions.map(initAccordion)
}
