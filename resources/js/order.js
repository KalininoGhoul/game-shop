export async function initOrderBtn() {
    const btn = document.querySelector('#order')

    if(!btn) return

    btn.addEventListener('click',  async () => {
        const response = await axios.post('/order')

        if (response.status === 200) {
            const cart = document.querySelector('.cart')

            cart.innerHTML = ''

            const message = document.createElement('div')
            message.classList.add('message')
            message.innerHTML = 'Заказ оформлен. <br> Вам отправлено письмо на почту'

            cart.append(message)
        }
    })
}
