window.apm = {}

window.apm.updateRangeTooltip = function(e) {
  let rangeInput = e.target
  let formGroup = rangeInput.closest('.apm-form-group')
  let rangeTooltip = formGroup.querySelector('.apm-range-tooltip')
  let rangeTrail = formGroup.querySelector('.apm-range-trail')
  let max = rangeInput.getAttribute('max')
  let min = rangeInput.getAttribute('min')

  // Update the range label's left position
  rangeTooltip.style.left = `${(((rangeInput.value - min) / (max - min)) * 100)}%`

  // Subtract range thumb offset where 2 is its width in rem
  // Prevent the range trail from overlapping the range thumb
  rangeTrail.style.width = `calc(${(((rangeInput.value - min) / (max - min)) * 100)}% - ${(2 * (rangeInput.value / max))}rem)`

  // Subtract range thumb offset where 2 is its width in rem
  // Prevent the tooltip from moving away from the center of the range thumb
  rangeTooltip.style.transform = `translateX(-${(2 * (rangeInput.value / max))}rem)`

  // Update the range label with the input value
  rangeTooltip.innerHTML = rangeInput.value
}

window.apm.moveRangeTooltip = function(e) {
  let formGroup = e.target.closest('.apm-form-group')
  let rangeInput = formGroup.querySelector('input[type="range"]')
  let rangeTooltip = formGroup.querySelector('.apm-range-tooltip')
  let max = rangeInput.getAttribute('max')
  let min = rangeInput.getAttribute('min')

  function move(e) {
    let rangeThumb = rangeInput.getBoundingClientRect()

    // Assign a value to the range input based on the range label position
    rangeInput.value = Math.round(((e.clientX - rangeThumb.left) / rangeThumb.width) * (max - min)) 

    // Update the range label's left position
    rangeTooltip.style.left = `${(((rangeInput.value - min) / (max - min)) * 100)}%`

    // Subtract range thumb offset where 2 is its width in rem
    rangeTooltip.style.transform = `translateX(-${(2 * (rangeInput.value / max))}rem)`

    // Update the range label with the input value
    rangeTooltip.innerHTML = rangeInput.value
  }

  function stop() {
    document.removeEventListener('mousemove', move)
    document.removeEventListener('mouseup', stop)
  }

  document.addEventListener('mousemove', move)
  document.addEventListener('mouseup', stop)
}

window.apm.eventListeners = function() {
  let ranges = document.querySelectorAll('input[type="range"]')
  let rangeTooltip = document.querySelectorAll('.apm-range-tooltip')

  rangeTooltip.forEach(value => {
    value.addEventListener('mousedown', window.apm.moveRangeTooltip)
  })

  ranges.forEach(range => {
    range.addEventListener('input', window.apm.updateRangeTooltip)
  })
}

// run the event listeners after the dom has been loaded
document.addEventListener('DOMContentLoaded', window.apm.eventListeners)