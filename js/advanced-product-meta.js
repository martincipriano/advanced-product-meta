window.apm = {}

window.apm.updateRangeValue = function(e) {
  let rangeInput = e.target
  let formGroup = rangeInput.closest('.apm-form-group')
  let rangeLabel = formGroup.querySelector('.apm-range-value span')
  let max = rangeInput.getAttribute('max')
  let min = rangeInput.getAttribute('min')

  rangeLabel.style.left = `${(((rangeInput.value - min) / (max - min)) * 100)}%`

  // Where 2 is the width of the range thumb in rem
  rangeLabel.style.transform = `translateX(-${(2 * (rangeInput.value / max))}rem)`

  // Update the range label with the input value
  rangeLabel.innerHTML = rangeInput.value
}

window.apm.eventListeners = function() {
  let ranges = document.querySelectorAll('input[type="range"]')

  ranges.forEach(range => {
    range.addEventListener('input', window.apm.updateRangeValue)
  })
}

// run the event listeners after the dom has been loaded
document.addEventListener('DOMContentLoaded', window.apm.eventListeners)