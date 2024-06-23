import {initRangeFilter} from "./FilterRange.js";

export function initCatalogFilter() {
    const filter = document.querySelector('#filter-form')

    if (!filter) return

    document.addEventListener('click', (e) => {
        const target = e.target.closest('.filter_title')
        if (!target) return

        const filter = target.closest('.filter')
        const isActive = filter.classList.toggle('filter__active')

        const filterOptions = filter.querySelector('.filter_options')
        const filterOptionsInner = filter.querySelector('.filter_options-inner')

        isActive
            ? filterOptions.style.maxHeight = filterOptionsInner.offsetHeight + 'px'
            : filterOptions.style.removeProperty('max-height')

    })

    initRangeFilter()

    filter.addEventListener('submit', applyFilters)

    setFilterHeight()
    window.addEventListener('resize', setFilterHeight)
}

function setFilterHeight() {
    const filters = document.querySelectorAll('.filter__active .filter_options')

    for (let filter of filters) {
        const filterOptionsInner = filter.querySelector('.filter_options-inner')
        filter.style.maxHeight = filterOptionsInner.offsetHeight + 'px'
    }
}

async function applyFilters(e) {
    e.preventDefault()
    const form = new FormData(e.target)

    const {data: products} = await axios.get('/products', {
        params: {
            categories: form.getAll('categories[]'),
            brands: form.getAll('brands[]'),
            price_from: form.get('price_from'),
            price_to: form.get('price_to'),
        }
    })

    const card = document.querySelector('#product-card')
    const catalog = document.querySelector('.catalog_products')

    catalog.innerHTML = ''

    for (let product of products) {
        const newCard = card.content.cloneNode(true)

        newCard.querySelector('.product-card_category').innerText = product.category
        newCard.querySelector('.product-card_name').innerText = product.name
        newCard.querySelector('.product-card_price').innerText = Intl.NumberFormat('ru-RU').format(product.price) + ' ₽'
        newCard.querySelector('.product-card_name').innerText = product.name

        const ratingCont = newCard.querySelector('.product-card_rating')

        for (let i = 1; i <= product.rating; i++) {
            const activeStar = document.createElement('div')
            activeStar.classList.add('product-card_star__active')

            ratingCont.append(activeStar)
        }

        for (let i = product.rating; i < 5; i++) {
            const disabledStar = document.createElement('div')
            disabledStar.classList.add('product-card_star__disabled')

            ratingCont.append(disabledStar)
        }

        catalog.append(newCard)
    }
}
