export async function initTabs() {
    const tabs = document.querySelector('.tabs')
    if (!tabs) return

    tabs.querySelector('.tabs_head').addEventListener('click', (e) => {
        const tab = e.target.closest('[data-for-tab]')
        if (!tab) return

        const headsForClose = tabs.querySelectorAll('[data-for-tab]')
        const tabsForClose = tabs.querySelectorAll('[data-tab]')

        for (let item of headsForClose) item.classList.remove('tab__active')
        for (let item of tabsForClose) item.style.removeProperty('display')

        tab.classList.add('tab__active')
        const content = tabs.querySelector(`[data-tab="${tab.dataset.forTab}"]`)
        content.style.display = 'flex'
    })
}
