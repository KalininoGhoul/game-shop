export async function initAddToCartBtn() {
    const btn = document.querySelector('[data-cart-btn]')
    if (!btn) return

    const output = document.querySelector('.product_quantity-output')
    const quantityMinusBtn = document.querySelector('.product_quantity-minus')
    const quantityPlusBtn = document.querySelector('.product_quantity-plus')

    quantityMinusBtn.addEventListener('click', () => changeQuantity(output, '-'))
    quantityPlusBtn.addEventListener('click', () => changeQuantity(output, '+'))

    btn.addEventListener('click', async (e) => {
        const productElement = btn.closest('[data-product]')

        const product = productElement.dataset.product
        const number = productElement.dataset.quantity

        const response = await axios.post('/cart/products', {product, number})

        if (response.status === 200) {
            localStorage.setItem('cart', response.data.count)
            document.querySelector('.user_cart_count').innerText = response.data.count
        }
    })
}


async function changeQuantity(output, symbol) {
    let quantity = +output.closest('[data-quantity]').dataset.quantity

    if (symbol === '+') quantity += 1
    else quantity -= 1

    if (quantity < 1) quantity = 1

    output.closest('[data-quantity]').dataset.quantity = quantity
    output.innerText = quantity
}
