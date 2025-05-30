function initTabs() {
	const tabBtns = document.querySelectorAll('button[role="tab"]')
	const panels = document.querySelectorAll('[role="tabpanel"]')
	let activeIndex = 1

	tabBtns.forEach( (tab, index) => {
		tab.addEventListener('click', event => {
			setActiveTab(index)
		})
	})

	function setActiveTab(index) {
		tabBtns[activeIndex].setAttribute('aria-selected', 'false')
		tabBtns[activeIndex].tabIndex = -1
		tabBtns[index].setAttribute('aria-selected', 'true')
		tabBtns[index].tabIndex = 0
		tabBtns[index].focus()

		setActivePanel(index)
		activeIndex = index
	}

	function setActivePanel(index) {
		panels[activeIndex].setAttribute('hidden', '')
		panels[activeIndex].tabIndex = -1
		panels[index].removeAttribute('hidden')
		panels[index].tabIndex = 0
	}

	tabBtns.forEach(function (tab, index) {

		tab.addEventListener('keydown', function (event) {
			const lastIndex = tabBtns.length - 1;

			if (event.code === 'ArrowLeft' || event.code === 'ArrowUp') {
				event.preventDefault()

				if (activeIndex === 0) {
					setActiveTab(lastIndex)
				} else {
					setActiveTab(activeIndex - 1)
				}
			} else if (event.code === 'ArrowRight' || event.code === 'ArrowDown') {
				event.preventDefault()

				if (activeIndex === lastIndex) {
					setActiveTab(0)
				} else {
					setActiveTab(activeIndex + 1)
				}
			} else if (event.code === 'Home') {
				event.preventDefault()

				setActiveTab(0)
			} else if (event.code === 'End') {
				event.preventDefault()

				setActiveTab(lastIndex)
			}
		})
	})
}

initTabs();
