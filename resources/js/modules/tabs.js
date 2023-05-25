document.addEventListener('click', tabsAction);
function tabsAction(event) {
	const target = event.target;
	if (target.closest('[data-tab]')) {
		const tabId = target.dataset.tab ? target.dataset.tab : target.value;
		const tabContent = document.querySelector(`[data-tab-content="${tabId}"]`)
		if (tabContent) {
			const tabActive = document.querySelector('.tabs-item.isActive');
			const tabContentActive = document.querySelector('.tabs-content.isOpen');
			if (tabActive && tabActive != target) {
				tabActive.classList.remove('isActive')
				tabContentActive.classList.remove('isOpen')
			}
			target.classList.add('isActive')
			tabContent.classList.add('isOpen')
		}
	}
}
const personsSelect = document.getElementById('personsSelect');
if (personsSelect) {
	const tabsContentAll = document.querySelectorAll('#tabContentModal .tabs-content');
	personsSelect.addEventListener('change', (event) => {
		let selectValue = event.target.value;
		if (selectValue == "") return;
		let tabContent = document.getElementById(selectValue);
		[...tabsContentAll].forEach((item) => {
			item.classList.remove("isOpen");
		})
		tabContent.classList.add('isOpen')
	});
}
const tab = document.querySelector('[data-tab]');
if (tab) {
	document.querySelector('[data-tab]').click();
}
