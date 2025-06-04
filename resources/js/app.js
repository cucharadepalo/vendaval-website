function initTabs() {
	const tabBtns = document.querySelectorAll('button[role="tab"]');
	const panels = document.querySelectorAll('[role="tabpanel"]');
	let activeIndex = 0;

	tabBtns.forEach( (tab, index) => {
		tab.addEventListener('click', (event) => {
			setActiveTab(index);
		});
		tab.addEventListener('keydown', (event) => {
			const lastIndex = tabBtns.length - 1;

			if (event.code === 'ArrowLeft' || event.code === 'ArrowUp') {
				event.preventDefault();

				if (activeIndex === 0) {
					setActiveTab(lastIndex);
				} else {
					setActiveTab(activeIndex - 1);
				}
			} else if (event.code === 'ArrowRight' || event.code === 'ArrowDown') {
				event.preventDefault();

				if (activeIndex === lastIndex) {
					setActiveTab(0);
				} else {
					setActiveTab(activeIndex + 1);
				}
			} else if (event.code === 'Home') {
				event.preventDefault();

				setActiveTab(0)
			} else if (event.code === 'End') {
				event.preventDefault();

				setActiveTab(lastIndex);
			}
		});
	})

	function setActiveTab(index) {
		tabBtns[activeIndex].setAttribute('aria-selected', 'false');
		tabBtns[activeIndex].tabIndex = -1;
		tabBtns[index].setAttribute('aria-selected', 'true');
		tabBtns[index].tabIndex = 0;
		tabBtns[index].focus();

		setActivePanel(index);
		activeIndex = index;
	}

	function setActivePanel(index) {
		panels[activeIndex].setAttribute('hidden', '');
		panels[activeIndex].tabIndex = -1;
		panels[index].removeAttribute('hidden');
		panels[index].tabIndex = 0;
	}
}

initTabs();


function toggleMenu() {
	const menu = document.querySelector('.site-menu');

	if (menu && menu.classList.contains('top-0')) {
		menu.classList.remove('top-0');
		menu.classList.add('-top-full');
	} else if (menu && menu.classList.contains('-top-full')) {
		menu.classList.remove('-top-full');
		menu.classList.add('top-0');
	}
}

const menuTogglers = document.querySelectorAll('.toggle-menu')

menuTogglers.forEach( (element) => {
	element.addEventListener('click', () => {
		toggleMenu();
		for (const child of element.children) {
			child.classList.toggle('hidden')
		}
	});
})
