import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';

export function initRangeFilter() {
    const inputs = [
        document.querySelector('#price_from'),
        document.querySelector('#price_to'),
    ]
    const element = document.querySelector('#price-slider')

    const slider = noUiSlider.create(element, {
        start: [+element.dataset.from, +element.dataset.to],
        connect: true,
        range: {
            'min': +element.dataset.from,
            'max': +element.dataset.to,
        }
    });

    slider.on('update', (values, handle) => {
        inputs[handle].value = (+values[handle]).toFixed()
    })

    document.querySelector('.range_inputs').addEventListener('input', (e) => {
        slider.setHandle(+e.target.dataset.range, e.target.value)
    })
}
